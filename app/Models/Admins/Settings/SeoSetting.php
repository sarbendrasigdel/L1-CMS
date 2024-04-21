<?php

namespace App\Models\Admins\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoSetting extends Model
{
    use SoftDeletes;

    public function adminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'created_by_admin_users_info_id');
    }

    public function updatedByAdminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'updated_by_admin_users_info_id');
    }

    public function scopeSeoPageName($query,$pageName)
    {
        return $query->where('page_name', $pageName);
    }

    public function scopeFilterByGlobalSearch($query, $search){
        if($search != ''){
            return $query->where('page_name', 'LIKE', '%'.$search.'%')
                ->orWhereRaw("IF(active_status = 1, 'Active', 'InActive') like ?", '%'.$search. '%');
        }
    }
}
