<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Speaker;
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
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', Event::factory()->raw());

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Find the event
        $event = Event::all()->first();

        // Assert that the user is redirected to the new event page
        $response->assertRedirect($event->path());
    }

    /**
     * An event must have a name.
     * @return void
     */
    public function testEventNameIsRequired()
    {
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['name' => '']));

        // Assert that the event is stored in the database.
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event must have a description.
     * @return void
     */
    public function testEventDescriptionIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['description' => '']));

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event must have a date.
     * @return void
     */
    public function testEventDateIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['date' => '']));

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testEventTimeIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['time' => '']));

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event must have a duration.
     * @return void
     */
    public function testEventDurationIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['duration' => '']));

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event must have a venue.
     * @return void
     */
    public function testEventVenueIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['venue' => '']));

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }

    /**
     * An event name must be at least three characters.
     * @return void
     */
    public function testEventNameNeedsThreeMinCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['name' => 'Ev']));

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event name must be equal to or less than sixty characters.
     * @return void
     */
    public function testEventNameNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(
            Event::factory()->raw(),
            ['name' => 'PyOJ1p2UFcqib0QYuBqnGZJtJ3Equeu6a3q0pxYQxnpHwcX0lAuWITAsEjsvg']
        ));

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event description must be equal to or less than sixty characters.
     * @return void
     */
    public function testEventDescriptionNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(
            Event::factory()->raw(),
            ['description' => 'PyOJ1p2UFcqib0QYuBqnGZJtJ3Equeu6a3q0pxYQxnpHwcX0lAuWITAsEjsvg']
        ));

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event date must be in the proper date format.
     * @return void
     */
    public function testEventDateMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['date' => '12:00:00']));

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event time must be in the proper time format.
     * @return void
     */
    public function testEventTimeMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(Event::factory()->raw(), ['time' => '12:00']));

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event venue must be equal to or less than sixty characters.
     * @return void
     */
    public function testEventVenueNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create an event
        $response = $this->post('/event', array_merge(
            Event::factory()->raw(),
            ['venue' => 'yNO21DhVnIOQCnb7kJuGhraUA2FzvmFTzK44tbestjNMBG1z7lRSJKD2CUXxm']
        ));

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }

    /**
     * An event can be updated.
     */
    public function testEventCanBeUpdated()
    {
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create an event
        $this->post('/event', Event::factory()->raw());

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Find the event
        $event = Event::all()->first();

        // Update the event.
        $response = $this->patch('/event/' . $event->id, array_merge(
            Event::factory()->raw(),
            ['name' => 'Updated Event']
        ));

        // Assert that the event has been updated.
        $this->assertEquals('Updated Event', $event->fresh()->name);

        // Assert that the route redirects the user back to the event page.
        $response->assertRedirect($event->path());
    }

    /**
     * Events can be deleted
     *
     * @return void
     */
    public function testEventCanBeDeleted()
    {
        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create an event
        $this->post('/event', Event::factory()->raw());

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Find the event
        $event = Event::all()->first();

        // Delete event
        $response = $this->delete($event->path());

        // Assert the event has been deleted
        $this->assertCount(0, Event::all());

        // Assert that the user has been redirected
        $response->assertRedirect('/events');
    }

    /**
     * A speaker can be added to an event
     */
    public function testAddSpeakerToAnEvent()
    {
         // Create an event
         $event = Event::factory()->create();

         // Create a speaker
         $speaker = Speaker::factory()->create();

         // Add speaker to the event
         $event->addSpeaker($speaker);

         // Test that a speaker has been added to the event
         $this->assertCount(1, $event->speakers()->getResults());
    }

    /**
     * A speaker can be deleted from an event
     */
    public function testDeleteSpeakerFromAnEvent()
    {
        // Create an event
        $event = Event::factory()->create();

        // Create a speaker
        $speaker = Speaker::factory()->create();

        // Add speaker to the event
        $event->addSpeaker($speaker);

        // Test that a speaker has been added to the event
        $this->assertCount(1, $event->speakers()->getResults());

        // Delete the speaker from the event
        $event->deleteSpeaker($speaker);

        // Test that a speaker has been deleted from the event
        $this->assertCount(0, $event->speakers()->getResults());
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
