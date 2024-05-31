<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins\Pagesettings\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $service = new Service();
                $service->title = 'Branding And Identity Design';
                $service->description = 'Our creative agency is a team of professionals focused on helping your brand grow.';
                $service->category_id = '1';
                $service->active_status =  true;
                $service->created_by_admin_users_info_id = '1';
                $service->save();
    }
}
