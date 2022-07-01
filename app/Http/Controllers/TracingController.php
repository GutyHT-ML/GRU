<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TracingController extends ResourceController
{

    protected function getModel(): string
    {
        return 'App\Models\Tracing';
    }
}
