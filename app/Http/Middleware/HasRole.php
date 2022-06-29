<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param int $role
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next, int $role): JsonResponse
    {
        $user = $request->user();
        if ($user->role->id == $role) {
            return $next($request);
        }
        return Controller::unauthorizedResponse();
    }
}
