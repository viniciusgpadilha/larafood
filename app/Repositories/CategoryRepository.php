<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
                    ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                    ->where('tenants.uuid', $uuid)
                    ->select('categories.*')
                    ->get();
    }

    public function getCategoriesByTenantId(int $tenant_id)
    {
        return DB::table($this->table)
                    ->where('tenant_id', $tenant_id)
                    ->get();
    }

    public function getCategoryByUuid(string $uuid)
    {
        return DB::table($this->table)
                    ->where('uuid', $uuid)
                    ->first();
    }
}