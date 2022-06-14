<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    protected function getModel(): string
    {
        return 'App\Models\User';
    }
}
