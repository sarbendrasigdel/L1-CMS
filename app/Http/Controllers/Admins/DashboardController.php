<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\UpdatePasswordRequest;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use AuthUser, BreadCrumbs;
    public function __construct()
    {
        $this->middleware('auth:admin-user');
    }

    public function index()
    {
        $data['menu'] = 'dashboard';
        $data['title'] = 'Capital Eye -Dashboard';
        return view('admin.dashboard', $data);
    }

    public function pwChange()
    {
        $data['menu'] = 'dashboard';
        $data['title'] = 'Dashboard';

        return view('layout/admin/menu/user/admin-pw-change', $data);
    }

    function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $user = Auth::guard('admin-user')->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->save();
                $data['logout'] = route('admin.logout');
                $data['status'] = true;
                $data['title'] = 'Password';
                $data['message'] = 'Password Updated Successfully.';
            } else {
                $data['status'] = false;
                $data['title'] = 'Password';
                $data['message'] = 'Old password does not match in system';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Password';
            $data['message'] = $e->getMessage();
        }
        return $data;
    }

}
