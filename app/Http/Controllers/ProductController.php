<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductServiceProvider;

class ProductController extends Controller
{
   protected $serviceProvider;
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct(ProductServiceProvider $serviceProvider)
   {
      $this->middleware('auth')->except('index');
      $this->serviceProvider = $serviceProvider;
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
      $newProduct = $this->serviceProvider->addEntity($request);

      return redirect(route('product-list'))->with('status', 'Product saved!');
   }

   /**
    * Delete a product
    * @param Int $productId - Id of the product to be deleted
    * @return Response
    */
   public function destroy($productId) {
      $this->serviceProvider->deleteEntity($productId);
      return redirect(route('product-list'))->with('status', 'Product was deleted');
   }
}
