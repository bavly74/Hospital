<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Interfaces\Insurance\InsuranceRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    protected $insurance;
    public function __construct(InsuranceRepositoryInterface $insurance)
    {
        $this->insurance = $insurance;
    }

    public function index(){
        return $this->insurance->index();
    }

    public function create(){
        return $this->insurance->create();
    }

    public function store(StoreInsuranceRequest $request){
        return $this->insurance->store($request);
    }
    public function edit($id){
        return $this->insurance->edit($id);
    }

    public function update(StoreInsuranceRequest $request){
        return $this->insurance->update($request);
    }

    public function destroy(Request $request){
        return $this->insurance->destroy($request);
    }

}
