<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Indicator extends Model implements ResourceModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'date', 'value', 'type'];

    public static $MIN_DATE = 'min_date';
    public static $MAX_DATE = 'max_date';
    public static $MAX_NUM = 'max_numeric';
    public static $MIN_NUM = 'min_numeric';

    public static function TYPES (): array {
        return [self::$MIN_DATE, self::$MAX_DATE, self::$MAX_NUM, self::$MIN_NUM];
    }

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'value'=>'required_without:date|integer',
            'date'=>'required_without:value|date',
            'type'=>['required', 'string', Rule::in(Indicator::TYPES())],
            'name'=>'string|unique:indicators',
        ];
    }

    static function getUpdateData(): array
    {
        return [
            'value'=>'required_without:date|integer',
            'date'=>'required_without:value|date'
        ];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
