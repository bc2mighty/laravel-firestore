@extends('app')

@section('title', 'Orders List')

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
                <h2 class="content-header-title float-left mb-0">Orders</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{  route('orders') }}">Home</a>
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
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Delivery Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key=>$order)
                            @if($order->exists())
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ isset($order['fullname']) ? $order['fullname'] : '' }}</td>
                                    <td>{{ isset($order['payment']) ? $order['payment'] : '' }}</td>
                                    <td>{{ isset($order['status']) ? $order['status'] : '' }}</td>
                                    <td>@money($order['total'])</td>
                                    <td>{{ isset($order['delivery_date']) ? $order['delivery_date'] : '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="btn btn-secondary" href="" data-toggle="modal" data-target="#modal-{{ $order['id'] }}"><i data-feather="eye"></i> View Order Cart</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade modal-dark text-left" id="modal-{{ $order['id'] }}" tabindex="-1" role="dialog" aria-labelledby="#modal-{{ $order['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel150">{{ $order['fullname'] }} Orders</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($order['cart'] as $cart)
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item active">Cart item Details</li>
                                                        <li class="list-group-item">Category: {{ $cart['category'] }}</li>
                                                        <li class="list-group-item">Name: {{ $cart['name'] }}</li>
                                                        <li class="list-group-item">Price: {{ $cart['price'] }}</li>
                                                        <li class="list-group-item">Quantity: {{ $cart['quantity'] }}</li>
                                                        <li class="list-group-item">Type: {{ $cart['type'] }}</li>
                                                    </ul>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
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