<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function Patient(){
        return $this->belongsTo(Patient::class);
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
