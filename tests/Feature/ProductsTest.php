<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ProductsTest extends TestCase
{
   use RefreshDatabase;

   protected function setUp(): void
   {
      parent::setUp();
      $this->withoutExceptionHandling();
   }

   /** @test */
   public function authenticated_user_can_create_new_product()
   {

      $user = factory(User::class)->make();
      $this->actingAs($user);

      $product = factory('App\Product')->raw();
      $response = $this->post('/products', $product);

      $this->assertDatabaseHas('products', $product);
   }

   /** @test */
   public function authenticated_user_can_delete_a_product()
   {

      $user = factory(User::class)->make();
      $this->actingAs($user);

      $product = factory('App\Product')->create();
      $this->delete("/products/{$product->id}");

      $this->assertDatabaseMissing('products', $product->toArray());
   }
}
