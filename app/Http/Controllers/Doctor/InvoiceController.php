<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\InvoiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $invoice;
    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    public function index()
    {
        return $this->invoice->index();
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
