<?php

namespace App\Http\Controllers\Api;

use DateTimeImmutable;
use App\Models\Booking;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Service\BookingService;
use App\Http\Resources\BookingResource;
use App\Http\Requests\Api\Booking\CreateBookingRequest;

final class BookingController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {  
    }

    public function index()
    {        
        $bookings = $this->bookingService->getList();
        
        return response()->json(BookingResource::collection($bookings), Response::HTTP_OK);
    }

    public function create(CreateBookingRequest $request)
    {
        $date = new DateTimeImmutable($request->date);
        $booking = $this->bookingService->create($request->doctor_id, $date);

        return response()->json(BookingResource::make($booking), Response::HTTP_CREATED);
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('cancel', $booking);

        $booking = $this->bookingService->cancel($booking);
        
        return response()->json(BookingResource::make($booking), Response::HTTP_OK);
    }
}
