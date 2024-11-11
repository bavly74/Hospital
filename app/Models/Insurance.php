<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use translatable;
    use HasFactory;
    public $translatedAttributes = ['name','notes'];
    protected $guarded = [];
}
