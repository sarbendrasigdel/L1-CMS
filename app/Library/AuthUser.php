<?php

namespace App\Library;

use Illuminate\Support\Facades\Auth;
use App\Models\Admins\AdminUserInfo;

trait AuthUser {

    public function getLoggedInUser()
    {
        $user = Auth::guard('admin-user')->user();

        return $user;
    }

    public function getLoggedInUserGuard()
    {
        $guard = (Auth::guard()->check()) ? 'admin-user' : '';

        return $guard;
    }

    public function checkPermission($permission){
        $user = Auth::guard('admin-user')->user();
        if($user->is_super_admin){
            return true;
        }else{
            if($user->hasPermissionTo($permission)){
                return true;
            }else{
                return false;
            }
        }

    }


}