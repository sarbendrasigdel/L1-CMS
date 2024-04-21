<?php

namespace App\Library;


use App\Models\UserPermission;

trait SyncPermission{

    public function addPermissionsLog($model, $permissions)
    {
        for($i=0; $i<count($permissions); $i++){
            $userPermission = new UserPermission();
            $userPermission->model_id = $model->id;
            $userPermission->permission_id = $permissions[$i];
            $userPermission->model_type = get_class($model);
            $userPermission->save();
        }
    }
}