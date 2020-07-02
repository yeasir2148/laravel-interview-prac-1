<?php

namespace App\Services;

use App\Contracts\ServiceProviderContract;
use Illuminate\Foundation\Http\FormRequest;
use App\Product;

class ProductServiceProvider implements ServiceProviderContract
{
   protected function validateRequest(FormRequest $request) {
      return $request->validated();
   }

   public function addEntity(FormRequest $request)
   {
      $validated = $this->validateRequest($request);
      $newProduct = Product::firstOrCreate(
         $validated
      );

      return $newProduct;
   }

   public function deleteEntity(int $entityId)
   {
      $product = Product::destroy($entityId);
   }
} 