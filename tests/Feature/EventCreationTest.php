<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventCreationTest extends TestCase
{

    // Creates a fresh database every test.
    use RefreshDatabase;

    /**
     * An event can be stored in the database.
     *
     * @return void
     */
    public function testEventCanBeStoredInDatabase()
    {
        // Remove exception handling to ensure that Laravel doesn't hide exception details.
        $this->withoutExceptionHandling();

        // Create example event.
        $response = $this->post('/event', [
            'name' => 'Event Name',
        ]);

        // Assert that the route works well.
        $response->assertOk();

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());
    }
}
