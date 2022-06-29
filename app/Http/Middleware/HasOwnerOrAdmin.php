<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HasOwnerOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse | RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user->id == $request->route()->parameter('id') || $user->role->id == Role::$gru) {
            return $next($request);
        }
        return Controller::unauthorizedResponse();
    }
}
