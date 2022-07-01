<?php

namespace App\Http\Controllers;

use App\Models\ResourceModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    abstract protected function getModel(): string;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $index = $this->getModel()::all();
        return $this->baseResponse($index);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validation = $this->validate($request, $this->getModel()::getStoreData());
        if ($validation->fails()) {
            return self::badRequest($validation->errors());
        }
        $requestData = $request->only(array_keys($this->getModel()::getStoreData()));
        $instance = $this->getModel()::create($requestData);
        return $this->baseResponse($instance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $instance = $this->getModel()::find($id);
        return $this->baseResponse($instance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validation = $this->validate($request, $this->getModel()::getUpdateData());
        if ($validation->fails()) {
            return self::badRequest($validation->errors());
        }
        $requestData = $request->only(array_keys($this->getModel()::getUpdateData()));
        $instance = $this->getModel()::find($id);
        $instance->update($requestData);
        return $this->baseResponse($instance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $instance = $this->getModel()::withTrashed()->find($id);
        if ($instance->trashed()) {
            $instance->restore();
        } else {
            $instance->delete();
        }
        return $this->baseResponse($instance);
    }
}
