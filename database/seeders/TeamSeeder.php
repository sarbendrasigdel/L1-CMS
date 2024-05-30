<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins\Pagesettings\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = new Team();
        $team->name = 'Sarbendra Sigdel';
        $team->image = '/file-manager/photos/1/1685455212542.jpeg';
        $team->position = 'Founder';
        $team->facebook = 'https://www.facebook.com/profile.php?id=100080940488035';
        $team->instagram = 'https://www.instagram.com/hell__riderr/';
        $team->twitter = 'https://www.x.com';
        $team->github = 'https://github.com/sarbendrasigdel';
        $team->featured = 1;    
        $team->active_status = true;
        $team->created_by_admin_users_info_id = 1;
        $team->save();

    }
}
