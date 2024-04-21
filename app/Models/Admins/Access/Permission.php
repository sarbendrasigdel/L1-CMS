<?php

namespace App\Models\Admins\Access;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{

    protected $table= 'permissions';

    public static function grouped($guard)
    {
        $permissions = self::where('guard_name', $guard)->get();

        $grouped_permission = [];

        foreach ($permissions as $key => $permission) {
            $grouped_permission[$permission->key_name][] = $permission;
        }

        return $grouped_permission;
    }
}
