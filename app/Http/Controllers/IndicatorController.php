<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function index() : JsonResponse
    {
        $index = Indicator::all();
        return $this->baseResponse($index);
    }

    public function show(Request $request, int $id) : JsonResponse
    {
        return $this->notAllowed();
    }

    public function destroy (int $id): JsonResponse
    {
        return $this->notAllowed();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $inst = Indicator::find($id);
        if ($inst) {
            $requestData = $request->only(Indicator::getUpdateData());
            if ($inst->type == Indicator::$MAX_DATE || $inst->type == Indicator::$MIN_DATE) {
                if (array_search('date', $requestData, true)) {
                    $inst->date = $requestData['date'];
                    $inst->save();
                    return $this->baseResponse($inst);
                }
                return $this->badRequest('El campo fecha es requerido');
            } else if ($inst->type == Indicator::$MAX_NUM || $inst->type == Indicator::$MIN_NUM) {
                if (array_search('value', $requestData, true)) {
                    $inst->value = $requestData['value'];
                    $inst->save();
                    return $this->baseResponse($inst);
                }
                return $this->badRequest('El valor es requerido');
            } else {
                return $this->badRequest();
            }
        }
        return $this->badRequest();
    }
}
