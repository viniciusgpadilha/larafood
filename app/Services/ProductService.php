<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TenantRepository;

class TableService
{
    protected $tableRepository, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, ProductRepositoryInterface $tableRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function getProductsByTenantId(int $tenant_id)
    {
        $tenant = $this->tenantRepository->getTenantById($uuid);

        return $this->tableRepository->getProductsByTenantId($tenant->id);
    }

    // public function getTableByIdentify(string $identify)
    // {
    //     return $this->tableRepository->getTableByIdentify($identify);
    // }
}