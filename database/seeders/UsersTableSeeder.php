<?php

namespace Database\Seeders;

use App\Models\Admins\AdminUser;
use App\Models\Admins\AdminUserInfo;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new AdminUser();
        $user->username = 'havit';
        $user->password = bcrypt('havit');
        $user->active_status = true;
        $user->is_super_admin = true;
        $user->save();

        if(!empty($user)){
            $userInfo = new AdminUserInfo();
            $userInfo->admin_user_id = $user->id;
            $userInfo->full_name = 'Sarbendra';
            $userInfo->email = 'admin@havit.com';
            $userInfo->phone_number = '9860672399';
            $userInfo->address = 'Thankot';
            $userInfo->save();
        }
    }
}
