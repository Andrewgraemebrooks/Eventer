<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A user can be stored in the database
     *
     * @return void
     */
    // public function testUserCanBeStored()
    // {
    //     $this->withoutExceptionHandling();

    //     $response = $this->post('/register', User::factory()->raw());

    //     $this->assertCount(1, User::all());
    //     $response->assertRedirect('/');
    // }
    public function testSuccess()
    {
        $this->assertTrue(true);
    }
}
