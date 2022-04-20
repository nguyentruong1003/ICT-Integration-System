<?php

namespace Database\Factories;

use App\Enums\EMasterData;
use App\Models\Department;
use App\Models\Employee;
use App\Models\MasterData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::upper(Str::random(5)),
            'name' => $this->faker->lastName() . ' ' . $this->faker->firstName(),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'sex' => $this->faker->numberBetween(1,2),
            'department_id' => Department::pluck('id')->random(),
            'position_id' => MasterData::where('type', EMasterData::TYPE_POSITION)->pluck('id')->random(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
