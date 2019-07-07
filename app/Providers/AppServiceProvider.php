<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Catalog;
use Session;
use View;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('modules/header', function($view) {
        //     $catalog = Catalog::all();
        //     $view->with('catalog', $catalog);
        //     View::share('catalog', $catalog);
        // });
        // view()->composer('modules/header', function($view){
        // });
        
        // view()->composer('modules/header_all', function($view) {
        //     $catalog = Catalog::all();
        //     $view->with('catalog', $catalog);
        //     View::share('catalog', $catalog);
        // });

        view()->composer(['modules/header_all', 'modules/header'], function($view){
            if(Cart::content()) {
                $cart = Cart::instance('shopping')->content();
                $catalog = Catalog::all();
                View::share([
                    'cart'      => $cart,   
                    'catalog'   => $catalog                 
                ]);
            }

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
