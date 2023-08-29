<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getproductsByTenantId(int $tenant_id, array $categories);
    public function getProductByUuid(string $uuid);
}