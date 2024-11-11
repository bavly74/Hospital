<?php

namespace App\Repositories\Insurance;

use App\Interfaces\Insurance\InsuranceRepositoryInterface;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceRepository implements InsuranceRepositoryInterface
{

    public function index()
    {
        $insurances = Insurance::all();
        return view('dashboard.insurance.index', compact('insurances'));
    }

    public function create(){
        return view('dashboard.insurance.create');
    }
    public function store($request){
        try{
            $insurance = new Insurance();
            $insurance->insurance_code=$request->insurance_code;
            $insurance->discount_percentage=$request->discount_percentage;
            $insurance->Company_rate=$request->Company_rate;
            $insurance->name=$request->name;
            $insurance->notes=$request->notes;
            $insurance->status = 1;
            $insurance->save();
            session()->flash('add');
            return redirect()->route('insurance.index');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function edit($id){
    $insurances = Insurance::findorFail($id);
    return view('dashboard.insurance.edit', compact('insurances'));
    }

    public function update($request){
        try {
            $insurance =Insurance::findorFail($request->id);
            if (isset($insurance)) {
                $insurance->insurance_code=$request->insurance_code;
                $insurance->discount_percentage=$request->discount_percentage;
                $insurance->Company_rate=$request->Company_rate;
                $insurance->name=$request->name;
                $insurance->notes=$request->notes;
                $insurance->status = $request->status ? 1 : 0;
                $insurance->save();
                session()->flash('edit');
                return redirect()->route('insurance.index');
            }

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    public function destroy($request){
            Insurance::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('insurance.index');
    }


}
