@extends('app')

@section('title', 'Create Dispatchers')

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
                <h2 class="content-header-title float-left mb-0">Dispatchers</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url()->full() }}">Add Dispatcher</a>
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
                        <h4 class="card-title">Add A New Dispatcher</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url()->full() }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Email 
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Phone Number 
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" placeholder="Enter Dispatcher's Phone Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Full Name 
                                            @error('fullname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" placeholder="Enter Dispatcher's Full Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group"> 
                                        <label for="first-name-column">Status
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Select Status</option>
                                            <option {{ @old('status') == 'Free' ? 'selected' : '' }} value="Free">Free</option>
                                            <option {{ @old('status') == 'Busy' ? 'selected' : '' }} value="Busy">Busy</option>
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