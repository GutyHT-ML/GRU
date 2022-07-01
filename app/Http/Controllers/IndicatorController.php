<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndicatorController extends ResourceController
{
    protected function getModel(): string
    {
        return 'App\Models\Indicator';
    }
}
