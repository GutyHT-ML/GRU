<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracingHistoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\TracingHistory';
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }
}
