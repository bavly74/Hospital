<?php

namespace App\Interfaces\PatientDashboard;

interface PatientInterface
{
    public function invoices();
    public function rays();

    public function labs();

    public function showLab($id);

    public function showRay($id);
}
