<?php

namespace Zevitagem\LaravelSaasTemplateCore\Services\Historic;

use Zevitagem\LaravelSaasTemplateCore\Repositories\PlanRepository;
use Zevitagem\LaravelSaasTemplateCore\Repositories\ModalityRepository;
use Zevitagem\LaravelSaasTemplateCore\Repositories\Config\CategoryConfigRepository;
use Zevitagem\LaravelSaasTemplateCore\Repositories\StudentRepository;
use Zevitagem\LaravelSaasTemplateCore\Repositories\HistoricEntitiesRepository;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithDependencie;
use Zevitagem\LaravelSaasTemplateCore\Models\Historic;

class ContainerRelationEntitiesService
{
    use AvailabilityWithDependencie;

    const MODALITIES = [
        'key' => 'modalities', 'description' => 'Modalidades'
    ];
    const PLANS = [
        'key' => 'plans', 'description' => 'Planos'
    ];
    const STUDENTS = [
        'key' => 'students', 'description' => 'Alunos'
    ];
    const CATEGORIES = [
        'key' => 'categories', 'description' => 'Categorias'
    ];

    public function __construct(
        PlanRepository $planRepository,
        ModalityRepository $modalityRepository,
        StudentRepository $studentRepository,
        CategoryConfigRepository $categoryConfigRepository,
        HistoricEntitiesRepository $historicEntitiesRepository,
    )
    {
        $this->setDependencie('modalities_repository', $modalityRepository);
        $this->setDependencie('plans_repository', $planRepository);
        $this->setDependencie('students_repository', $studentRepository);
        $this->setDependencie('categories_repository', $categoryConfigRepository);
        $this->setDependencie('historic_entities_repository', $historicEntitiesRepository);
    }

    public function getDataToCreate(int $slug)
    {
        $modalities = $this->getDependencie('modalities_repository')->getAllBySlug($slug);
        $plans = $this->getDependencie('plans_repository')->getAllBySlug($slug);
        $students = $this->getDependencie('students_repository')->getAllBySlug($slug);
        $categories = $this->getDependencie('categories_repository')->getAllBySlug($slug);

        return $this->createStructToListEntities([
            self::CATEGORIES['key'] => [$categories, []],
            self::STUDENTS['key'] => [$students, []],
            self::PLANS['key'] => [$plans, []],
            self::MODALITIES['key'] => [$modalities, []],
        ]);
    }

    private function createStructToListEntities(array $data)
    {
        $map = [];
        foreach ($data as $key => $row) {
            $const = strtoupper($key);

            list($rows, $selecteds) = $row;
            $map[$key] = array_merge(constant(self::class . '::' . $const), ['rows' => $rows, 'selecteds' => $selecteds]);
        }

        return $map;
    }

    public function getDataToShow(Historic $historic)
    {
        $slug = $historic->getSlug();
        $savedEntities = $historic->entities;

        $modalities = $this->getDependencie('modalities_repository')->getAllBySlug($slug);
        $plans = $this->getDependencie('plans_repository')->getAllBySlug($slug);
        $students = $this->getDependencie('students_repository')->getAllBySlug($slug);
        $categories = $this->getDependencie('categories_repository')->getAllBySlug($slug);

        $selectedGrouped = [];
        foreach ($savedEntities as $savedEntity) {
            $selectedGrouped[$savedEntity->getEntityType()][] = $savedEntity->getEntityId();
        }

        return $this->createStructToListEntities([
            self::CATEGORIES['key'] => [$categories, $selectedGrouped[self::CATEGORIES['key']] ?? []],
            self::STUDENTS['key'] => [$students, $selectedGrouped[self::STUDENTS['key']] ?? []],
            self::PLANS['key'] => [$plans, $selectedGrouped[self::PLANS['key']] ?? []],
            self::MODALITIES['key'] => [$modalities, $selectedGrouped[self::MODALITIES['key']] ?? []],
        ]);
    }

    public function syncOnStore(Historic $historic, array $data)
    {
        $struct = $this->createStructToSync($data);

        foreach (array_filter($struct) as $row) {
            $this->getDependencie('historic_entities_repository')->attach($historic, $row);
        }
    }

    public function syncOnUpdate(Historic $historic, array $data)
    {
        $struct = $this->createStructToSync($data);
        $slug = $historic->getSlug();

        $diff = $this->diffBetweenEntitiesToSyncAndStored($historic, $slug, $struct);

        foreach ($diff as $action => $entities) {
            switch ($action)
            {
                case 'to_update':
                    break;
                case 'to_delete':
                    foreach ($entities as $entityKey => $primaryKeys) {
                        $this->getDependencie('historic_entities_repository')->deleteByCondition([
                            'entity_type' => $entityKey,
                            'id' => $primaryKeys
                        ]);
                    }
                    break;
                case 'to_create':
                    foreach ($entities as $entityKey => $dataToAttach) {
                        $this->getDependencie('historic_entities_repository')->attach($historic, $dataToAttach);
                    }
                    break;
            }
        }
    }

    private function diffBetweenEntitiesToSyncAndStored($historic, int $slug, array $dataToSync)
    {
        $cache = [
            'to_delete' => [],
            'to_create' => [],
            //'to_update' => [],
        ];

        foreach ($dataToSync as $key => $row) {

            $savedEntities = $historic->entitiesByType($key);

            if ($savedEntities->count() == 0) {
                $cache['to_create'][$key] = $dataToSync[$key];
                continue;
            }

            foreach ($savedEntities as $savedEntity) {
                $savedEntityId = $savedEntity->getEntityId();
                $savedPrimaryId = $savedEntity->getId();

                if (array_key_exists($savedEntityId, $dataToSync[$key])) {
                    unset($dataToSync[$key][$savedEntityId]);
                    continue; //is updating
                }

                if (!isset($cache['to_delete'][$key])) {
                    $cache['to_delete'][$key] = [];
                }

                $cache['to_delete'][$key][] = $savedPrimaryId;
            }

            if (!empty($dataToSync[$key])) {
                $cache['to_create'][$key] = $dataToSync[$key];
                unset($dataToSync[$key]);
            }
        }

        return $cache;
    }

    private function createStructToSync(array $data)
    {
        $struct = [];

        foreach ([self::MODALITIES, self::PLANS, self::STUDENTS, self::CATEGORIES] as $config) {

            if (empty($data[$config['key']])) {
                $struct[$config['key']] = [];
                continue;
            }

            $keys = array_values($data[$config['key']]);
            $values = array_map(function () use ($config) {
                return ['entity_type' => $config['key']];
            }, $data[$config['key']]);

            $struct[$config['key']] = array_combine($keys, $values);
        }

        return $struct;
    }
}
