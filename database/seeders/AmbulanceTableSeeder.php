<?php

namespace Database\Seeders;

use App\Models\Ambulance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmbulanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Ambulance::create([
                'car_number'=>Str::random(10),
                'notes'=>Str::random(10),
                'driver_name'=>Str::random(10),
                'car_model'=>Str::random(10),
                'car_year_made'=>2020,
                'driver_license_number'=>Str::random(10),
                'driver_phone'=>01212121212,
                'is_available'=>1,
                'car_type'=>2,
            ]);
        }
    }
}
