<?php

namespace App\Interfaces\DoctorDashboard;

use Illuminate\Http\Request;

interface InvoiceInterface
{
    public function index($status);



    public function create();


    public function store($request);



    public function show($id);



    public function edit($id);


    public function update($request);


    public function destroy($id);
}
