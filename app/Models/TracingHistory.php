<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Validation\Rule;

class TracingHistory extends Pivot implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['tracing_id', 'history_id'];

    public function tracing(): HasOne
    {
        return $this->hasOne(Tracing::class);
    }

    public function history(): HasOne
    {
        return $this->hasOne(History::class);
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [];
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
