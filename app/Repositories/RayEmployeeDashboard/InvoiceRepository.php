<?php

namespace App\Repositories\RayEmployeeDashboard;

use App\Interfaces\RayEmployeeDashboard\InvoiceInterface;
use App\Models\Image;
use App\Models\Ray;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceInterface
{
    use UploadImageTrait;
    public function index()
    {
        $invoices=Ray::all();
        return view('dashboard.ray-employee-admin.invoices.index',compact('invoices'));
    }

    public function edit($id){
        $invoice=Ray::findOrFail($id);
        return view('dashboard.ray-employee-admin.invoices.edit',compact('invoice'));
    }
    public function update($request,$id){
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ],[
            'photo.max' => 'The photo must not exceed 10MB.',
        ]);
        $invoice = Ray::findOrFail($id);

        $invoice->update([
            'case'=>1,
            'employee_id'=>Auth::user()->id,
            'employee_description'=>$request->description_employee,
        ]);
        $filename= $request->photo->getClientOriginalName();
        $request->photo->storeAs('invoices/',$filename, 'upload_image');

        Image::create([
            'filename'=>$filename ,
            'imageable_id'=>Auth::user()->id,
            'imageable_type'=>'App\Models\Ray',
        ]);
        session()->flash('add');
        return back();
    }
}
