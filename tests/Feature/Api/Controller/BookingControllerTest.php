<?php

namespace Tests\Feature\Api\Controller;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $loginUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginUser = User::factory()
            ->create();
    }

    public function testGetIndex()
    {
        $this->actingAs($this->loginUser);
        Booking::factory()
            ->count(3)
            ->create();

        $this->getJson('/api/bookings')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
               '*' => [
                'id',
                'doctor_id',
                'user_id',
                'date',
                'status'
               ]
            ])
            ->assertJsonCount(3);
    }

    public function testCanCreate()
    {
        $doctor = Doctor::factory()
            ->create();
        $this->actingAs($this->loginUser);

        $date = $this->faker->dateTime()
            ->format(Booking::DATE_FORMAT);
        $data = [
            'doctor_id' => $doctor->id,
            'date' => $date
        ];
    
        $this->postJson('/api/bookings', $data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment([
                'doctor_id' => $doctor->id,
                'date' => $date,
                'user_id' => $this->loginUser->id,
                'status' => Booking::STATUS_CONFIRMED
            ])
            ->assertJsonStructure([
                'id',
                'doctor_id',
                'user_id',
                'date',
                'status'
            ]);
    }

    public function testCanCancel()
    {
        $this->actingAs($this->loginUser);
        $booking = Booking::factory()
            ->create();
            
        $this->patchJson("/api/bookings/{$booking->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'id' => $booking->id,
                'status' => Booking::STATUS_CANCELED
            ])
            ->assertJsonStructure([
                'id',
                'doctor_id',
                'user_id',
                'date',
                'status'
            ]);
            ;
    }
}






