<?php

namespace App\Models\Admins;

use App\Library\AdminUserHierarchy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Designation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function adminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'created_by_admin_users_info_id');
    }

    public function updatedByAdminUserInfo()
    {
        return $this->belongsTo('\App\Models\Admins\AdminUserInfo', 'updated_by_admin_users_info_id');
    }

    public function userDesignation(){
        return $this->hasMany(UserDesignation::class, 'designation_id');
    }

    /*====== END OF RELATION =========*/


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
                ->orWhereDate('created_at', $search)
                ->orWhereHas('adminUserInfo', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%');
                })
                ->orWhereRaw("IF(active_status = 1, 'Active', 'InActive') like ?",[$search]);
        }
    }

}
