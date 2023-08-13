<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        // Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
        //     $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
        //         'secret' => config('app.recaptcha_secret_key'),
        //         'response' => $value,
        //     ]);

        //     return $response['success'];
        // });
    }
}
