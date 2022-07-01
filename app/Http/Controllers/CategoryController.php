<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\Category';
    }
}
