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


      DB::beginTransaction();
      try{
            $SingleService = new Service();
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = 1;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

        session()->flash('add');
        return redirect()->route('service.index');
      }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);

      }

    }
    public function update($request){

    }
    public function delete($request){

    }
}
