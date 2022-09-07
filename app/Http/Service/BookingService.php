<?php

namespace App\Http\Service;

use App\Models\Doctor;
use DateTimeImmutable;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Service\Availability\AvailabilityRegistry;

final class BookingService
{    
    public function __construct(private AvailabilityRegistry $availabilityRegistry)
    {  
    }
    
    public function getList(): Collection
    {
        dd(11);
        return Booking::query()
            ->select('id', 'doctor_id', 'user_id', 'date', 'status')
            ->get();
    }

    public function create(int $doctorId, DateTimeImmutable $date): Booking 
    {
        $authUser = Auth::user();

        $booking = new Booking();
        $booking->date = $date;
        $booking->doctor_id = $doctorId;
        $booking->status = Booking::STATUS_CREATED;
        $booking->user()
            ->associate($authUser);
      
        $booking->save();

        return $booking;
    }

    public function cancel(Booking $booking): void
    {
        $booking->delete();
    }
}