@extends('layout/app')
@section('title', 'Products')

@section('content')
    <div class="container pb-5">
        <h1 class="title-1 mb-3">{{$product->name}}</span></h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img class="w-100" src="{{$product->images()->first()->url}}"
                             alt="{{$product->name}}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <dl class="row mb-5">
                            <dt class="col-sm-3">Brand</dt>
                            <dd class="col-sm-9">{{$product->brand}}</dd>
                            <dt class="col-sm-3">URL</dt>
                            <dd class="col-sm-9">
                                <a target="_blank" class="d-block"
                                   href="{{$product->url}}">{{$product->url}}</a>
                            </dd>
                            <dt class="col-sm-3">SKU</dt>
                            <dd class="col-sm-9"><div class="badge badge-success">{{$product->sku}}</div></dd>
                        </dl>
                        <p class="font-weight-bold">Product images</p>
                        <div class="row">
                            @foreach($product->images as $image)
                                <div class="col-md-3 mb-4">
                                    <img src="{{$image->url}}" alt="image" class="img-thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
