<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Errir create new client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'Sunda Tido',
            'email' => 'sunda@teste.com.br',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
                    // ->assertSimilarJson([
                    //     'message' => 'The given data was invalid.',
                    //     'errors' => [
                    //         'password' => [trans('validation.required', ['attribute' => 'password'])]
                    //     ]
                    // ]);
    }

    public function testCreateNewClient()
    {
        $payload = [
            'name' => 'Sunda Tido',
            'email' => 'sunda@teste.com.br',
            'password' => '123456',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
                    ->assertSimilarJson([
                        'data' => [
                            'name' => $payload['name'],
                            'email' => $payload['email'],
                        ]
                    ]);
    }
}
