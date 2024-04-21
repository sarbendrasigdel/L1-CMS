<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    public function logByAdminUser(){
        return $this->belongsTo(AdminUserInfo::class, 'admin_users_info_id');
    }
}
