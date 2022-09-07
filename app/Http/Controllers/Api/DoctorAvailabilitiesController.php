<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorAvailabilityResource;
use App\Http\Service\Availability\AvailabilityRegistry;

final class DoctorAvailabilitiesController extends Controller
{
    public function __construct(private AvailabilityRegistry $availabilityRegistry)
    {  
    }

    public function index(Doctor $doctor)
    {   
        // @var AvailibilityInterface 
        $handler = $this->availabilityRegistry->get($doctor->agenda);
        $availabilities = $handler->getList($doctor);
        
        return response()->json(DoctorAvailabilityResource::collection($availabilities), Response::HTTP_OK);
    }
}
