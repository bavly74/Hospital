<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Repositories\Ambulance\AmbulanceRepository;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    protected $ambulance;
    public function __construct(AmbulanceRepositoryInterface $ambulance){
        $this->ambulance = $ambulance;
    }

    public function index(){
     return   $this->ambulance->index();
    }
    public function create(){
        return   $this->ambulance->create();

    }

    public function store(StoreAmbulanceRequest $request){
        return  $this->ambulance->store($request);

    }

    public function edit($id){
        return  $this->ambulance->edit($id);
    }

    public function update(StoreAmbulanceRequest $request){
        return  $this->ambulance->update($request);
    }

    public function destroy(Request $request){
        return  $this->ambulance->destroy($request);

    }
}
