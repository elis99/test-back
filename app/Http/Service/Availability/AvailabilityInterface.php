<?php

namespace App\Http\Service\Availability;

use App\Models\Doctor;

interface AvailabilityInterface
{
    public function getList(Doctor $doctor);
}