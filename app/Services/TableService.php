<?php

namespace App\Services;

use App\Repositories\TableRepository;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TenantRepository;

class TableService
{
    protected $tableRepository, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, TableRepositoryInterface $tableRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function getTablesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByUuid(string $uuid)
    {
        return $this->tableRepository->getTableByUuid($uuid);
    }
}