<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tracing extends Model implements ResourceModel
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'category_id'];

    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'description'=>'required|string',
            'user_id'=>'required|integer|exists:users,id',
            'category_id'=>'required|integer|exists:categories,id'
        ];
    }

    static function getUpdateData(): array
    {
        return [
            'description'=>'required|string',
            'category_id'=>'required|integer|exists:categories,id'
        ];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
