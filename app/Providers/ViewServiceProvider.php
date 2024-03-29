<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Use a view composer to share data with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $cartCount = Cart::where('user_id', $userId)->sum('quantity'); // Get total quantity of products in the cart
            } else {
                $cartCount = 0; // No user logged in, so no cart items
            }

            $view->with('cartCount', $cartCount); // Share $cartCount with all views
        });
    }
}
