<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = 'kr2021^';
        $user = User::where('name', 'admin_kr')->first();
        if(!$user) {
            $user = User::updateOrCreate([
                'name' => 'admin_kr',
                'email' => 'admin_kr_test@gmail.com',
                'password' => Hash::make('kr2021^'), // password
                "admin" => 1,
            ]);
        }

        $user->password = Hash::make($pass);
        $role = Role::updateOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);
        $user->save();

        $user->assignRole([$role->id]);
    }
}
