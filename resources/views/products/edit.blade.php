@extends('app')

@section('title', 'Create Products')

@section('head')
@include('links.form.head')
@endsection

@section('foot')
@include('links.form.foot')
@endsection

@section('content-header')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Products</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('products') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('products_category', ['category' => $category, 'sub_category' => $sub_category]) }}">{{ $category }} List</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url()->full() }}">Edit Product</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content-body')

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit {{ $product['cloth'] }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url()->full() }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Cloth 
                                            @error('cloth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="cloth" value="{{ old('cloth') ? old('cloth') : $product['cloth'] }}" class="form-control" placeholder="Enter Cloth" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Price 
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="price" value="{{ old('price') ? old('price') : $product['price'] }}" class="form-control" placeholder="Enter Product's Price" autocomplete="off">
                                    </div>
                                </div>
                                @if(isset($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" height="120" width="200"/>
                                @endif
                                <div class="col-12">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Change Product Image 
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="file" name="image" accept="image/*" value="{{ old('image') }}" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Floating Label Form section end -->

@endsection