@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Current Products</h1>
      @if (!empty($allProducts))
         <ul class="list-group">
            @foreach ($allProducts as $product)
               <li class="list-group-item">
                  <div class="row d-flex flex-row justify-content-start">
                     <div class="col col-xs-3 d-inline-block">{{ $product->name }}</div>
                     <div class="col col-xs-5">
                        <form action="{{ route('delete-product', ['product' => $product->id]) }}" method="POST">
                           @csrf
                           <input type="hidden" name="_method" value="DELETE">
                           <button class="btn btn-danger" type="submit">delete</button>
                        </form>
                     </div>
                  </div>
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

      <br>

      <h2>New product</h2>
      @auth
         <form action="{{ route('save-product') }}" method="POST">
            @csrf
               <input type="text" name="name" placeholder="name" value="{{ old('name') }}" /><br />
            @if($errors->has('name'))
               <div>
                  <span class="alert-danger">{{ $errors->first('name') }}</span>
               </div>
            @endif

            <textarea name="description" placeholder="description">{{ old('description') }}</textarea><br />
            @if($errors->has('description'))
               <div>
                  <span class="alert-danger">{{ $errors->first('description') }}</span>
               </div>
            @endif
            <input type="text" name="tags" placeholder="tags" /><br />
            <button type="submit">Submit</button>
         </form>
      @endauth

      @guest
         <p>Please login to add product</p>
      @endguest
   </div>
@endsection