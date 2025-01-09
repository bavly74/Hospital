<?php

namespace App\Interfaces\DoctorDashboard;

interface RaysInterface
{
    public function store($request);
    public function update($request,$id);
    public function destroy($request,$id);

    public function show($id);

}
