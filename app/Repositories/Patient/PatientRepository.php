<?php

namespace App\Repositories\Patient;

use App\Interfaces\Patient\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{
    public function index(){
        $patients=Patient::all();
        return view('dashboard.patient.index',compact('patients'));
    }
    public function create(){
        return view('dashboard.patient.create');
    }
    public function store($request){
        $request->validate([
           'name'=>'required',
           'email'=>'required|email',
           'Date_Birth'=>'required|date',
           'Phone'=>'required',
           'Gender'=>'required',
           'Blood_Group'=>'required',
           'Address'=>'required',
        ]);
        try {
            Patient::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'date_Birth'=> $request->Date_Birth,
                'phone'=> $request->Phone,
                'gender'=> $request->Gender,
                'blood_Group'=> $request->Blood_Group,
                'password'=> Hash::make($request->Phone),
                'address'=> $request->Address,
            ]);
            session()->flash('add');
            return redirect()->route('patient.index');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    //public function show($id){}
    public function edit($id){
        $Patient = Patient::findOrFail($id) ;
        return view('dashboard.patient.edit',compact('Patient'));
    }
    public function update($request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'Date_Birth'=>'required|date',
            'Phone'=>'required',
            'Gender'=>'required',
            'Blood_Group'=>'required',
            'Address'=>'required',
        ]);
        try {
             Patient::findOrFail($request->id)->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'date_Birth'=> $request->Date_Birth,
                'phone'=> $request->Phone,
                'gender'=> $request->Gender,
                'blood_Group'=> $request->Blood_Group,
                'password'=> Hash::make($request->Phone),
                'address'=> $request->Address,
            ]);
            session()->flash('edit');
            return redirect()->route('patient.index');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function destroy($request){
        Patient::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('patient.index');
    }

}
