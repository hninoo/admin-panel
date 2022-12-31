<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles, LogsActivity;

    // The attributes that will recorded when changes occurs
    protected static $logAttributes = ['*'];

    /**
     * Set the default guard for this model.
     *
     * @var string
     */
    protected $guard_name = 'admin';

    protected $dates = ['created_at', 'updated_at', 'logintime', 'createtime'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeFilter($query, $filters)
    {
        $filters->apply($query);
    }

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    public static function updateTime()
    {
        self::where('id', auth('admin')->user()->id)->update([
            'logintime' => now()
        ]);
    }
}
