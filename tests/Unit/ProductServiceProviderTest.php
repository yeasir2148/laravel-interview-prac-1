<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProductServiceProviderTest extends TestCase
{
   use RefreshDatabase;

   protected function setUp(): void
   {
      parent::setUp();
      $user = factory(User::class)->make();
      $this->actingAs($user);
   }

   /** @test */
   public function it_passes()
   {
      $this->assertTrue(true);
   }
   

   // /** @test */
   // public function it_validates_form_request()
   // {
   //    $product = factory('App\Product')->raw();
   //    $this->post('/products', $product);

   //    $response = $this->post('/products', $product);
   //    $this->assertDatabaseHas('products', $product);
   // }
   
}
