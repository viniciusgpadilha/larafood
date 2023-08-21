<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\{
    Plan,
    Tenant,
    Product,
    Category
};

use App\Observers\{
    PlanObserver,
    TenantObserver,
    ProductObserver,
    CategoryObserver
};

use App\Repositories\Contracts\{
    TenantRepositoryInterface
};

use App\Repositories\{
    TenantRepository
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
