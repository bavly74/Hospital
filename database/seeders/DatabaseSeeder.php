<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
$this->call([
    UserSeeder::class,
    AdminSeeder::class,
    AppointmentTableSeeder::class,
    SectionTableSeeder::class,
    DoctorTableSeeder::class,
    ImageTableSeeder::class,
    PatientTableSeeder::class,
    ServiceTableSeeder::class ,
    InsuranceTableSeeder::class,
    AmbulanceTableSeeder::class,

]);


    }
}
