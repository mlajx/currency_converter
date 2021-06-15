<?php

namespace App\Providers;

use App\Contracts\CurrencyQuoteContract;
use App\Services\CurrencyQuote;
use Illuminate\Support\ServiceProvider;

class CurrencyQuoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyQuoteContract::class, CurrencyQuote::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
