<?php

namespace App\Repositories\PatientDashboard;

use App\Interfaces\PatientDashboard\PatientInterface;
use App\Models\Invoice;
use App\Models\Lab;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class PatientRepository implements PatientInterface
{
    public function invoices(){
        $invoices=Invoice::where('patient_id',Auth::User()->id)->get();
        return view('dashboard.patientDashboard.invoices',compact('invoices'));
    }
    public function rays(){
        $rays=Ray::where('patient_id',Auth::User()->id)->get();
        return view('dashboard.patientDashboard.rays',compact('rays'));
    }

    public function labs(){
        $laboratories =Lab::where('patient_id',Auth::User()->id)->get();
        return view('dashboard.patientDashboard.labs',compact('laboratories'));
    }

    public function showLab($id){
        return $id ;
    }

    public function showRay($id){
        $rays = Ray::with('images','patient')->where('patient_id',$id)->first();
        return view('dashboard.ray-employee-admin.invoices.show',compact('rays'));
    }

}
