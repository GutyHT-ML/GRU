<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class TracingHistory extends Model implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'tracing_ids', 'period_start', 'period_end'];

    protected $with = ['user'];

    protected $casts = [
        'tracing_ids' => 'array'
    ];

    public function getTracingsAttribute(): Collection
    {
        return Tracing::query()
            ->whereIn('id', $this->tracing_ids)
            ->get();
    }

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
            'user_id' =>[
                'required',
                'integer',
                Rule::exists('users','id')->where(function($q) {
                return $q->where('role_id', Role::$minion);
            })],
            'tracing_ids'=>'required|array',
            'period_start'=>'required|date|before:period_end',
            'period_end'=>'required|date|after:period_start'
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
