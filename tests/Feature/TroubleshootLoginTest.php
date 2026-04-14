<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TroubleshootLoginTest extends TestCase
{
    public function test_login_issue()
    {
        $response = $this->post('/login', [
            'email' => 'admin@toserbahasan.test',
            'password' => 'Admin@12345',
        ]);

        $response->dumpHeaders();
        $response->dumpSession();
        $this->assertTrue(true);
    }
}
