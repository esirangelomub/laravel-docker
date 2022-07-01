<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DirectoriesControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_GetDirectories()
    {
        $response = $this->get('/');
        $response->assertStatus(200)->assertViewIs('directory.home');
    }

    public function test_GetCreateDirectory()
    {
        $response = $this->get('/create');
        $response->assertStatus(200)->assertViewIs('directory.save');
    }
}
