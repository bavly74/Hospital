<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\LabInterface;
use Illuminate\Http\Request;

class LabController extends Controller
{

    protected $labs ;
    public function __construct(LabInterface $labs){
        $this->labs = $labs;
    }

    public function store(Request $request){
        return $this->labs->store($request);
    }

    public function update(Request $request,$id){
        return $this->labs->update($request,$id);
    }

    public function destroy(Request $request,$id){
        return $this->labs->destroy($request,$id);
    }
}
