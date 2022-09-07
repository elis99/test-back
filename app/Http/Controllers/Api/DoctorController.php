<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Service\DoctorService;

final class DoctorController extends Controller
{
    public function __construct(private DoctorService $doctorService)
    {  
    }

    public function index()
    {        
        $doctors = $this->doctorService->getList();
        
        return response()->json(DoctorResource::collection($doctors), Response::HTTP_OK);
    }
}
