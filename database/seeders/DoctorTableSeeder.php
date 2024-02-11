<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Appointment;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $doctors =  Doctor::factory()->count(30)->create();


        foreach ($doctors as $doctor){
            $Appointments = Appointment::all()->random()->id;
            $doctor->doctorappointments()->attach($Appointments);
        }


        //
    //    Doctor::all()->each(function ($doctor) use ($Appointments) {
    //        $doctor->doctorappointments()->attach(
    //            $Appointments->random(rand(1,7))->pluck('id')->toArray()
    //        );
    //    });
    }
}
