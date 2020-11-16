<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
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

        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'Event Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that the route works well.
        $response->assertOk();

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());
    }

    /**
     * An event must have a name.
     * @return void
     */
    public function testANameIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event must have a description.
     * @return void
     */
    public function testADescriptionIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'description' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event must have a date.
     * @return void
     */
    public function testADateIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'date' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testATimeIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'time' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testADurationIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'duration' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testAVenueIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'venue' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }
}
