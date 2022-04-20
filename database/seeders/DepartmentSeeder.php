<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Department::create([
            'id' => 1,
            'name' => 'Phòng Giám đốc',
            'code' => 'DEVCEO',
            'description' => 'Phòng giám đốc',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Department::create([
            'id' => 2,
            'name' => 'Phòng Hành chính Nhân sự',
            'code' => 'DEVHCNS',
            'description' => 'Phòng hành chính nhân sự',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Department::create([
            'id' => 3,
            'name' => 'Phòng Công Nghệ PHP',
            'code' => 'DEVPHP',
            'description' => 'Phòng developers, ngôn ngữ php',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Department::create([
            'id' => 4,
            'name' => 'Phòng Công Nghệ Java',
            'code' => 'DEVJAVA',
            'description' => 'Phòng developers, ngôn ngữ java',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Department::create([
            'id' => 5,
            'name' => 'Phòng Công Nghệ React',
            'code' => 'DEVREACT',
            'description' => 'Phòng developers, framework react',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
