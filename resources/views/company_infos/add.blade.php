@extends('app')

@section('title', 'Create Company Infos')

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
                <h2 class="content-header-title float-left mb-0">Company Infos</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('company_infos') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url()->full() }}">Add Company Info</a>
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
                        <h4 class="card-title">Add A New Company Info</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url()->full() }}" enctype="multipart/form-data">
                            @csrf
                            @if($sub_category == 'FAQs')
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Question 
                                            @error('question')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="question" value="{{ old('question') }}" class="form-control" placeholder="Enter Question" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Answer 
                                            @error('answer')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="answer" value="{{ old('answer') }}" class="form-control" placeholder="Enter Company Info's Answer" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-12">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Title 
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-12">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Body 
                                            @error('body')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <textarea name="body" class="form-control" placeholder="Enter Company Info's Body" autocomplete="off">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Floating Label Form section end -->

@endsection