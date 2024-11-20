<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupInvoice extends Model
{
    use HasFactory;
    public function Group(){
        return $this->belongsTo(Group::class);
    }
    public function Patient(){
        return $this->belongsTo(Patient::class);
    }
    public function Doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function Section(){
        return $this->belongsTo(Section::class);
    }
}
