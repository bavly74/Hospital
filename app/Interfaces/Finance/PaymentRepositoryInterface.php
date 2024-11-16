<?php

namespace App\Repositories\Finance;

interface PaymentRepositoryInterface{
    public function index();
    public function create();

    public function store($request);
    public function edit($id);

    public function update($request);

    public function destroy($request);

//    public function show($id);
}
