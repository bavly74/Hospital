<?php

namespace App\Repositories\RayEmployee;

use App\Interfaces\RayEmployee\RayEmployeeInterface;
use App\Models\RayEmployee;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeInterface
{
    public function index(){
        $ray_employees =RayEmployee::all();
        return view('dashboard.rays_employees.index',compact('ray_employees'));
    }
//    public function create(){}
    public function store($request){
        RayEmployee::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);
        session()->flash('add');
        return back();
    }

    public function update($request,$id){
        RayEmployee::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('edit');
        return back();
    }
    public function destroy($request,$id){
        RayEmployee::destroy($id);
        session()->flash('delete');
        return back();
    }

}
