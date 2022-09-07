<?php

namespace App\Providers;

use App\Models\Doctor;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Http\Service\Availability\AvailabilityRegistry;
use App\Http\Service\Availability\ClicRDVAvailabilityService;
use App\Http\Service\Availability\DatabaseAvailabilityService;
use App\Http\Service\Availability\DoctolibAvailabilityService;

class AvailabilityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AvailabilityRegistry::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $registry = $this->app->make(AvailabilityRegistry::class); 
        
        $registry->register(Doctor::AGENDA_DOCTOLIB, new DoctolibAvailabilityService(Config::get('app.availability_api.doctolib')));
        $registry->register(Doctor::AGENDA_CLICRDV, new ClicRDVAvailabilityService(Config::get('app.availability_api.clicrdv')));
        $registry->register(Doctor::AGENDA_DATABASE, new DatabaseAvailabilityService());
    }
}
