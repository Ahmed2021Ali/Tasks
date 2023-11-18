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
            $name_permission = ['user.store','user.update','user.destroy','user.report_of_user','client.store','client.update','client.destroy','task.store','task.update','task.destroy'];
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
