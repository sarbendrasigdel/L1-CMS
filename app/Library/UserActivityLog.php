<?php

namespace App\Library;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\Admins\UserActivity;
use Route;

trait UserActivityLog{

    public function recordActivity ($model, $action)
    {
        try {
            $activity = new UserActivity();
            $activity->model_id = $model->id;
            $activity->model_type = get_class($model);
            $activity->description = 'New '.get_class($model).' is '.$action;
            $activity->content = json_encode($model);
            $activity->ip_address = Request::ip();
            $activity->action = $action;
            $activity->admin_users_info_id = (Auth::guard('admin-user')->check()) ? Auth::guard('admin-user')->user()->id :null;
            $activity->save();
        } catch (\Exception $e) {
            Session::put(trans('messages.exception_thrown'), ['message' => $e->getMessage()]);
        }
    }
}