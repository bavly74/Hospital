<?php

namespace App\Interfaces\DoctorDashboard;

interface DiagnosticInterface
{

    public function index();



    public function create();


    public function store($request);

    public function storeReview($request);

    public function show($id);



    public function edit($id);


    public function update($request);


    public function destroy($id);

    public function updateInvoiceStatus($invoice_id,$status);

}
