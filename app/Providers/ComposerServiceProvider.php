<?php

namespace App\Providers;

use App\Services\ApiServiceInterface;
use http\Client\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view)  {
            $currencyConversion = app(ApiServiceInterface::class);

            $response = $currencyConversion->convertCurrency('USD', 'VND', '100');

            $view->with('response', $response);
        });
    }
}
