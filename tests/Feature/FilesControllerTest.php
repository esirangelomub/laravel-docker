<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilesControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_GetDirectories()
    {
        $response = $this->get('1/files');
        $response->assertStatus(200)->assertViewIs('file.home');
    }

    public function test_GetCreateDirectory()
    {
        $response = $this->get('1/files/create');
        $response->assertStatus(200)->assertViewIs('file.save');
    }
}
