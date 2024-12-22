<?php

namespace App\Interfaces\DoctorDashboard;

interface LabInterface
{

    public function store($request);
    public function update($request,$id);
    public function destroy($request,$id);
}
