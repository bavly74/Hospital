<?php

namespace App\Http\Controllers\RayEmployee;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployeeDashboard\InvoiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $rayEmployeeInvoice;
    public function __construct(InvoiceInterface $rayEmployeeInvoice)
    {
        $this->rayEmployeeInvoice = $rayEmployeeInvoice;
    }
    public function index($id){
        return $this->rayEmployeeInvoice->index($id);
    }
    public function edit($id){
        return $this->rayEmployeeInvoice->edit($id);
    }

    public function update(Request $request, $id){
        return  $this->rayEmployeeInvoice->update($request,$id);
    }
    public function show($id){
        return  $this->rayEmployeeInvoice->show($id);

    }
}
