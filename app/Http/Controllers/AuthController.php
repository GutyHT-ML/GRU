<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
        $requestData = $request->only(User::$loginData);
        $user = User::firstWhere('email', $requestData->email);
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                $d = [
                    'user'=>$user,
                    'token'=>$user->createToken()->plainTextToken
                ];
                return response()->json(
                    $this->baseResponse($d)
                );
            }
            return response()->json($this->unauthorizedResponse());
        }
        return response()->json($this->unauthorizedResponse());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
