<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpeakerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A speaker can be created for an event
     *
     * @return void
     */
    public function testSpeakerCanBeStoredInDatabase()
    {
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create a speaker
        $this->post('/speaker', Speaker::factory()->raw());

        // Assert that the speaker is stored in the database.
        $this->assertCount(1, Speaker::all());
    }

    /**
     * A speaker can only be created by a logged in user
     */
    public function testSpeakerOnlyStoredAByUser()
    {
        // Create a speaker
        $response = $this->post('/speaker', Speaker::factory()->raw());

        // Assert that the unauthenticated user is redirected to the login page
        $response->assertRedirect('/login');
    }

    /**
     * Allows the test to authenticate routes as a user
     * @returns void
     * @author Andrew Brooks
     */
    protected function actAsUser(): void
    {
        // Create a user.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());
    }
}
