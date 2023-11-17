<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $name_role = ['admin','manger','employee'];
            $name_permission = ['create_user','edit_user','delete_user','create_client','edit_client','delete_client','create_task','edit_task','delete_task'];

                 foreach ($name_role as $role)
                {
                    $role = Role::create(['name' => $role]);
                }
                foreach ($name_permission as $permission)
                {
                    $role = Permission::create(['name' => $permission]);
                }
    }
}
