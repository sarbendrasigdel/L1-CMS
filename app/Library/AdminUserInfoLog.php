<?php

namespace App\Library;

trait AdminUserInfoLog{
    public function compareUserDetailsWithNewData($request, $adminUserInfo)
    {

        $newPermissions = array();
        for($i=0; $i<count($request['permissions']); $i++){
            $newPermissions[] = (int)$request['permissions'][$i];
        }

        $oldPermissions = $adminUserInfo->permissions()->pluck('id')->toArray();

        $newDataArray = array(
            'full_name' => $request['full_name'],
            'designation' => $request['designation'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
        );


        $previousData = array(
            'full_name' => $adminUserInfo->latestAdminUserInfo->full_name,
            'designation' => $adminUserInfo->latestAdminUserInfo->latestDesignation->designation_id,
            'email' => $adminUserInfo->latestAdminUserInfo->email,
            'phone' => $adminUserInfo->latestAdminUserInfo->phone_number,
            'address' => $adminUserInfo->latestAdminUserInfo->address,
        );

        if(count(array_diff($oldPermissions, $newPermissions)) > 0){
            return true;
        }elseif(count(array_diff($newPermissions, $oldPermissions)) > 0){
            return true;
        }elseif(count(array_diff($newDataArray, $previousData)) > 0){
            return true;
        }else{
            return false;
        }
    }
}
