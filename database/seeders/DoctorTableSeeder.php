<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{

    public function run()
    {
        // إنشاء 30 دكتور باستخدام الفاكتوري
        $doctors = Doctor::factory()->count(30)->create();

        // الحصول على جميع المواعيد
        $appointments = Appointment::all();

        // ربط كل دكتور بعدد عشوائي من المواعيد
        $doctors->each(function ($doctor) use ($appointments) {
            // ربط الدكتور بمواعيد عشوائية باستخدام العلاقة many-to-many
            $doctor->doctorappointments()->attach(
                $appointments->random(rand(1, 7))->pluck('id')->toArray()
            );
        });
    }
}
