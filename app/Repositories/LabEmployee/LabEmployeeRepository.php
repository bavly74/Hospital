<?php

namespace App\Repositories\LabEmployee;

use App\Interfaces\LabEmployee\LabEmployeeInterface;
use App\Models\LabEmployee;
use Illuminate\Support\Facades\Hash;

class LabEmployeeRepository implements LabEmployeeInterface
{
    public function index(){
        $lab_employees = LabEmployee::select(['name', 'email','created_at','id'])->get();
        return view('dashboard.lab_employees.index',compact('lab_employees'));
    }
    public function create(){

    }
    public function store($request){
        LabEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('add');
        return redirect()->back();
    }
    public function edit($id){

    }
    public function update($request,$id){
        LabEmployee::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('edit');
        return redirect()->back();
    }
    public function destroy($request,$id){
        LabEmployee::where('id',$id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
