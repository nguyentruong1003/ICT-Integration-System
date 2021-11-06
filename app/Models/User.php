<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

//use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    //use HasFactory, Notifiable, HasRoles, HasApiTokens, SoftDeletes;
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'gw_user_id',
        'gw_pass',
        'lang',
        'group_id',
        'user_info_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }

    public function info()
    {
        return $this->belongsTo(UserInf::class, 'user_info_id');
    }

    public function notificationConfig()
    {
        return $this->hasMany(SystemConfig::class, 'admin_id')->where('type', ESystemConfigType::NOTIFICATION)->first();
    }

    public function group()
    {
        return $this->belongsTo(GroupUser::class, 'group_id');
    }

    private static $searchable = [
        'name'
    ];
    public static function getListSearchAble()
    {
        return self::$searchable;
    }

    /**
     * @return \App\Models\User[]
     */
    public function getDepartmentLeaders()
    {
        $department = $this->info->department ?? null;
        if (empty($department)) {
            return null;
        }
        $positionIds = MasterData::query()->where('type', 1)->whereIn('order_number', [1, 2])->get('id')->pluck('id')->all();
        return $department->userInfos()->with('account')->whereIn('position_id', $positionIds)->get()->pluck('account');
    }

    protected static function boot()
    {
        parent::boot();
    }
}
