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
            'bithdate' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'state' => $this->faker->boolean(),
        ];
    }   

}