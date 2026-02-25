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
        $basketPreviewItems = collect();
        $basketTotal = 0;

        if (auth()->check()) {

            $basket = Basket::with(['items.product'])
                ->where('userID', auth()->user()->userID)
                ->where('orderStatus', 'cart')
                ->first();

            if ($basket) {
                $basketPreviewItems = $basket->items;
                $basketCount = $basketPreviewItems->sum('quantity');
                $basketTotal = $basketPreviewItems->sum(fn($item) => $item->product->productPrice * $item->quantity);
            }
        }

        $view->with('basketCount', $basketCount);
        $view->with('basketPreviewItems', $basketPreviewItems);
        $view->with('basketTotal', $basketTotal);
    });
    }
}
