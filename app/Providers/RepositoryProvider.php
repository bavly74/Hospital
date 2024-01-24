<?php

namespace App\Providers;

use App\Repositories\Doctors\DoctorRepository;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Repositories\Sections\SectionRepository;
use App\Interfaces\Sections\SectionRepositoryInterface;
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
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);

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
