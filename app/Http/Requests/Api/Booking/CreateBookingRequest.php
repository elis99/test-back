<?php

namespace App\Http\Requests\Api\Booking;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'date' => [
                'required',
                'date_format:'.Booking::DATE_FORMAT
            ]
        ];
    }
}
