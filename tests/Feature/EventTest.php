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
    public function testNameIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => '',
            'description' => 'Event Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event must have a description.
     * @return void
     */
    public function testDescriptionIsRequired()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => '',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event must have a date.
     * @return void
     */
    public function testDateIsRequired()
    {
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
            'date' => '',
            'time' => '12:00:00',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testTimeIsRequired()
    {
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
            'time' => '',
            "duration" => '120',
            "venue" => 'Event Venue',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testDurationIsRequired()
    {
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
            "duration" => '',
            "venue" => 'Event Venue',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event must have a time.
     * @return void
     */
    public function testVenueIsRequired()
    {
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
            'venue' => ''
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('venue');
    }

    /**
     * An event name must be at least three characters.
     * @return void
     */
    public function testNameNeedsThreeMinCharacters()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => '12',
            'description' => 'Event Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            'venue' => 'Office',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event name must be equal to or less than sixty characters.
     * @return void
     */
    public function testNameNeedsSixtyMaxCharacters()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'PyOJ1p2UFcqib0QYuBqnGZJtJ3Equeu6a3q0pxYQxnpHwcX0lAuWITAsEjsvg',
            'description' => 'Event Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            'venue' => 'Office',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }

    /**
     * An event description must be equal to or less than 255 characters.
     * @return void
     */
    public function testDescriptionNeeds255MaxCharacters()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'PMfdiMYtI5ZNyoc9DfrT7Vfr7ojV9LcchoMeGUavu3LwWDDbl8NPWSU33drvTSJROCP8e5uhz1Sgt1pegsPPWIxF85
            UclJC8B0711rI94gOhlOkSBorAwrwXBURB2TnBS5DdHzxmCNNTEMiq7iEBSJy5VYYEXVccxlGJ0rRv5h4Q5cmTyim1ZmTKQVsbtSX6utfKyw
            txzqbp7kLg0k19QgfuPKrynyxYKxiak1',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            'venue' => 'Office'
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('description');
    }

    /**
     * An event date must be in the proper date format.
     * @return void
     */
    public function testDateMustBeTheRightFormat()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'Description',
            'date' => '12:00:00',
            'time' => '12:00:00',
            "duration" => '120',
            'venue' => 'Office'
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('date');
    }

    /**
     * An event time must be in the proper time format.
     * @return void
     */
    public function testTimeMustBeTheRightFormat()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'Description',
            'date' => '12:00:00',
            'time' => '12:00',
            "duration" => '120',
            'venue' => 'Office'
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('time');
    }

    /**
     * An event duration must be more than zero
     * @return void
     */
    public function testDurationIsMoreThanZero()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'Description',
            'date' => '12:00:00',
            'time' => '12:00:00',
            "duration" => 0,
            'venue' => 'Office'
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event duration must be less than 1,440 minutes (24 hours)
     * @return void
     */
    public function testDurationIsLessThanADay()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'Event',
            'description' => 'Description',
            'date' => '12:00:00',
            'time' => '12:00:00',
            "duration" => 1441,
            'venue' => 'Office'
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('duration');
    }

    /**
     * An event venue must be equal to or less than sixty characters.
     * @return void
     */
    public function testDescriptionNeedsSixtyMaxCharacters()
    {
        // Create a user to own the event.
        User::factory()->create();

        // Assert that the user has been added to the database.
        $this->assertCount(1, User::all());

        // Act as the newly created user.
        $this->actingAs(User::all()->first());

        // Create the event.
        $response = $this->post('/event', [
            'name' => 'PyOJ1p2UFcqib0QYuBqnGZJtJ3Equeu6a3q0pxYQxnpHwcX0lAuWITAsEjsvg',
            'description' => 'Description',
            'date' => now(),
            'time' => '12:00:00',
            "duration" => '120',
            'venue' => 'Office',
        ]);

        // Assert that there is an error
        $response->assertSessionHasErrors('name');
    }
}
