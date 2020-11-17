<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEventTest extends TestCase
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

        // Act as a user to authenticate routes.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );


        // Assert that the event is stored in the database.
        $this->assertCount(1, Event::all());

        $eventId = Event::all()->first()->id;

        // Assert that the user is redirected to the new event page
        $response->assertRedirect('/event/' . $eventId);
    }

    /**
     * An event must have a name.
     * @return void
     */
    public function testNameIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            '',
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
     * An event must have a description.
     * @return void
     */
    public function testDescriptionIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            '',
            now(),
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event must have a date.
     * @return void
     */
    public function testDateIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            '',
            '12:00:00',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testTimeIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            now(),
            '',
            '120',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event must have a duration.
     * @return void
     */
    public function testDurationIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            now(),
            '12:00:00',
            '',
            'Event Venue'
        );

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event must have a venue.
     * @return void
     */
    public function testVenueIsRequired()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
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
    public function testNameNeedsThreeMinCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
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
    public function testNameNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'PyOJ1p2UFcqib0QYuBqnGZJtJ3Equeu6a3q0pxYQxnpHwcX0lAuWITAsEjsvg',
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
    public function testDescriptionNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
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
    public function testDateMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
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
    public function testTimeMustBeTheRightFormat()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            '12:00:00',
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
    public function testDurationIsMoreThanZero()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            '12:00:00',
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
    public function testDurationIsLessThanADay()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
            'Event Description',
            '12:00:00',
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
    public function testVenueNeedsSixtyMaxCharacters()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
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
    public function testDurationMustBeAnInteger()
    {
        // Act as a user to authenticate route.
        $this->actAsUser();

        // Create the event.
        $response = $this->createEvent(
            'Event',
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
}
