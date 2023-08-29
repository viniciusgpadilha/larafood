<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\{
    Plan,
    Tenant,
    Product,
    Category,
    Client,
    Table
};

use App\Observers\{
    PlanObserver,
    TenantObserver,
    ProductObserver,
    CategoryObserver,
    ClientObserver,
    TableObserver
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
    //
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
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
    }
}
