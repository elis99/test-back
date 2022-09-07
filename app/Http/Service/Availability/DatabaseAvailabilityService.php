<?php

namespace App\Http\Service\Availability;

use App\Models\Doctor;
use App\Models\Availability;

final class DatabaseAvailabilityService implements AvailabilityInterface
{
    public function getList(Doctor $doctor)
    {
        return Availability::where('doctor_id', $doctor->id)
            ->get();
    }
}