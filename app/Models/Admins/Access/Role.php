<?php

namespace App\Models\Admins\Access;

use App\Library\AdminUserHierarchy;
use App\Library\Dealer\AuthDealerUser;
use App\Library\DoctorUser;
use App\Models\Dealer\DealerUserInfo;
use App\Models\MasterEntry\DoctorUserInfo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes;
    protected $table= 'roles';

    protected $dates = ['deleted_at'];

    public function adminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'created_by_admin_users_info_id');
    }

    public function updatedByAdminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'updated_by_admin_users_info_id');
    }


    public function scopeFilteredByGuardName($query, $search){
        if($search != ''){
            return $query->where('guard_name', $search);
        }
    }

    public function scopeFilteredByName($query, $search){
        if($search != ''){
            return $query->where('name', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeFilteredByDisplayName($query, $search){
        if($search != ''){
            return $query->where('display_name', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeFilteredByCreatedDate($query, $search){
        if($search != ''){
            return $query->whereDate('created_at', $search);
        }
    }

    public function scopeFilteredByCreatedBy($query, $search){
        if($search != ''){
            return $query->whereHas('adminUserInfo', function($q) use($search){
                $q->where('full_name', 'LIKE', '%'.$search.'%');
            });
        }
    }

    public function scopeFilteredByActiveStatus($query, $search){
        if($search != ''){
            return $query->where('active_status', $search);
        }
    }

    public function scopeFilterByGlobalSearch($query, $search){
        if($search != ''){
            return $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('display_name', 'LIKE', '%'.$search.'%')
                ->orWhereDate('created_at', $search)
                ->orWhereHas('adminUserInfo', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%');
                })
                ->orWhereRaw("IF(active_status = 1, 'Active', 'InActive') like ?",[$search]);
        }
    }




}
