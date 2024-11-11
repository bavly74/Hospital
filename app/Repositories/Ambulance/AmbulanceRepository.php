<?php

namespace App\Repositories\Ambulance;

use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Models\Ambulance;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index(){
        $ambulances = Ambulance::all();
        return view('dashboard.ambulance.index', compact('ambulances'));
    }
    public function create(){
        return view('dashboard.ambulance.create');
    }

    public function store($request){
        try {
            $ambulance = new Ambulance();
            $ambulance->car_number=$request->car_number;
            $ambulance->car_model=$request->car_model;
            $ambulance->car_year_made=$request->car_year_made;
            $ambulance->car_type=$request->car_type;
            $ambulance->driver_name=$request->driver_name;
            $ambulance->driver_license_number=$request->driver_license_number;
            $ambulance->driver_phone=$request->driver_phone;
            $ambulance->notes=$request->notes;
            $ambulance->save();
            session()->flash('add');
            return redirect()->route('ambulance.index');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function edit($id){
        $ambulance = Ambulance::findOrFail($id);
        return view('dashboard.ambulance.edit', compact('ambulance'));
    }

    public function update($request){
        try{
            $ambulance=Ambulance::findOrFail($request->id);
            $ambulance->car_number=$request->car_number;
            $ambulance->car_model=$request->car_model;
            $ambulance->car_year_made=$request->car_year_made;
            $ambulance->car_type=$request->car_type;
            $ambulance->driver_name=$request->driver_name;
            $ambulance->driver_license_number=$request->driver_license_number;
            $ambulance->driver_phone=$request->driver_phone;
            $ambulance->notes=$request->notes;
            $ambulance->is_available=$request->is_available ? 1 : 0;
            $ambulance->save();
            session()->flash('edit');
            return redirect()->route('ambulance.index');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function destroy($request){
        Ambulance::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('ambulance.index');
    }

}
