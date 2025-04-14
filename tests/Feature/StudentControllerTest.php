<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Laravel\Passport\Passport;

class StudentControllerTest extends TestCase
{
    public function test_get_all_students()
    {
        $userMock = \Mockery::mock(User::class)->makePartial();
        $userMock->shouldReceive('hasRole')->with('admin')->andReturn(true);
        Passport::actingAs($userMock);

        $response = $this->get('/api/students');
        $response->assertStatus(200);
    }


    public function test_create_student()
    {

        $faker = Faker::create();
        $randomDni = rand(10000000, 99999999);
        $randomEmail = $faker->unique()->safeEmail;

        $data = [
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
