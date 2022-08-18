<?php

namespace App\Models;

use App\Http\Controllers\TracingHistoryController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements ResourceModel
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];


    /**
     * The relationships that are always loaded
     *
     * @var string[]
     */
    protected $with = [
        'role', 'tracings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tracings(): HasMany
    {
        return $this->hasMany(Tracing::class);
    }

    public function tracingHistory(): HasMany
    {
        return $this->hasMany(TracingHistoryController::class);
    }

    public function role() : BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function nefarios(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'nefario_minion',
            'minion_id',
            'nefario_id',
            'id',
            'id'
        )->using(NefarioMinion::class);
    }

    public function minions(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'nefario_minion',
            'nefario_id',
            'minion_id',
            'id',
            'id'
        )->using(NefarioMinion::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function getIndexData(): array
    {
        return [];
    }

    static function getStoreData(): array
    {
        return ['name'=>'required|string', 'email'=>'required|email', 'password'=>'required|string'];
    }

    static function getUpdateData(): array
    {
        return ['name'=>'required|string', 'email'=>'required|email', 'role_id'=>'required|integer|exists:roles,id'];
    }

    static function getDeleteData(): array
    {
        return [];
    }
}
