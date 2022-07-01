<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['name', 'points'];

    function tracings(): HasMany
    {
        return $this->hasMany(Tracing::class);
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'name' => 'required|string',
            'points' => 'required|integer'
        ];
    }

    static function getUpdateData(): array
    {
        return ['name' => 'required|string'];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
