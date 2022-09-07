<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'doctor_id' => Doctor::factory() ,
            'date' => $this->faker->date,
            'status' => Booking::STATUS_CREATED
        ];
    }
}
