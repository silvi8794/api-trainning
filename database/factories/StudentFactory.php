<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->numerify('########'),
            'given_name' => $this->faker->firstName(),
            'family_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'birthdate' => $this->faker->date(),
            'state' => $this->faker->boolean(),
        ];
    }   

}