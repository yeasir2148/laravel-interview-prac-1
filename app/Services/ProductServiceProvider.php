<?php

namespace App\Services;

use App\Contracts\ServiceProviderContract;
use Illuminate\Foundation\Http\FormRequest;

use App\Product;
use App\Tag;

class ProductServiceProvider implements ServiceProviderContract
{
   public function addEntity(FormRequest $request)
   {
      $validated = $this->validateRequest($request);
      $newProduct = Product::create(
         $validated
      );

      $newTags = $this->processTags($request);

      if(!empty($newTags)) {
         $this->attachTags($newTags, $newProduct);
      }

      return $newProduct;
   }

   public function deleteEntity(int $entityId)
   {
      $this->detachTags($entityId);
      $product = Product::destroy($entityId);
   }

   /**
    * Validates the form request
    * @param Object $request - the form request instance
    */
   protected function validateRequest(FormRequest $request) {
      return $request->validated();
   }

   /**
    * Processes the tags
    * @return Array $createdTags - an array of tag ids
    */
   protected function processTags() {
      $tags = explode(",", request('tags'));
      $createdTags = [];

      if(!empty($tags)) {
         foreach ($tags as $tagName) {
            $tag =  Tag::firstOrCreate(['tag_name' => $tagName]);
            $createdTags[] = $tag->id;
         }
      }

      return $createdTags;
   }

   /**
   * Attaches the tags to the product
   * @param Array $tagIds - Array of tag ids to be attached to the product
   * @param Object $product - The product instance
   */
   protected function attachTags(Array $tagIds, $product) {
      foreach ($tagIds as $tag) {
         $product->tags()->attach($tag);
      }
   }

   /**
    * Detaches the tags from a product
    * @param Int $productId - The product Id from which tags to be detached from 
    */
   protected function detachTags($productId) {
      $product = Product::find($productId);
      $product->tags()->detach();
   }
} 