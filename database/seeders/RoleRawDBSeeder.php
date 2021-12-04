<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRawDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_accountant = Role::updateOrCreate(['name' => 'accountant', 'guard_name' => 'web']);
        $role_hrm = Role::updateOrCreate(['name' => 'hrm', 'guard_name' => 'web']);
        $role_technican = Role::updateOrCreate(['name' => 'technician', 'guard_name' => 'web']);

        $permission_hrm = Permission::where('name', 'like', 'admin.employee.' . '%')
                                    ->orwhere('name', 'like', 'admin.unit.' . '%')
                                    ->orwhere('name', 'like', 'admin.' . '%' . '.index')
                                    ->where('name', 'not like', 'admin.system' . '%' . '.index')->get();
        $role_hrm->syncPermissions($permission_hrm);
    }
}
