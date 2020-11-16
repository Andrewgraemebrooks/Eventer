<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateEventTest extends TestCase
{

    use refreshDatabase;

    /**
     * An event can be updated.
     */
    public function testEventCanBeUpdated()
    {
        // Remove exception handling to ensure that Laravel doesn't hide exception details.
        $this->withoutExceptionHandling();

        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $this->createOrUpdateEvent(
            true,
            'Event',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get event id
        $eventId = Event::all()->first()->id;

        // Update the event
        $response = $this->createOrUpdateEvent(
            false,
            'Updated Event',
            'Updated Event Description',
            now(),
            '12:00:00',
            '120',
            'Updated Event Venue',
            $eventId
        );

        // Assert that the route works well.
        $response->assertOk();

        // Assert that the event has been updated
        $this->assertEquals('Updated Event', Event::all()->first()->name);
        $this->assertEquals('Updated Event Description', Event::all()->first()->description);
        $this->assertEquals('Updated Event Venue', Event::all()->first()->venue);
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

    /**
     * @param $create
     * @param $name
     * @param $desc
     * @param $date
     * @param $time
     * @param $duration
     * @param $venue
     * @param string $eventId
     * @return \Illuminate\Testing\TestResponse
     */
    protected function createOrUpdateEvent($create, $name, $desc, $date, $time, $duration, $venue, $eventId = '-1'):
    \Illuminate\Testing\TestResponse
    {
        if ($create) {
            return $this->post('/event', [
                'name' => $name,
                'description' => $desc,
                'date' => $date,
                'time' => $time,
                "duration" => $duration,
                "venue" => $venue,
            ]);
        } else {
            return $this->patch('/event/' . $eventId, [
                'name' => 'Updated Event',
                'description' => 'Updated Event Description',
                'date' => now(),
                'time' => '12:00:00',
                "duration" => '120',
                "venue" => 'Updated Event Venue',
            ]);
        }
    }
}
