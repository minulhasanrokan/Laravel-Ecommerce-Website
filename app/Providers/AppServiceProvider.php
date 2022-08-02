<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
Use Cart;

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

        view()->composer('*', function ($view) {
            $getContent= Cart::getContent();

            $totalCarttQty = Cart::getTotalQuantity();
            $totalCartSubTotal = Cart::getSubTotal();

            $view->with('getCartContents',  $getContent);
            $view->with('totalCarttQty',  $totalCarttQty);
            $view->with('totalCartSubTotal',  $totalCartSubTotal);
        });
    }
}
