<?php

namespace Database\Seeders;

use App\Models\PersonalCarBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalCarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonalCarBrand::factory()->count(10)->create();
    }
}
