<?php

namespace App\Repositories\DoctorDashboard;

use App\Interfaces\DoctorDashboard\RaysInterface;
use App\Models\Ray;

class RaysRepository implements RaysInterface
{
    public function store($request){
        Ray::create([
            'doctor_id' => $request->doctor_id,
            'description' => $request->description,
            'patient_id' => $request->patient_id,
            'invoice_id' => $request->invoice_id,
        ]);
        return redirect()->back()->with(['success' => 'lab created successfully']);
    }

    public function update($request,$id){
        Ray::where('id', $id)->update([

            'description' => $request->description,

        ]);
        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($request,$id){
        Ray::where('id', $id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
