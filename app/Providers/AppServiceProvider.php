<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('GuzzleHttp\Client', function(){
            return new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
                ],
                'base_uri' => 'https://api2.isbndb.com',
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
