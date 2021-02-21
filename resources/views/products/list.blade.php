@extends('app')

@section('title', 'Products List')

@section('head')
@include('links.table.head')
@endsection

@section('foot')
@include('links.table.foot')
@endsection

@section('content-header')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Products</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{  route('products') }}">Home</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-12">
                @if (session('success'))
                    <div class="text-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="text-danger">
                        {{ session('danger') }}
                    </div>
                @endif
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
                        <h4 class="card-title">Select Product Category</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url()->full() }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 category-class">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Category 
                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Product Category</option>
                                            @foreach($categories as $key=>$category)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
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