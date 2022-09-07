<?php

namespace App\Http\Service\Availability;

use App\Models\Doctor;
use App\Models\Availability;
use App\Http\DTO\AvailabilityDTO;

final class DatabaseAvailabilityService extends AbstractAvailability
{
    /**
     * @return AvailabilityDTO[]
     */
    public function getList(Doctor $doctor): array
    {
        $data = Availability::where('doctor_id', $doctor->id)
            ->get()
            ->toArray();

        return $this->prepareDto($data);
    }
}