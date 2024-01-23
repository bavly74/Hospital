<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{  use HasFactory;
    use Translatable; 
    protected $fillable =['name','description'];
    public $translatedAttributes = ['name','description'];
  
}
