<?php

namespace App\Interfaces\LabEmployeeDashboard;

interface InvoiceInterface
{
    public function index($case);
    public function show($id);
    public function edit($id);
    public function update($request, $id);


}
