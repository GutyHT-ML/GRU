<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class History extends Model implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'period_start', 'period_end'];

    protected $with = ['tracings', 'user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tracings(): BelongsToMany {
        return $this->belongsToMany(
            Tracing::class,
            'tracing_history',
            'history_id',
            'tracing_id',
            'id',
            'id'
        )->using(TracingHistory::class);
    }

    static function getIndexData(): array
    {
    }

    static function getStoreData(): array
    {
    }

    static function getUpdateData(): array
    {
    }

    static function getDeleteData(): array
    {
    }
}
