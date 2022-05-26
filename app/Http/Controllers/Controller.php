<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function baseResponse ($data): array
    {
        return [
            'status'=>true,
            'msg'=>'Hecho!',
            'data'=>$data
        ];
    }

    public function badRequest ($msg): array
    {
        return [
            'status'=>false,
            'msg'=>'Error!',
            'data'=>$msg
        ];
    }

    public function unauthorizedResponse (): array
    {
        return [
            'status' => false,
            'msg' => 'Acceso no autorizado',
            'data' => null
        ];
    }

    /**
     * @param Request $request
     * @param array $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate(Request $request, array $rules): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), $rules);
    }
}
