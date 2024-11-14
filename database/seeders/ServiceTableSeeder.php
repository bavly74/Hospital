<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<30;$i++){
            Service::create([
                'price'=>rand(100,5000),
                'description'=>Str::random(50),
                'name'=>Str::random(10),
                'status'=>1
            ]);
        }
    }
}
