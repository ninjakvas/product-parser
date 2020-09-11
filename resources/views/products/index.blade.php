@extends('layout/app')
@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="row gutter-10">
            @if($products->count() !== 0)
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="product-item">
                            <a href="{{route('products.show', $product)}}">
                                <img class="w-100" src="{{$product->images()->first()->url}}"
                                     alt="{{$product->name}}">
                            </a>
                            <a href="{{route('products.show', $product)}}"
                               class="product-item__title">{{$product->name}}</a>
                            <a href="{{route('products.show', $product)}}" class="btn btn-success">See
                                more</a>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="col-12">There are no items</h3>
            @endif
        </div>
        {{$products->links('vendor/pagination/bootstrap-4')}}
    </div>
@endsection
