<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    /**
     * Test Validation Auth.
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test Auth with fake user.
     *
     * @return void
     */
    public function testAuthFakeUser()
    {
        $payload = [
            'email' => 'blabla@teste.com.br',
            'password' => '123123',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                    ->assertSimilarJson([
                        'message' => trans('messages.invalid_credentials')
                    ]);
    }

    /**
     * Test Auth Success.
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = factory(Client::class)->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
                    ->assertJsonStructure(['token']);
    }

    /**
     * Error Get Me.
     *
     * @return void
     */
    public function testErrorGetMe()
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    /**
     * Get Me.
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = factory(Client::class)->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
                    ->assertSimilarJson([
                        'data' => [
                            'name' => $client->name,
                            'email' => $client->email,
                        ]
                    ]);
    }

    /**
     * Test Logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $client = factory(Client::class)->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}
