<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\Image\ImageInterface;
use App\Services\Image\ImageService;
use App\View\Composer\BrandComposer;
use App\View\Composer\CategoryComposer;
use App\View\Composer\ProductComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['Backend.Product.create','Backend.Category.index'], CategoryComposer::class);
        View::composer(['Backend.Product.create','Backend.brand.index'], BrandComposer::class);
        View::composer(['Backend.Product.index'], ProductComposer::class);


        // image service bingin section..
        $this->app->bind(ImageInterface::class, ImageService::class);
    }
}
