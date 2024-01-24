<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           "name"=> $this->faker->unique()->randomElement(['قسم الجرحة','قسم الباطنة','قسم البصريات','قسم العظام','قسم الجلدية']),
           "description"=> $this->faker->paragraph,
        ];
    }
}
