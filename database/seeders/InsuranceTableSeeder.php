<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InsuranceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            Insurance::create([
                'insurance_code'=>Str::uuid(),
                'discount_percentage'=>rand(20,50),
                'Company_rate'=>rand(50,80),
                'status'=>1 ,
                'name'=>Str::random(10),
                'notes'=>Str::random(30),
            ]);
        }
    }
}
