<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['guard_name' => 'admin', 'name' => 'Admin']);
        $teacherRole = Role::create(['guard_name' => 'teacher', 'name' => 'Teacher']);
        $studentRole = Role::create(['guard_name' => 'student', 'name' => 'Student']);
        $agencyRole = Role::create(['guard_name' => 'trainingAgency', 'name' => 'TrainingAgency']);

        $adminPermissions = Permission::where('guard_name', 'admin')->pluck('id');
        $teacherPermissions = Permission::where('guard_name', 'teacher')->pluck('id');
        $studentPermissions = Permission::where('guard_name', 'student')->pluck('id');
        $agencyPermissions = Permission::where('guard_name', 'trainingAgency')->pluck('id');

        $adminRole->syncPermissions($adminPermissions);
        $teacherRole->syncPermissions($teacherPermissions);
        $studentRole->syncPermissions($studentPermissions);
        $agencyRole->syncPermissions($agencyPermissions);
    }
}
