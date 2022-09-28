<?php

namespace Database\Seeders;

use App\Contracts\CountryFiller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \App\Contracts\CountryFiller $countryFiller
     * @return void
     */
    public function run(CountryFiller $countryFiller)
    {
        $countryFiller->fillCountriesInStorage();
    }
}
