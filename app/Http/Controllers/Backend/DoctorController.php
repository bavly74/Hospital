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

    public function edit($id)
    {
       return $this->doctors->edit($id);
    }


    public function update(Request $request)
    {
        return $this->doctors->update($request);
    }

    public function delete(Request $request)
    {
       return $this->doctors->delete($request);
    }

    public function updatePassword($request){
        return $this->doctors->updatePassword($request);

    }
}
