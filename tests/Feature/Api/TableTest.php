<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error Get Tables by Tenant.
     *
     * @return void
     */
    public function testErrorGetAllTablesByTenantError()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    public function testErrorGetTableByTenant()
    {
        $table = 'fake_value';

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    public function testGetTableByTenant()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
