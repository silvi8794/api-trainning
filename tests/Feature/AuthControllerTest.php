<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Mockery;
use App\Http\Services\AuthService;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_returns_token_when_credentials_are_valid()
    {
        $mockService = Mockery::mock(AuthService::class);
        $mockService->shouldReceive('login')
            ->once()
            ->with(['email' => 'admin@example.com', 'password' => 'secret'])
            ->andReturn('mocked-jwt-token');

        $controller = new AuthController($mockService);

        $request = Request::create('/api/login', 'POST', [
            'email' => 'admin@example.com',
            'password' => 'secret'
        ]);

        $response = $controller->login($request);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(['token' => 'mocked-jwt-token'], $response->getData(true));
    }

    public function test_login_returns_unauthorized_when_credentials_are_invalid()
    {
        $mockService = Mockery::mock(AuthService::class);
        $mockService->shouldReceive('login')
            ->once()
            ->with(['email' => 'admin@example.com', 'password' => 'wrongpass'])
            ->andReturn(null);

        $controller = new AuthController($mockService);

        $request = Request::create('/api/login', 'POST', [
            'email' => 'admin@example.com',
            'password' => 'wrongpass'
        ]);

        $response = $controller->login($request);

        $this->assertEquals(401, $response->status());
        $this->assertEquals(['error' => 'Unauthorized'], $response->getData(true));
    }
}
