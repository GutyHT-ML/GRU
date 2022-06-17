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
        return response()->json($this->baseResponse($index));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $requestData = $request->only($this->getModel()::getStoreData());
        $instance = $this->getModel()::create($requestData);
        return response()->json($this->baseResponse($instance));
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
        return response()->json($this->baseResponse($instance));
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
        $requestData = $request->only($this->getModel()::getUpdateData());
        $instance = $this->getModel()::find($id);
        $instance->update($requestData);
        return response()->json($this->baseResponse($instance));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $instance = $this->getModel()::withTrashed()->find($id);
        if ($instance->trashed()) {
            $instance->restore();
        } else {
            $instance->delete();
        }
        return response()->json($this->baseResponse($instance));
    }

}