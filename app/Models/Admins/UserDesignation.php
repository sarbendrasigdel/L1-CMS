<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class UserDesignation extends Model
{
    public function adminUserInfo(){
        return $this->belongsTo(AdminUserInfo::class, 'admin_users_info_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
