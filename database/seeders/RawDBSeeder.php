<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RawDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        $role_accountant = Role::updateOrCreate(['name' => 'accountant', 'guard_name' => 'web']);
        $role_hrm = Role::updateOrCreate(['name' => 'hrm', 'guard_name' => 'web']);
        $role_technican = Role::updateOrCreate(['name' => 'technician', 'guard_name' => 'web']);
        $role_staff = Role::updateOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        $permission_hrm = Permission::where('name', 'like', 'admin.employee.' . '%')
                                    ->orwhere('name', 'like', 'admin.unit.' . '%')
                                    ->orwhere('name', 'like', 'admin.' . '%' . '.index')
                                    ->where('name', 'not like', 'admin.system' . '%' . '.index')->get();
        $role_hrm->syncPermissions($permission_hrm);

        $permission_staff = Permission::where('name', 'not like', 'admin.system' . '%' . '.index')
                                    ->orwhere('name', 'not like', 'admin.system' . '%' . '.download')
                                    ->where('name', 'like', 'admin.' . '%' . '.index')->get();
        $role_staff->syncPermissions($permission_staff);

        // unit
        Unit::updateOrCreate([
            'code' => '00000',
            'name' => 'root',
            'created_by' => '1',
            'created_at' => now(),
        ]);
    }
}
