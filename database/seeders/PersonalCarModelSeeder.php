<?php

namespace Database\Seeders;

use App\Models\PersonalCarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalCarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonalCarModel::factory()->count(10)->create();
    }
}
