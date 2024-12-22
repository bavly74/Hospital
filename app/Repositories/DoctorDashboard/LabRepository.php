<?php

namespace App\Repositories\DoctorDashboard;

use App\Interfaces\DoctorDashboard\LabInterface;
use App\Models\Lab;

class LabRepository implements LabInterface
{
    public function store($request){
        Lab::create([
            'doctor_id' => $request->doctor_id,
            'description' => $request->description,
            'patient_id' => $request->patient_id,
            'invoice_id' => $request->invoice_id,
        ]);
        return redirect()->back()->with(['success' => 'Lab created successfully']);
    }

    public function update($request,$id){
        Lab::where('id', $id)->update([

            'description' => $request->description,

        ]);
        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($request,$id){
        Lab::where('id', $id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }

}
