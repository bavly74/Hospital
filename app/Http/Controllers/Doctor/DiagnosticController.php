<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\DiagnosticInterface;
use App\Repositories\DoctorDashboard\DiagnosticRepository;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    protected $diagnostic;
    public function __construct(DiagnosticInterface $diagnostic){
        $this->diagnostic = $diagnostic;
    }

    public function index(){

    }



    public function create(){
        $this->diagnostic->create();
    }


    public function store(Request $request){
       return $this->diagnostic->store($request);
    }
    public function storeReview(Request $request){
        return $this->diagnostic->storeReview($request);
    }


    public function show($id){
        return $this->diagnostic->show($id);

    }



    public function edit($id){

    }


    public function update($request){

    }


    public function destroy($id){

    }
}
