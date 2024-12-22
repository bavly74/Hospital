<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Lab;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetails extends Controller
{
    public function index($id){
        $patient_records = Diagnostic::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();

        $patient_Laboratories= Lab::where('patient_id',$id)->get();
        return view('dashboard.doctor-admin.invoices.patient_details',compact('patient_records','patient_rays','patient_Laboratories'));
    }
}
