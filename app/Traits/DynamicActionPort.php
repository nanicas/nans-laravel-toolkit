<?php

namespace Zevitagem\LaravelToolkit\Traits;

use Zevitagem\LaravelToolkit\Exceptions\ValidatorException;
use Zevitagem\LaravelToolkit\Exceptions\CustomValidatorException;
use App\Helpers\Helper;
use Illuminate\Http\Request;

trait DynamicActionPort
{
    public function dynamicAction(Request $request, string $action = '', int $id = 0)
    {
        if (method_exists($this, $action)) {
            return $this->$action($request, $action, $id);
        }

        $message = '';
        $status = false;
        $data = $request->all();
        $result = null;

        if (empty($id) && empty($action)) {
            $id = $request->input('id');
            $action = $request->input('action');
        }

        try {
            $service = $this->getService();
            $service->configureIndex('request', $request);

            $result = $service->{$action}($id, $data);
            $status = (!empty($result));

            $message = (empty($result)) ? 'Ocorreu um problema durante o processamento dessa ação de "' . $action . '"' : 'Ação executada com sucesso!';

            $message = Helper::loadMessage($message, $status);
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = Helper::loadMessage($ex->getMessage(), $status);
        }

        return $this->responseDynamicAction(compact(
            'action', 'status', 'message', 'data', 'result', 'request', 'id'
        ));
    }

    protected function responseDynamicAction(array $data)
    {
        extract($data);

        echo json_encode(Helper::createDefaultJsonToResponse($status,
            [
                'result' => $result,
                'message' => $message,
            ]
        ));
    }
}
