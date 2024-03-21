<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $services;
    public function __construct(ServiceRepositoryInterface $services)
    {
        $this->services=$services;
        
    }
    public function index()
    {
        return $this->services->index();
    }


    
    public function store(Request $request)
    {
        return $this->services->store($request);    
    }

  


    public function update(Request $request)
    {
        return  $this->services->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        return  $this->services->delete($request);

    }
}
