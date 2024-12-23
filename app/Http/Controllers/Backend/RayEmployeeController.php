<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    protected $rayEmployee;
    public function __construct(RayEmployeeInterface $rayEmployee)
    {
        return $this->rayEmployee = $rayEmployee;
    }
    public function index(){
        return $this->rayEmployee->index();
    }

    public function store(Request $request){
        return $this->rayEmployee->store($request);

    }

    public function update(Request $request,$id){
        return $this->rayEmployee->update($request,$id);
    }

    public function destroy(Request $request,$id){
        return $this->rayEmployee->destroy($request,$id);
    }

}
