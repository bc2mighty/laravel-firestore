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
                        <li class="breadcrumb-item"><a href="{{ route('company_infos_category', ['category' => $category, 'sub_category' => $sub_category]) }}">{{ $category }} List</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url()->full() }}">Edit Company Info</a>
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
                        <h4 class="card-title">Edit {{ isset($company_info['Question']) ? $company_info['Question'] : $company_info['title'] }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url()->full() }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @if(isset($company_info['Question']))
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Question 
                                            @error('question')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="question" value="{{ old('Question') ? old('question') : $company_info['Question'] }}" class="form-control" placeholder="Enter Question" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Answer 
                                            @error('answer')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="answer" value="{{ old('answer') ? old('answer') : $company_info['Answer'] }}" class="form-control" placeholder="Enter Company Info's Answer" autocomplete="off">
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
                                        <input type="text" name="title" value="{{ old('title') ? old('title') : $company_info['title'] }}" class="form-control" placeholder="Enter Title" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-12">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Body 
                                            @error('answer')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <textarea name="body" class="form-control" placeholder="Enter Company Info's Body" autocomplete="off">{{ old('body') ? old('body') : $company_info['body'] }}</textarea>
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