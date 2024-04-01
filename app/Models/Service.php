<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   use Translatable;
    use HasFactory;
    protected $fillable =['name','description'];

    protected $guarded=[];

    public $translatedAttributes = ['name'];
}
