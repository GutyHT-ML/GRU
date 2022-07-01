<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model implements ResourceModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['name'];

    protected $hidden = [];

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public static $minion = 1;
    public static $nefario = 2;
    public static $gru = 3;


    /**
     * @return string[]
     */
    public static function getAbilities (int $id) : array {
        switch ($id) {
            case 2:
                return Role::$nefarioAbilities;
                break;
            case 3:
                return Role::$gruAbilities;
                break;
            default:
                return Role::$minionAbilities;
                break;
        }
    }

    public static $minionAbilities = [
        'minion:read', 'minion:update'
    ];

    public static $nefarioAbilities = [
        'nefario:create', 'nefario:read', 'nefario:update', 'nefario:delete'
    ];

    public static $gruAbilities = [
        'gru:create', 'gru:read', 'gru:update', 'gru:delete'
    ];

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return [
            'name'=>'required|string'
        ];
    }

    static function getUpdateData(): array
    {
        return [
            'name'=>'required|string'
        ];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
