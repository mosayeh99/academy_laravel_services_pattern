<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin Seeder
        $admin = Admin::create([
            'name' => 'محمد السايح',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $admin->assignRole('Admin');
    }
}
