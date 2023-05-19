<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AdminPermissions = [
            'list users',
            'add users',
            'update users',
            'delete users',

            'list courses',
            'add courses',
            'update courses',
            'delete courses',

            'list videos',
            'add videos',
            'update videos',
            'delete videos',

            'list discussions',
            'add discussions',
            'delete discussions',
            'add replies',

            'list classrooms',
            'add classrooms',
            'update classrooms',
            'delete classrooms',

            'list articles',
            'add articles',
            'update articles',
            'delete articles',

            'list trainings',
            'add trainings',
            'update trainings',
            'delete trainings',

            'list letters',
            'approve letters',
            'refuse letters',
            'delete letters',
        ];

        $TeacherPermissions = [
            'list courses',
            'add courses',
            'update courses',
            'delete courses',

            'list videos',
            'add videos',
            'update videos',
            'delete videos',

            'list discussions',
            'add discussions',
            'delete discussions',
            'add replies',

            'list classrooms',
            'add classrooms',
            'update classrooms',
            'delete classrooms',

            'list articles',
            'add articles',
            'update articles',
            'delete articles',
        ];

        $StudentPermissions = [
            'list courses',

            'list videos',

            'list discussions',
            'add discussions',
            'add replies',

            'list classrooms',

            'list trainings',

            'apply letters',
            'delete letters',

            'list articles',
        ];

        $AgencyPermissions = [
            'list trainings',
            'add trainings',
            'update trainings',
            'delete trainings',

            'list letters',
            'approve letters',
            'refuse letters',
        ];


        foreach ($AdminPermissions as $permission)
        {
            Permission::create(['guard_name' => 'admin', 'name' => $permission]);
        }

        foreach ($TeacherPermissions as $permission)
        {
            Permission::create(['guard_name' => 'teacher', 'name' => $permission]);
        }

        foreach ($StudentPermissions as $permission)
        {
            Permission::create(['guard_name' => 'student', 'name' => $permission]);
        }

        foreach ($AgencyPermissions as $permission)
        {
            Permission::create(['guard_name' => 'trainingAgency', 'name' => $permission]);
        }
    }
}
