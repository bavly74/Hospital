<?php

namespace App\Http\Controllers\PatientDashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\PatientDashboard\PatientInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patient;
    public function __construct (PatientInterface $patient){
        $this->patient = $patient;
    }
    public function invoices(){
        return $this->patient->invoices();
    }

    public function rays()
    {
        return $this->patient->rays();
    }

    public function labs(){
        return $this->patient->labs();
    }

    public function showLab($id){
        return $this->patient->showLab($id);
    }

    public function showRay($id){
        return $this->patient->showRay($id);
    }
}
