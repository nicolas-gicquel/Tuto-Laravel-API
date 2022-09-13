<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClubTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_new_club_created()
    {
        $response = $this->post('api/club', [
            'nameClub' => 'US Pontchateau',
            'logoClub' => 'logo.png',
        ]);
        $response->assertStatus(200);
    }

    public function test_clubs_listed_successfully()
    {
        $this->json('GET', 'api/clubs', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
