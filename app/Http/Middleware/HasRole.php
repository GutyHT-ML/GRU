<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param int $role
     * @return Response | JsonResponse
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        $user = $request->user();
        if ($user->role->id == $role) {
            return $next($request);
        }
        return Controller::unauthorizedResponse();
    }
}
