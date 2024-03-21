<?php
namespace App\Repositories\Services;
use App\Models\Service;
use App\Interfaces\Services\ServiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
class ServiceRepository implements ServiceRepositoryInterface{
    public function index(){
        $services=Service::all();
        return view('dashboard.services.single-services.index',compact('services'));


    }
    public function store($request){
        $request->validate([
        'name'=>'required',
        'price'=>'required',
        ]);

        $service= new Service();
        $service->name=$request->name;
        $service->price=$request->price;
        $service->description=$request->description;
        $service->status = 1;
        $service->save();
        session()->flash('add');
        return redirect()->route('single-services.index');
    }

    public function update($request){
        $service=Service::where('id',$request->id)->first();
        $service->price = $request->price;
        $service->description = $request->description;
        $service->status = $request->status;
    
        $service->name = $request->name;
        $service->save();
        session()->flash('edit');
        return redirect()->route('single-services.index');
        
    }
    public function delete($request){
        Service::where('id',$request->id)->delete();
        session()->flash('delete');
        return redirect()->route('single-services.index');
    }
}
    

