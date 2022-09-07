<?php

namespace App\Http\Service;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

final class DoctorService
{    
    public function getList(): Collection
    {
        return Doctor::query()
            ->select('id', 'name')
            ->get();
    }
}