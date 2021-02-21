@extends('app')

@section('title', 'Company Infos List')

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
                <h2 class="content-header-title float-left mb-0">Company Infos</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{  route('company_infos') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('create_company_info', ['category' => $category, 'sub_category' => $sub_category]) }}">Add Company Info</a>
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
                            <th>Question/Title</th>
                            <th>Answer/Body</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company_infos as $key=>$company_info)
                            @if($company_info->exists())
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ isset($company_info['Question']) ? $company_info['Question'] : (isset($company_info['title']) ? $company_info['title'] : '') }}</td>
                                    <td>{{ isset($company_info['Answer']) ? $company_info['Answer'] : (isset($company_info['body']) ? $company_info['body'] : '') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item btn btn-secondary mb-1" href="{{ route('edit_company_info', ['id' => $company_info->id(), 'category' => $category, 'sub_category' => $sub_category]) }}">
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item btn btn-danger" href="{{ route('destroy_company_info', ['id' => $company_info->id(), 'category' => $category, 'sub_category' => $sub_category]) }}">
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