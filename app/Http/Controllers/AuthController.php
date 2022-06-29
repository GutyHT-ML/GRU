<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Signup for users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function signup (Request $request): JsonResponse
    {
        $validator = $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'username' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($this->badRequest($validator->errors()));
        }
        $user = User::create([
            'name'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ]);
        if ($user) {
            return response()->json($this->baseResponse($user));
        }
        return response()->json($this->badRequest([]));
    }

    /**
     * Login for users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login (Request $request): JsonResponse
    {
        $validator = $this->validate($request, [
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($this->badRequest($validator->errors()));
        }
        $user = User::firstWhere('email', $request->input('email'));
        if ($user) {
            if ($request->input('password') == $user->password) {
                $abs = Role::getAbilities($user->role->getKey());
                $user->tokens()->delete();
                $d = [
                    'user'=>$user,
                    'token'=>$user->createToken('auth_token', $abs)->plainTextToken
                ];
                return $this->baseResponse($d);
            }
            return $this->unauthorizedResponse();
        }
        return $this->unauthorizedResponse();
    }
}
