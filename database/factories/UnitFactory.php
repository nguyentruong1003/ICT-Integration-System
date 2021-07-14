<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit_name' => $this->faker->jobTitle(),
            'unit_id' =>  Str::upper(Str::random(6)),
            'unit_father' => "None",
            'created_by' => "Faker",          
            'updated_by' => "Faker",
            //
        ];
    }
}
