<?php

namespace App\Providers;

use App\Contracts\CountryFiller;
use App\Models\PersonalAccessToken;
use App\Services\RestCountriesService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CountryFiller::class, function () {
            return new RestCountriesService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Model::preventSilentlyDiscardingAttributes();

        if (app()->isProduction()) {
            URL::forceScheme('https');
        }
    }
}
