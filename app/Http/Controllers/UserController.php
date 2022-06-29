<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    protected function getModel(): string
    {
        return 'App\Models\User';
    }

    public function update(Request $request, int $id): JsonResponse
    {
//        return parent::update($request, $id);
    }
}
