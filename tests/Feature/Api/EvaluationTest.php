<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class EvaluationTest extends TestCase
{
    /**
     * Test Error Create New Evaluation.
     *
     * @return void
     */
    public function testErrorCreateNewEvaluation()
    {
        $order = 'fake_value';

        $response = $this->postJson("api/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

        /**
     * Test Create New Evaluation.
     *
     * @return void
     */
    public function testCreateNewEvaluation()
    {
        $client = factory(Client::class)->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = factory(Order::class, 10)->create(['client_id' => $client->id]);

        $payload = [
            'stars' => 5,
            'comment' => Str::random(10),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        $response = $this->postJson(
            "api/auth/v1/orders/{$order}/evaluations",
            $payload,
            $headers
        );

        $response->assertStatus(200);
    }
}
