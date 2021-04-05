@extends('app')

@section('title', 'Dashboard')

@section('head')
    @include('links.dashboard.head')
@endsection

@section('foot')
    @include('links.dashboard.foot')
@endsection

@section('content-body')

    <section id="dashboard-analytics">
        <div class="row match-height">
            <!-- Greetings Card starts -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                    <img src="{{ asset('dashboard/app-assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left">
                    <img src="{{ asset('dashboard/app-assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right">
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                        <i data-feather="award" class="font-large-1"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">Welcome Admin</h1>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                        <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ $users }}</h2>
                    <p class="card-text">Total Users</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                        <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ $products }}</h2>
                    <p class="card-text">Total Products</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                        <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ $orders }}</h2>
                    <p class="card-text">Total Orders</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('syncDB') }}" id="sync_db" class="btn btn-primary">Sync Database</a>
    </section>
@endsection