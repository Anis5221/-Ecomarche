<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Role;
use App\Models\Store;
use App\Observers\BrandOvserver;
use App\Observers\CatergoryObserver;
use App\Observers\ProductObserver;
use App\Observers\RoleObserver;
use App\Observers\StoreObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CatergoryObserver::class);
        Brand::observe(BrandOvserver::class);
        Store::observe(StoreObserver::class);
        Role::observe(RoleObserver::class);
        Product::observe(ProductObserver::class);
    }
}
