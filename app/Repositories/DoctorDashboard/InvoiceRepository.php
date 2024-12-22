<?php

namespace App\Repositories\DoctorDashboard;

use App\Interfaces\DoctorDashboard\InvoiceInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceInterface
{

    public function index($status){

        $invoices=Invoice::with('patient')->where('doctor_id',Auth::user()->id)->where('invoice_status',$status)->get();
        return view('dashboard.doctor-admin.invoices.index',compact('invoices'));
    }



    public function create(){}


    public function store($request){}



    public function show($id){}



    public function edit($id){}


    public function update($request){ }


    public function destroy($id){

    }
}
