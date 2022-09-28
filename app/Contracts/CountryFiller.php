<?php

namespace App\Contracts;

interface CountryFiller
{
    /**
     * Fill the database with countries.
     *
     * @return void
     */
    public function fillCountriesInStorage(): void;
}
