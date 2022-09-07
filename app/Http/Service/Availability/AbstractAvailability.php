<?php

namespace App\Http\Service\Availability;

use App\Models\Doctor;
use App\Http\DTO\AvailabilityDTO;

abstract class AbstractAvailability
{
    /**
     * @return AvailabilityDTO[]
     */
    abstract public function getList(Doctor $doctor): array;

    protected function prepareDto(array $data): array
    {
        $dtos = [];
        foreach ($data as $item) {
            if (array_key_exists('start', $item)) {
                $dto = new AvailabilityDTO($item['start']);
                array_push($dtos, $dto);
            }
        }

        return $dtos;
    }
}