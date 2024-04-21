<?php

namespace App\Models\Admins;

use App\Models\Admins\Access\Permission;
use App\Models\Notifications\Notification;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUserInfo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function notification() {

        return $this->hasMany(Notification::class, 'admin_user_info_id');

    }

    public function adminUser(){
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }

    public function adminUserCreatedBy(){
        return $this->belongsTo(AdminUserInfo::class, 'user_created_by_users_info_id');
    }

    public function adminUserUpdatedBy()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'user_updated_by_users_info_id');
    }

    public function role(){
        return $this->hasMany('\App\Models\Admins\Access\Role', 'created_by_admin_users_info_id');
    }

    public function latestDesignation(){
        return $this->hasOne('\App\Models\Admins\UserDesignation', 'admin_users_info_id')->orderBy('id', 'desc');
    }

    public function designation(){
        return $this->hasOne('\App\Models\Admins\UserDesignation', 'admin_users_info_id');
    }



    public function userPermissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'user_permissions','model_id','permission_id');
    }

}
