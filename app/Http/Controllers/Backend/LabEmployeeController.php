<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\LabEmployee\LabEmployeeInterface;
use Illuminate\Http\Request;

class LabEmployeeController extends Controller
{
    protected $labEmployee;
    public function __construct(LabEmployeeInterface $labEmployee){
        $this->labEmployee = $labEmployee;
    }

    public function index(){
        return $this->labEmployee->index();
    }

    public function create(){
        return $this->labEmployee->create();
    }

    public function store(Request $request){
        return $this->labEmployee->store($request);
    }

    public function edit($id){
        return $this->labEmployee->edit($id);
    }

    public function update(Request $request,$id){
        return $this->labEmployee->update($request,$id);
    }

    public function destroy(Request $request,$id){
        return $this->labEmployee->destroy($request,$id);
    }
}
