<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatedAttributes=['name'];
    protected $fillable=['name'];
// Model Appointment.php

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'appointment_doctor');
    }



}
