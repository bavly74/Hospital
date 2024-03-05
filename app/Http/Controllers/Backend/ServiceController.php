<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
class ServiceController extends Controller
{
    private $service;
    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service=$service;

    }

    public function index()
    {
       return $this->service->index();
    }


    public function store(ServiceRequest $request)
    {
        return $this->service->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
