<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use translatable;
    use HasFactory;

    public $translatedAttributes = ['driver_name','notes'];
    protected $guarded = [];
}
