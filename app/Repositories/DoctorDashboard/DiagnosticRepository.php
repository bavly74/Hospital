<?php

namespace App\Repositories\DoctorDashboard;

use App\Interfaces\DoctorDashboard\DiagnosticInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;

class DiagnosticRepository implements DiagnosticInterface
{

    public function index(){

    }



    public function create(){

    }


    public function store($request){
         Diagnostic::create([
             'patient_id'=>$request->patient_id,
             'doctor_id'=>$request->doctor_id,
             'diagnosis'=>$request->diagnosis,
             'medicine'=>$request->medicine,
             'invoice_id'=>$request->invoice_id,
             'date'=>now()
         ]) ;
         $this->updateInvoiceStatus($request->invoice_id , 3);

         return redirect()->back()->with('success', 'Diagnostic created successfully');
    }

    public function storeReview($request){
        Diagnostic::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>$request->doctor_id,
            'diagnosis'=>$request->diagnosis,
            'medicine'=>$request->medicine,
            'invoice_id'=>$request->invoice_id,
            'date'=>now(),
            'review_date'=>$request->review_date,
        ]) ;
        $this->updateInvoiceStatus($request->invoice_id , 2);

        return redirect()->back()->with('success', 'Diagnostic created successfully');
    }




    public function show($id){
         $patient_records  = Diagnostic::where('patient_id',$id)->get() ;
        return view('dashboard.doctor-admin.invoices.patient_record',compact('patient_records')) ;

    }



    public function edit($id){

    }


    public function update($request){

    }


    public function destroy($id){

    }


    public function updateInvoiceStatus($invoice_id,$status){
        Invoice::where('id',$invoice_id)->update(['invoice_status'=>$status]);
    }

}
