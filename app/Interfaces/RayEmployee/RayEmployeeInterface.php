<?php

namespace App\Interfaces\RayEmployee;

interface RayEmployeeInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);
    public function destroy($request,$id);
}
