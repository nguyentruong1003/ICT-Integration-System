<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitRawDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Unit::insert([
            'code' => '00000',
            'name' => 'root',
            'created_by' => '1',
            'created_at' => now(),
        ]);
    }
}
