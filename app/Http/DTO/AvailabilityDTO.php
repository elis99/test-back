<?php

namespace App\Http\DTO;

final class AvailabilityDTO
{
    public string $start;

    public function __construct(string $start)
    {
        $this->start = $start;
    }
}