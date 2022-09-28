<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Country::select('id')->get();

        Company::factory()
            ->count(3)
            ->for(
                User::factory()->state(new Sequence(
                    fn ($sequence) => ['country_id' => $countries->random()],
                ))
            )
            ->state(new Sequence(
                fn ($sequence) => ['country_id' => $countries->random()],
            ))
            ->create();
    }
}
