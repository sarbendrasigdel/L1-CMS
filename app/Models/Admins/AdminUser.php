<?php

namespace App\Models\Admins;

use App\Library\AdminUserHierarchy;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;

class AdminUser extends Authenticatable
{
    use HasRoles, Notifiable;
    use SoftDeletes;

    protected $guard = 'admin-user';

    protected $dates = ['deleted_at'];



    public function latestAdminUserInfo(){
        return $this->hasOne(AdminUserInfo::class, 'admin_user_id')->orderBy('id', 'desc');
    }

    public function adminUserInfoDetails(){
        return $this->hasMany(AdminUserInfo::class, 'admin_user_id');
    }

    public function adminUserInfoDetail(){
        return $this->hasOne(AdminUserInfo::class, 'admin_user_id');
    }

//    public function notificationConfig(){
//        return $this->hasMany(NotificationUsers::class, 'model_id')->where('model_type', 'App\Models\Admins\AdminUser');
//    }

    /*===== END OF RELATIONS =======*/

    public function scopeFilteredByUsername($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->where('username', 'LIKE', '%'.$search.'%')->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->orderBy('created_at', 'desc');
                }]);
            }
        }else{
            if($search != ''){
                return $query->where('username', 'LIKE', '%'.$search.'%');
            }
        }
    }

    public function scopeFilteredByEmail($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->where('email', $search)->orderBy('created_at', 'desc');
                }]);
            }
        }else{
            if($search != ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($search){
                    $q->where('email', $search);
                });
            }
        }
    }

    public function scopeFilteredByDesignation($query, $search, $log){
        if($search != ''){
            if($log){
                return $query->with(['adminUserInfoDetails' => function($q) use($search){
                    $q->whereHas('designation', function($quer) use($search){
                        $quer->whereIn('designation_id', $search);
                    });
                }]);
            }else{
                return $query->with(['latestAdminUserInfo.latestDesignation'=> function($q) use($search){
                    $q->whereIn('designation_id', $search);
                }]);
            }
        }
    }



    public function scopeFilteredByPhoneNumber($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->where('phone_number', $search)->orderBy('created_at', 'desc');
                }]);
            }
        }else{
            if($search != ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($search){
                    $q->where('phone_number', $search);
                });
            }
        }
    }

    public function scopeFilteredByAddress($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->where('address', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
                }]);
            }
        }else{
            if($search != ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($search){
                    $q->where('address', 'LIKE', '%'.$search.'%');
                });
            }
        }
    }

    public function scopeFilteredByActiveStatus($query, $search){
        if($search != ''){
            return $query->where('active_status',$search);
        }
    }

    public function scopeFilteredByCreatedDate($query, $search, $date, $log){
        if(!$log){
            if($search != '' && $date == ''){
                return $query->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->where('created_at', '<=', $search)->orderBy('created_at', 'desc')->take(1);
                }]);
            }
        }else{
            if($search != '' && $date == ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($search){
                    $q->where('created_at', '<=', $search);
                });
            }
        }
    }

    public function scopeFilterByDateRange($query, $date1, $date2, $log){
        if($log){
            if($date1 != '' && $date2 != ''){
                return $query->with(['adminUserInfoDetails' => function($q) use($date1, $date2){
                    if($date1 > $date2){
                        $q->where('created_at', '>=', $date2)->where('created_at', '<=', $date1);
                    }else if($date2 > $date1){
                        $q->where('created_at', '>=', $date1)->where('created_at', '<=', $date2);
                    }else{
                        $q->where('created_at', '<=', $date2);
                    }
                }]);
            }
        }else{
            if($date1 != '' && $date2 != ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($date1, $date2){
                    if($date1 > $date2){
                        $q->where('created_at', '>=', $date2)->where('created_at', '<=', $date1);
                    }else if($date2 > $date1){
                        $q->where('created_at', '>=', $date1)->whereDate('created_at', '<=', $date2);
                    }else{
                        $q->where('created_at', '<=', $date2);
                    }
                });
            }

        }
    }

    public function scopeFilteredByCreatedBy($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->whereHas('adminUserInfoDetails.adminUserCreatedBy', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
                });
            }
        }else{
            if($search != ''){
                return $query->whereHas('latestAdminUserInfo.adminUserCreatedBy', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%');
                });
            }
        }
    }

    public function scopeFilteredByFullName($query, $search, $log){
        if($log){
            if($search != ''){
                return $query->with(['adminUserInfoDetails'=> function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
                }]);
            }
        }else{

            if($search != ''){
                return $query->whereHas('latestAdminUserInfo', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%');
                });
            }
        }
    }

    public function scopeFilterByGlobalSearch($query, $search){
        if($search != ''){
            return $query->where('username', 'LIKE', '%'.$search.'%')
                ->orWhereRaw("IF(active_status = 1, 'Active', 'InActive') like ?",[$search])
                ->orWhereHas('adminUserInfoDetails', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%')
                        ->orWhereDate('created_at', $search)
                        ->orWhere('address', 'LIKE', '%'.$search.'%')
                        ->orWhere('phone_number', $search)
                        ->orWhere('email', $search);
                })->orWhereHas('adminUserInfoDetails.adminUserCreatedBy', function($q) use($search){
                    $q->where('full_name', 'LIKE', '%'.$search.'%');
                })->orWhereHas('adminUserInfoDetails.designation.designation', function($q) use($search){
                    $q->where('display_name', 'LIKE', '%'.$search.'%');
                });
        }
    }

    public function scopeFilterSuperAdmin($query){
        return $query->where('is_super_admin', false);
    }



}
