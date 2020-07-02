<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth')->except('index');
   }

   public function index()
   {
      $allProducts = Product::all();
      return view('products.index', compact("allProducts"));
   }

   /**
    * Save a new product
    * @param Object $request - instance of the ProductRequest form request
    * @return Response
    */
   public function store(ProductRequest $request)
   {
      $validated = $request->validated();
      $newProduct = Product::firstOrCreate(
         ['name' => $validated['name']]
      );

      // This is done to add an extra layer of protection against duplicate product name in case in future we remove custom
      // form request
      if ($newProduct->wasRecentlyCreated !== true) {
         $response['success'] = false;
         $response['message'] = 'Product already exists';
      } else {
         $response['success'] = true;
         $response['data'] = $newProduct;
      }

      return redirect(route('product-list'))->with('status', 'Product saved!');
   }

   /**
    * Delete a product
    * @param Int $productId - Id of the product to be deleted
    * @return Response
    */
   public function destroy($productId) {
      $product = Product::destroy($productId);
      return redirect(route('product-list'))->with('status', 'Product was deleted');
   }
}
