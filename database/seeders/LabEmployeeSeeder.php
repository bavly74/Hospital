<?php

namespace Database\Seeders;

use App\Models\LabEmployee;
use Illuminate\Database\Seeder;

class LabEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LabEmployee::factory(10)->create();
    }
}
