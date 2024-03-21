<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
<<<<<<< HEAD
    use Translatable; 
    use HasFactory;
    protected $fillable =['name','description'];
=======
    use Translatable;
    use HasFactory;
    protected $guarded=[];
>>>>>>> fff3bce05da4ab03f3ab28c42c9ea6f50f13fbd2
    public $translatedAttributes = ['name'];
}
