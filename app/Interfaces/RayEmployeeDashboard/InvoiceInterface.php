<?php

namespace App\Interfaces\RayEmployeeDashboard;

interface InvoiceInterface
{
    public function index($id);
    public function edit($id);
    public function update($request,$id);

}
