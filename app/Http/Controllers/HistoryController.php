<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\History';
    }

    public function store(Request $request): JsonResponse
    {
        return self::notAllowed();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }
}
