<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TenantRepository;

class CategoryService
{
    protected $categoryRepository, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUrl(string $url)
    {
        return $this->categoryRepository->getCategoryByUrl($url);
    }
}