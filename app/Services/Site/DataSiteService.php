<?php

namespace App\Services\Site;

use App\Services\AbstractService;
use App\Repositories\PlanRepository;
use App\Repositories\SiteEntityRepository;
use App\Repositories\Config\DataConfigRepository;

class DataSiteService extends AbstractService
{
    public function __construct(
        PlanRepository $planRepository,
        SiteEntityRepository $siteEntityRepository,
        DataConfigRepository $dataConfigRepository
    )
    {
        $this->setDependencie('plan_repository', $planRepository);
        $this->setDependencie('site_entity_repository', $siteEntityRepository);
        $this->setDependencie('data_config_repository', $dataConfigRepository);
    }

    public function getIndexData(array $config)
    {
        $data = [];
        $slugId = (is_object($config['slug'])) ? $config['slug']->getPrimaryValue() : null;

        $data['plans'] = $this->getPlans($slugId);
        $data['categories'] = $this->getContents($slugId)['categories'];
        $data['slug_data'] = $this->getSlugConfigData($slugId);

        return $data;
    }

    private function getPlans(?int $slugId)
    {
        return (!empty($slugId)) ? $this->getDependencie('plan_repository')->getBySlug($slugId) : [];
    }

    private function getSlugConfigData(?int $slugId)
    {
        return (!empty($slugId)) ? $this->getDependencie('data_config_repository')->getBySlug($slugId) : [];
    }

    private function getContents(?int $slugId)
    {
        $entities = (!empty($slugId)) ? $this->getDependencie('site_entity_repository')->getEntitiesBySlug($slugId) : [];
        $cache = [
            'categories' => []
        ];

        if (!empty($entities)) {
            foreach ($entities as $row) {

                if (!isset($cache['categories'][$row->category_key])) {
                    $cache['categories'][$row->category_key] = [
                        'category_name' => $row->category_name,
                        'components' => []
                    ];
                }

                if (!isset($cache['categories'][$row->category_key]['components'][$row->component_key])) {
                    $cache['categories'][$row->category_key]['components'][$row->component_key] = [
                        'component_name' => $row->component_name,
                        'entities' => []
                    ];
                }

                $cache['categories'][$row->category_key]['components'][$row->component_key]['entities'][] = $row;
            }
        }

        return $cache;
    }
}
