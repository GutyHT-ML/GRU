<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Indicator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\Category';
    }

    public function store(Request $request): JsonResponse
    {
        $validation = $this->validate($request, $this->getModel()::getStoreData());
        if ($validation->fails()) {
            return self::badRequest($validation->errors());
        }
        $requestData = $request->only(array_keys($this->getModel()::getStoreData()));
        $top = Indicator::firstWhere('type',Indicator::$MAX_NUM);
        $bottom = Indicator::firstWhere('type', Indicator::$MIN_NUM);
        if ($requestData['points'] >= $bottom->value && $requestData['points'] <= $top->value) {
            $data = $this->getModel()::create($requestData);
            return self::baseResponse($data);
        }
        return self::badRequest('Los puntos deben estar entre '.$bottom->value.' y '.$top->value);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validation = $this->validate($request, $this->getModel()::getUpdateData());
        if ($validation->fails()) {
            return self::badRequest($validation->errors());
        }
        $requestData = $request->only(array_keys($this->getModel()::getUpdateData()));
        $top = Indicator::firstWhere('type',Indicator::$MAX_NUM);
        $bottom = Indicator::firstWhere('type', Indicator::$MIN_NUM);
        if ($requestData['points'] >= $bottom->value && $requestData['points'] <= $top->value) {
            $data = $this->getModel()::find($id);
            if ($data) {
                $data->points = $requestData['points'];
                $data->name = $requestData['name'];
                $data->is_decrement = $requestData['is_decrement'];
                $data->save();
                return self::baseResponse($data);
            }
            return self::badRequest('No se encontro el registro');
        }
        return self::badRequest('Los puntos deben estar entre '.$bottom->value.' y '.$top->value);
    }
}
