<?php

namespace Tests\Feature;

use App\Models\Speaker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * A speaker can be updated
     */
    public function testSpeakerCanBeUpdated()
    {
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create a speaker
        $this->post('/speaker', Speaker::factory()->raw());

        // Assert that the speaker is stored in the database.
        $this->assertCount(1, Speaker::all());

        // Find the event
        $speaker = Speaker::all()->first();

        // Update the event.
        $response = $this->patch('/speaker/' . $speaker->id, array_merge(
            Speaker::factory()->raw(),
            ['name' => 'Updated Name']
        ));

        // Assert that the event has been updated.
        $this->assertEquals('Updated Name', $speaker->fresh()->name);

        // Assert that the route redirects the user back to the speaker page.
        $response->assertRedirect($speaker->path());
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
