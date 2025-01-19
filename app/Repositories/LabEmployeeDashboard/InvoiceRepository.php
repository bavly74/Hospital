<?php

namespace App\Repositories\LabEmployeeDashboard;

use App\Interfaces\LabEmployeeDashboard\InvoiceInterface;
use App\Models\Image;
use App\Models\Lab;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceInterface
{
    public function index($case){
        $invoices=Lab::where('case',$case)->get();
        return view('dashboard.lab-employee-admin.invoices.index',compact('invoices'));

    }
    public function show($id){

    }
    public function edit($id){
//        return  $invoice= DB::table('labs')
//            ->join('patients','labs.patient_id','=','patients.id')
//            ->where('labs.id',$id)
//            ->select('labs.*', 'patients.*')
//            ->first();
        $invoice=Lab::with('PatientDashboard')->where('id',$id)->first();
        return view('dashboard.lab-employee-admin.invoices.edit',compact('invoice'));
    }
    public function update($request, $id){
        $invoice = Lab::findOrFail($id);
        $invoice->update([
            'case'=>1,
            'employee_id'=>Auth::user()->id,
            'description_employee'=>$request->description_employee,
        ]);
        if ($request->hasFile('photos')) {
            foreach ($request->photos as $photo) {
                $filename= $photo->getClientOriginalName();
                $photo->storeAs('labs/',$filename, 'upload_image');
                Image::create([
                    'filename'=>$filename ,
                    'imageable_id'=>$invoice->id,
                    'imageable_type'=>'App\Models\Lab',
                ]);
            }
        }
        session()->flash('add');
        return back();
    }
}
