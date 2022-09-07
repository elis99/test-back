<?php

namespace App\Http\Service;

use App\Models\User;
use DateTimeImmutable;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

final class BookingService
{        
    public function getList(User $user): Collection
    {
        return Booking::query()
            ->select('id', 'doctor_id', 'user_id', 'date', 'status')
            ->where('user_id', $user->id)
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function create(User $user, int $doctorId, DateTimeImmutable $date): Booking 
    {
        $booking = new Booking();
        $booking->date = $date;
        $booking->doctor_id = $doctorId;
        $booking->status = Booking::STATUS_CONFIRMED;
        $booking->user()
            ->associate($user);
      
        $booking->save();

        return $booking;
    }

    public function cancel(Booking $booking): Booking
    {
        $booking->status = Booking::STATUS_CANCELED;
        $booking->save();

        return $booking;
    }
}