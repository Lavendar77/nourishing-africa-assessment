<?php

namespace App\Services;

use App\Contracts\CountryFiller;
use App\Models\Country;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class RestCountriesService implements CountryFiller
{
    private PendingRequest $restCountries;

    /**
     * Create a new instance of RestCountriesService.
     */
    public function __construct()
    {
        $this->restCountries = Http::baseUrl(config('restcountries.base_url'));
    }

    /**
     * Fill the database with countries.
     *
     * @return void
     */
    public function fillCountriesInStorage(): void
    {
        $restCountriesApi = $this->restCountries->get('/v3.1/all?fields=name');

        if ($restCountriesApi->successful()) {
            $restCountries = $restCountriesApi->collect()->map(function ($country) {
                return [
                    'id' => str()->orderedUuid()->toString(),
                    'name' => $country['name']['common'],
                ];
            })->toArray();

            Country::query()->upsert($restCountries, ['name']);
        }
    }
}
