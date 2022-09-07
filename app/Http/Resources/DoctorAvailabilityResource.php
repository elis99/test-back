<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \DateTimeImmutable;

class DoctorAvailabilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'start' => $this->start
        ];
    }
}
