<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends ResourceController
{
    protected function getModel(): string
    {
        return "App\Models\Role";
    }
}
