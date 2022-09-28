<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Illuminate\Support\Collection $countries */
        $countries = Country::select('id')->get();

        User::factory()
            ->count(100)
            ->state(new Sequence(
                fn ($sequence) => ['country_id' => $countries->random()],
            ))
            ->create();
    }
}
