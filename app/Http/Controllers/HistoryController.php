<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\History';
    }
}
