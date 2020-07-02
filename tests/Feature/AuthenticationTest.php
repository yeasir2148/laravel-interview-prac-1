<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
   /** @test */
   public function unauthenticated_user_cannot_access_the_site()
   {
      $response = $this->get('/');
      $response->assertRedirect('/login');
   }
}
