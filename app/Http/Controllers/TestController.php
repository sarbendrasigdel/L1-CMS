<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins\AdminUser;

class TestController extends Controller
{
    public function index()
    {  $user = AdminUser::get();

        return view("test",compact("user"));
    }

    public function getData()
    {
        $user = AdminUser::get();

        return response()->json([
            "name" => $user->username,
        ]);

    }
}
