<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins\Pagesettings\category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new category();
        $category->name = 'Technology';
        $category->description = 'lorem ipsum';
        $category->featured = 1; 
        $category->active_status = true;
        $category->created_by_admin_users_info_id = 1;
        $category->save();

    }
}
