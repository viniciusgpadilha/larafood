<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface 
{
    // public function getProductsByTenantUuid(string $uuid);
    public function getProductsByTenantId(int $tenant_id);
    // public function getProductByUrl(string $url);
}