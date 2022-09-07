<?php

namespace App\Http\Resources;

use DateTime;
use \DateTimeImmutable;
use App\Models\Booking;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'id' => $this->id,
            'doctor_id' => $this->doctor_id, 
            'user_id' => $this->user_id,
            'date' => $this->date instanceof DateTimeImmutable 
                ? $this->date->format(Booking::DATE_FORMAT)
                : $this->date,
            'status' => $this->status
        ];
    }
}
