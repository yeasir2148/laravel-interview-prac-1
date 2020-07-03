@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Current Products</h1>
      @if (!empty($allProducts))
         <ul class="list-group  w-50">
            @foreach ($allProducts as $product)
               <li class="list-group-item">
                  <div class="row d-flex justify-content-around">
                     <div class="d-inline-block">{{ $product->name }}</div>
                     @auth
                     <div class="">
                        <form action="{{ route('delete-product', ['product' => $product->id]) }}" method="POST">
                           @csrf
                           <input type="hidden" name="_method" value="DELETE">
                           <button class="btn btn-danger" type="submit">delete</button>
                        </form>
                     </div>
                     @endauth
                  </div>
               </li>
            @endforeach
         </ul>
      @else
         <p><em>No products have been created yet.</em></p>
      @endif

      <br />

      @if (session('status'))
         <div class="alert-success">
            {{ session('status') }}
         </div>
      @endif

      <br />

      <h2>New product</h2>
      @auth
         <form action="{{ route('save-product') }}" method="POST">
            @csrf
               <input class="form-control w-25"type="text" name="name" placeholder="name" value="{{ old('name') }}" /><br />
            @if($errors->has('name'))
               <div>
                  <span class="alert-danger">{{ $errors->first('name') }}</span>
               </div>
            @endif

            <textarea class="form-control w-50" name="description" placeholder="description">{{ old('description') }}</textarea><br />
            @if($errors->has('description'))
               <div>
                  <span class="alert-danger">{{ $errors->first('description') }}</span>
               </div>
            @endif

            <input class="form-control w-50" 
               type="text" name="tags" 
               placeholder="tags...comma(,) separated" value="{{ old('tags') }}" /><br />
            @if($errors->has('tags'))
               <div>
                  <span class="alert-danger">{{ $errors->first('tags') }}</span>
               </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      @endauth

      @guest
         <p>Please login to add product</p>
      @endguest
   </div>
@endsection