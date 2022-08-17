<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracingController extends ResourceController
{

    protected function getModel(): string
    {
        return 'App\Models\Tracing';
    }

    public function store(Request $request): JsonResponse
    {
        $validation = $this->validate($request, $this->getModel()::getStoreData());
        if ($validation->fails()) {
            return self::badRequest($validation->errors());
        }
        $requestData = $request->only(array_keys($this->getModel()::getStoreData()));
        $requestData['points']= Category::find($requestData['category_id'])->points;
        $instance = $this->getModel()::create($requestData);
        return $this->baseResponse($instance);
    }
}
