@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Current Products</h1>
      @if (!empty($allProducts))
      <ul>
         @foreach ($allProducts as $product)
         <li>
            {{ $product->name }}
            <form action="{{ route('delete-product', ['product' => $product->id]) }}" method="POST">
               @csrf
               <input type="hidden" name="_method" value="DELETE">
               <button type="submit">delete</button>
            </form>
         </li>
         @endforeach
      </ul>
      @else
      <p><em>No products have been created yet.</em></p>
      @endif



      @if (session('status'))
      <div class="alert-success">
         {{ session('status') }}
      </div>
      @endif



      <h2>New product</h2>
      @auth
      <form action="{{ route('save-product') }}" method="POST">
         @csrf
         <input type="text" name="name" placeholder="name" /><br />
         @if($errors->has('name'))
            <div>
               <span class="alert-danger">{{ $errors->first('name') }}</span>
            </div>
         @endif
         <textarea name="description" placeholder="description"></textarea><br />
         <input type="text" name="tags" placeholder="tags" /><br />
         <button type="submit">Submit</button>
      </form>
      @endauth

      @guest
         <p>Please login to add product</p>
      @endguest
   </div>
@endsection