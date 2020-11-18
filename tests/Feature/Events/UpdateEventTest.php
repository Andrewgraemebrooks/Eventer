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
        // Act as a user to authenticate route.
        $this->actAsUser();

        $this->createEvent('Event', 'Event Description', now(), '12:00:00', '120', 'Event Venue');

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Find the event.
        $event = Event::all()->first();

        // Update the event.
        $response = $this->updateEvent(
            $event,
            'Updated Event',
            'Updated Event Description',
            now(),
            '12:00:00',
            '120',
            'Updated Event Venue'
        );

        // Assert that the event has been updated.
        $this->assertEquals('Updated Event', $event->fresh()->name);
        $this->assertEquals('Updated Event Description', $event->fresh()->description);
        $this->assertEquals('Updated Event Venue', $event->fresh()->venue);

        // Assert that the route redirects the user back to the event page.
        $response->assertRedirect($event->path());
    }

    /**
     * An event must have a name.
     * @return void
     */
    public function testUpdateNameIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        $response = $this->updateEvent(
            $event,
            '',
            'Updated Event Description',
            now(),
            '12:00:00',
            '120',
            'Updated Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event must have a description.
     * @return void
     */
    public function testUpdateDescriptionIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            '',
            now(),
            '12:00:00',
            '120',
            'Updated Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event must have a date.
     * @return void
     */
    public function testUpdateDateIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            "",
            '12:00:00',
            '120',
            'Updated Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testUpdateTimeIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '',
            '120',
            'Updated Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event must have a duration.
     * @return void
     */
    public function testUpdateDurationIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '',
            'Updated Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event must have a venue.
     * @return void
     */
    public function testUpdateVenueIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            ''
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }

    /**
     * An event name must be at least three characters.
     * @return void
     */
    public function testUpdateNameNeedsThreeMinCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Ev',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event name must be equal to or less than sixty characters.
     * @return void
     */
    public function testUpdateNameNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'yNO21DhVnIOQCnb7kJuGhraUA2FzvmFTzK44tbestjNMBG1z7lRSJKD2CUXxm',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event description must be equal to or less than sixty characters.
     * @return void
     */
    public function testUpdateDescriptionNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'yNO21DhVnIOQCnb7kJuGhraUA2FzvmFTzK44tbestjNMBG1z7lRSJKD2CUXxm',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event date must be in the proper date format.
     * @return void
     */
    public function testUpdateDateMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            '12:00:00',
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event time must be in the proper time format.
     * @return void
     */
    public function testUpdateTimeMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event duration must be more than zero
     * @return void
     */
    public function testUpdateDurationIsMoreThanZero()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '0',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event duration must be less than 1,440 minutes (24 hours)
     * @return void
     */
    public function testUpdateDurationIsLessThanADay()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '1441',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event venue must be equal to or less than sixty characters.
     * @return void
     */
    public function testUpdateVenueNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'yNO21DhVnIOQCnb7kJuGhraUA2FzvmFTzK44tbestjNMBG1z7lRSJKD2CUXxm'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }

    /**
     * An event duration must be an integer.
     * @return void
     */
    public function testUpdateDurationMustBeAnInteger()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $this->createEvent(
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        // Get the event from the database.
        $event = Event::all()->first();

        // Update the event
        $response = $this->updateEvent(
            $event,
            'Event Name',
            'Event Description',
            now(),
            '12:00:00',
            'Event Duration',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
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
     * @param $name
     * @param $desc
     * @param $date
     * @param $time
     * @param $duration
     * @param $venue
     * @return \Illuminate\Testing\TestResponse
     */
    protected function createEvent($name, $desc, $date, $time, $duration, $venue): \Illuminate\Testing\TestResponse
    {
        return $this->post('/event', [
            'name' => $name,
            'description' => $desc,
            'date' => $date,
            'time' => $time,
            "duration" => $duration,
            "venue" => $venue,
        ]);
    }

    /**
     * @param $name
     * @param $desc
     * @param $date
     * @param $time
     * @param $duration
     * @param $venue
     * @return \Illuminate\Testing\TestResponse
     */
    protected function updateEvent(
        $event,
        $name,
        $desc,
        $date,
        $time,
        $duration,
        $venue
    ): \Illuminate\Testing\TestResponse
    {
        return $this->patch('/event/' . $event->id, [
            'name' => $name,
            'description' => $desc,
            'date' => $date,
            'time' => $time,
            "duration" => $duration,
            "venue" => $venue,
        ]);
    }
}
