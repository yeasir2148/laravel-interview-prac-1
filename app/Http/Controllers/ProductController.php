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
   // public function __construct()
   // {
   //    $this->middleware('auth')->except('index');
   // }

   public function index()
   {
      return view('products.index');
   }

   // public function new(Request $request)
   // {
   //    DB::insert("INSERT INTO products (name) VALUES ('" . $request->name . "')");

   //    return redirect('/products')->with('status', 'Product saved');
   // }

   // public function delete(Request $request)
   // {
   //    DB::delete("DELETE FROM products WHERE id = " . $request->id);

   //    return redirect('/products')->with('status', 'Product was deleted');
   // }

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

      return back()->with('status', 'Product saved!');
   }
}
