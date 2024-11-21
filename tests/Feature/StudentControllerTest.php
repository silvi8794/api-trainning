<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;
class StudentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_all_students()
    {

        $response = $this->get('/api/students');
        $response->assertStatus(200);
    }


    public function test_create_student()
    {
        
        $faker = Faker::create();
        $randomDni = rand(10000000, 99999999);
        $randomEmail = $faker->unique()->safeEmail; 

        $data =[
            'dni' => $randomDni,
            'given_name' => 'Maria',
            'family_name' => 'Suarez',
            'email' => $randomEmail,
            'bithdate' => '1990-01-01',
        ];

        $response = $this->post('/api/students', $data);
        $response->assertStatus(201);


        $this->assertDatabaseHas('students', $data);
    }

    public function test_get_student_by_id()
    {
        $response = $this->get('/api/students/1');
        $response->assertStatus(200);
    }
}
