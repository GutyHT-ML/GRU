<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class TracingHistory extends Model implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'tracings'];

    protected $with = ['user'];

    protected $casts = [
        'tracings' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'user_id' =>['required','integer', Rule::exists('users','id')->where(function($q) {
                return $q->where('role_id', Role::$minion);
            })],
            'tracings'=>'required|array'
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
