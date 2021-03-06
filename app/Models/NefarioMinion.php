<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Validation\Rule;

class NefarioMinion extends Pivot implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['minion_id', 'nefario_id'];

    protected $with = ['minion', 'nefario'];

    public function minion(): HasOne {
        return $this->hasOne(User::class, 'id', 'minion_id');
    }

    public function nefario(): HasOne {
        return $this->hasOne(User::class, 'id', 'nefario_id');
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'minion_id' =>['required','integer', Rule::exists('users','id')->where(function($q) {
                return $q->where('role_id', Role::$minion);
            })],
            'nefario_id'=>['required','integer', Rule::exists('users','id')->where(function($q) {
                return $q->where('role_id', Role::$nefario);
            })]
        ];
    }

    static function getUpdateData(): array
    {
        return [];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
