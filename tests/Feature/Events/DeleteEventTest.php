<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteEventTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Events can be deleted
     *
     * @return void
     */
    public function testEventCanBeDeleted()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an Event
        $this->post('/event', [
            'name' => 'Event',
            'description' => 'Event Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event
        $event = Event::all()->first();

        // Delete event
        $response = $this->delete($event->path());

        // Assert the event has been deleted
        $this->assertCount(0, Event::all());

        // Assert that the user has been redirected
        $response->assertRedirect('/events');
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
