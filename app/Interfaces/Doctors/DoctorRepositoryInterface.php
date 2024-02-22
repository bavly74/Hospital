<?php
namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface{
    
public function index();
public function create();
public function edit($id);
public function store($request);
public function update($request);
public function delete($request);
public function updatePassword($request);

}