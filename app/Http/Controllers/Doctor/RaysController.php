<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\RaysInterface;
use Illuminate\Http\Request;

class RaysController extends Controller
{
    protected $rays ;
    public function __construct(RaysInterface $rays){
        $this->rays = $rays;
    }

    public function store(Request $request){
        return $this->rays->store($request);
    }

    public function update(Request $request,$id){
        return $this->rays->update($request,$id);
    }

    public function destroy(Request $request,$id){
        return $this->rays->destroy($request,$id);
    }


}
