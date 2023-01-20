<?php

namespace Database\Factories;

use App\Models\PersonalCarBrand;
use App\Models\PersonalCarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalCar>
 */
class PersonalCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'year' => $this->faker->year(),
            'personal_car_brand_id' => PersonalCarBrand::inRandomOrder()->first()->id,
            'personal_car_model_id' => PersonalCarModel::inRandomOrder()->first()->id,
            'is_manual' => $this->faker->boolean,
            'exterior_color' => $this->faker->word(),
            'purchase_amount' => $this->faker->randomNumber(8),
            'current_value' => $this->faker->randomNumber(9),
            'sales_amount' => 0,
            'date_purchased' => $this->faker->date(),
        ];
    }
}
