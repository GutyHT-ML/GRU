<?php

namespace App\Http\Controllers;

use App\Models\NefarioMinion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NefarioMinionController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\NefarioMinion';
    }

    public function index(): JsonResponse
    {
        $user = auth()->user();
        if ($user->role->id == Role::$gru) {
            $index = $this->getModel()::all();
        } else {
            $index = $this->getModel()
                ::where('minion_id', $user->id)
                ->orWhere('nefario_id', $user->id)
                ->get();
        }
        return self::baseResponse($index);
    }

    public function show(int $id): JsonResponse
    {
        $user = auth()->user();
        $inst = $this->getModel()::find($id);
        if ($inst) {
            if ($user->role->id == Role::$gru) {
                return self::baseResponse($inst);
            }
            if ($inst->nefario_id == $user->id) {
                return self::baseResponse($inst);
            }
        }
        return self::badRequest();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->only(array_keys($this->getModel()::getStoreData()));
        if (array_key_exists('minion_id', $requestData)) {
            if (array_key_exists('nefario_id', $requestData)) {
                $minionId = $requestData['minion_id'];
                $nefarioId = $requestData['nefario_id'];
                $user = auth()->user();
                if ($user->id == $nefarioId || $user->role->id == Role::$gru) {
                    $minion = User::find($minionId);
                    $nefario = User::find($nefarioId);
                    if ($minion->role->id != Role::$minion) {
                        return self::badRequest('Usuario minion invalido');
                    }
                    if ($nefario->role->id != Role::$nefario) {
                        return self::badRequest('Usuario nefario invalido');
                    }
                    $nefario->minions()->syncWithoutDetaching([$minionId]);
                    return self::baseResponse($nefario->minions);
                }
                return self::badRequest('Usuario no valido');
            }
            return self::badRequest('Usuario nefario requerido');
        }
        return self::badRequest('Usuario minion requerido');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = auth()->user();
        $nefarioId = $request->input('nefario_id');
        if ($nefarioId) {
            $minion = User::find($id);
            if ($minion) {
                if ($user->role->id == Role::$gru){
                    $nefario = $minion->nefarios->find($nefarioId);
                    if ($nefario) {
                        $nefario->minions()->detach($id);
                        return self::baseResponse($nefario->minions);
                    }
                    return self::baseResponse([]);
                }
                return self::badRequest('Accion no permitida');
            }
            return self::badRequest('Registro no encontrado');
        }
        return self::badRequest('Usuario nefario requerido');
    }
}
