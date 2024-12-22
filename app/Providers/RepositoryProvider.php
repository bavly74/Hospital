<?php

namespace App\Providers;
use App\Interfaces\DoctorDashboard\DiagnosticInterface;
use App\Interfaces\DoctorDashboard\InvoiceInterface;
use App\Interfaces\DoctorDashboard\LabInterface;
use App\Interfaces\DoctorDashboard\RaysInterface;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Repositories\DoctorDashboard\DiagnosticRepository;
use App\Repositories\DoctorDashboard\InvoiceRepository;
use App\Repositories\DoctorDashboard\LabRepository;
use App\Repositories\DoctorDashboard\RaysRepository;
use App\Repositories\Finance\PaymentRepository;

use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Repositories\Finance\ReceiptRepository;

use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Interfaces\Insurance\InsuranceRepositoryInterface;
use App\Interfaces\Patient\PatientRepositoryInterface;
use App\Repositories\Ambulance\AmbulanceRepository;
use App\Repositories\Doctors\DoctorRepository;
use App\Repositories\Insurance\InsuranceRepository;
use App\Repositories\Patient\PatientRepository;
use App\Repositories\Services\ServiceRepository;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Repositories\Sections\SectionRepository;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Admin
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(InvoiceInterface::class, InvoiceRepository::class);

        //Doctor
        $this->app->bind(DiagnosticInterface::class, DiagnosticRepository::class);
        $this->app->bind(RaysInterface::class, RaysRepository::class);
        $this->app->bind(LabInterface::class, LabRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
