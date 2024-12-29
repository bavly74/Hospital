<?php

namespace App\Interfaces\RayEmployeeDashboard;

interface InvoiceInterface
{
    public function index();
    public function edit($id);
    public function update($request,$id);

}
