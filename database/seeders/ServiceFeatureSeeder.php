<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins\Pagesettings\ServiceFeatures;
class ServiceFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service_feature = new ServiceFeatures();
            $service_feature->name = 'UX Audits';
            $service_feature->description = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don';
            $service_feature->service_id = '1';
            $service_feature->active_status =  true ;
            $service_feature->created_by_admin_users_info_id = '1';
            $service_feature->save();
    }
}
