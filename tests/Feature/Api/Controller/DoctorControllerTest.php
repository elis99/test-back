<?php

namespace Tests\Feature\Api\Controller;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorControllerTest extends TestCase
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
        Doctor::factory()
            ->count(3)
            ->create();

        $this->getJson('/api/doctors')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
               '*' => [
                'id',
                'name'
               ]
            ])
            ->assertJsonCount(3);
    }
}






