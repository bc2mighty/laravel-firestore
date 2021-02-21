@extends('app')

@section('title', 'Dispatchers List')

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
                <h2 class="content-header-title float-left mb-0">Dispatchers</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{  route('dispatchers') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('create_dispatcher') }}">Add Dispatcher</a>
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
<!-- Basic Tables start -->
<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dispatchers as $key=>$dispatcher)
                            @if($dispatcher->exists())
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ isset($dispatcher['fullname']) ? $dispatcher['fullname'] : '' }}</td>
                                    <td>{{ isset($dispatcher['email']) ? $dispatcher['email'] : '' }}</td>
                                    <td>{{ isset($dispatcher['phone number']) ? $dispatcher['phone number'] : '' }}</td>
                                    <td>{{ isset($dispatcher['status']) ? $dispatcher['status'] : '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item btn btn-secondary mb-1" href="{{ route('edit_dispatcher', ['id' => $dispatcher->id()]) }}">
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item btn btn-danger" href="{{ route('destroy_dispatcher', ['id' => $dispatcher->id()]) }}">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Basic Tables end -->


@endsection