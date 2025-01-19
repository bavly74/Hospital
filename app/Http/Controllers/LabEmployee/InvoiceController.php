<?php

namespace App\Http\Controllers\LabEmployee;

use App\Http\Controllers\Controller;
use App\Interfaces\LabEmployeeDashboard\InvoiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoice;
    public function __construct(InvoiceInterface $invoice){
        $this->invoice = $invoice;
    }

    public function index($case){
        return $this->invoice->index($case);
    }

    public function show($id){
        return $this->invoice->show($id);
    }

    public function edit($id){
        return $this->invoice->edit($id);
    }

    public function update(Request $request, $id){
        return $this->invoice->update($request, $id);
    }

}
