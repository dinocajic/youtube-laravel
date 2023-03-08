<?php

namespace Database\Seeders;

use App\Models\PersonalCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonalCar::factory()->count(10)->create();
    }
}
