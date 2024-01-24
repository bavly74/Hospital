<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctors;
    public function __construct(DoctorRepositoryInterface $doctors){
        $this->doctors = $doctors;
    }
  
    public function index()
    {
        return $this->doctors->index();
    }

   
    public function create()
    {
        return $this->doctors->create();

    }


    public function store(Request $request)
    {
        return $this->doctors->store($request);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
