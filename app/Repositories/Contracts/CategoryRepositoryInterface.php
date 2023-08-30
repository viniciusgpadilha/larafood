<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface 
{
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenantId(int $tenant_id);
    public function getCategoryByUuid(string $uuid);
}