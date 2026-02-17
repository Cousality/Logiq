<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Basket;

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
       View::composer('*', function ($view) {

        $basketCount = 0;

        if (auth()->check()) {

            $basket = Basket::where('userID', auth()->user()->userID)
                ->where('orderStatus', 'cart')
                ->first();

            if ($basket) {
                $basketCount = $basket->items()->sum('quantity');
            }
        }

        $view->with('basketCount', $basketCount);
    });
    }
}
