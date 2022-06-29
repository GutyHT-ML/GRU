<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function baseResponse ($data): JsonResponse
    {
        return response()->json(
            [
                'status'=>true,
                'msg'=>'Hecho!',
                'data'=>$data
            ],
            200
        );
    }

    public static function notAllowed (): JsonResponse
    {
        return response()->json([
            'status'=>false,
            'msg'=>'Accion no peritida',
            'data'=>null
        ], 403);
    }

    public static function badRequest ($msg = 'Error!'): JsonResponse
    {

        return response()->json([
            'status'=>false,
            'msg'=>$msg,
            'data'=>null
        ], 400);
    }

    public static function unauthorizedResponse (): JsonResponse
    {
        return response()->json([
            'status' => false,
            'msg' => 'Acceso no autorizado',
            'data' => null
        ], 401);
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
