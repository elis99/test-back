<?php

namespace Tests\Feature\Api\Controller;

use App\Models\Availability;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorAvailabilityControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $loginUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginUser = User::factory()
            ->create();
    }

    public function testGetDatabaseList()
    {
        $doctor = Doctor::factory([
            'agenda' => Doctor::AGENDA_DATABASE
        ])->create();

        $this->actingAs($this->loginUser);

        Availability::factory([
            'doctor_id' => $doctor->id
        ])
            ->count(3)
            ->create();

        $this->getJson("/api/doctors/{$doctor->id}/availabilities")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
               '*' => [
                'start',
               ]
            ])
            ->assertJsonCount(3);
    }

    public function testGetDoctolibList()
    {
        $doctor = Doctor::factory([
            'agenda' => Doctor::AGENDA_DOCTOLIB
        ])->create();

        $this->actingAs($this->loginUser);

        $this->getJson("/api/doctors/{$doctor->id}/availabilities")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
           '*' => [
            'start',
           ]
        ]);
    }

    public function testGetClicRDVList()
    {
        $doctor = Doctor::factory([
            'agenda' => Doctor::AGENDA_CLICRDV
        ])->create();

        $this->actingAs($this->loginUser);

        $this->getJson("/api/doctors/{$doctor->id}/availabilities")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
           '*' => [
            'start',
           ]
        ]);
    }
}






