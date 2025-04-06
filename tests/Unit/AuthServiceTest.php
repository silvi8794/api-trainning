<?php

namespace Tests\Unit;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthService;
use App\Models\User;
use Tests\TestCase;
use Mockery;


class AuthServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_register()
    {

        Hash::shouldReceive('make')->once()->andReturn('fake-hashed-password');

        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('createToken')->once()->andReturn((object) ['accessToken' => 'fake-token']);

        $userModelMock = Mockery::mock();
        $userModelMock->shouldReceive('create')->once()->andReturn($userMock);

        $userMock->shouldReceive('assignRole')->once()->with('coach');

        $service = new AuthService($userModelMock);
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'role' => 'coach'

        ];

        $result = $service->register($data);

        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);
        $this->assertEquals('fake-token', $result['token']);
    }

    public function test_login_with_wrong_credentials()
    {
        Auth::shouldReceive('attempt')->andReturn(false);

        $userModelMock = Mockery::mock();

        $authService = new AuthService($userModelMock);
        $credentials = ['email' => 'wrong@example.com', 'password' => 'wrongpass'];

        $response = $authService->login($credentials);

        $this->assertEquals(401, $response->status());
        $this->assertEquals(['error' => 'Incorrect Credentials'], $response->getData(true));
    }
}
