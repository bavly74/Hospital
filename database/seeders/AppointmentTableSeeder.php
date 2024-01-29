<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('appointments')->delete();
       $appointments=[['name'=>'السبت'],
       ['name'=>'الاحد'],
       ['name'=>'الاثنين'],
       ['name'=>'الثلاثاء'],
       ['name'=>'الاربعاء'],
       ['name'=>'الخميس'],
       ['name'=>'الجمعة'],
    ];

foreach($appointments as $appointment)
Appointment::create($appointment);
    }
}
