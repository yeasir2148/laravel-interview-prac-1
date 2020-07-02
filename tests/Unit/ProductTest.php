<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProductTest extends TestCase
{
   use RefreshDatabase;

   protected function setUp(): void {
      parent::setUp();
      $user = factory(User::class)->make();
      $this->actingAs($user);
   }

   /** @test */
   public function product_name_must_be_unique()
   {
      $product = factory('App\Product')->raw();
      $this->post('/products', $product);

      $product1 = [
         'name' => $product['name']
      ];
      $response = $this->post('/products', $product1);

      $response->assertSessionHasErrors(['name']);
   }
   
}
