@extends('layout.admin.master-layout')
@section('additional-css')
    <link rel="stylesheet" href="{{asset('assets/admin/custom/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/chosen/chosen.css') }}">
    <style>
        .chosen .select2-container {
            display: none;
        }
        .incorrect{
            display: none;
        }
        .change-pass input.form-control{
            border: 1px solid #c65454 !important;
        }
    </style>
@endsection
@section('main-content')
@include('layout.common.modal-spinner')
    @include('admin.pagesettings.mail.partials.view')
    
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <header class="page-header">
                                    <h3>
                                        Mails
                                    </h3>
                                </header>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data-action mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="data-sort-wrapper">
                                                <label for="inlineFormCustomSelect">Show</label>
                                                <select class="custom-select" id="inlineFormCustomSelect">
                                                    <option selected="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                <div class="select-caption">
                                                    Entries
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="data-search-wrapper">
                                                <form action="">
                                                    <div class="form-group">
                                                        <label for="searchForm">Search</label>
                                                        <div class="search-box">
                                                            <input type="text" class="form-control" id="searchForm"
                                                                   aria-describedby="searchForm">
                                                            <button class="search-submit btn">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="data-search-wrapper  text-right">
                                                <div class="advanced-search-btn">
                                                    <a href="">Advanced Search > </a>
                                                </div>
                                                @can('export.user')
                                                <a href="javascript:void(0);" class="btn form-button btn-success ml-3 export"> <i class="fa fa-file-excel text-white mr-1"></i> Export Excel </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <form id="advancedSearchForm">
                                    <div class="row form-input-area table-advanced-search align-items-center">
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Full Name" name="full_name">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="User Name" name="username">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Email" name="email">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Phone Number" name="phone_number">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Address" name="address">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Created By" name="created_by">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <select name="active_status" class="form-control">
                                                <option value="">Any Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control created_date"
                                                   placeholder="From Date" name="from_date">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control created_date"
                                                   placeholder="To Date" name="to_date">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <div class="">
                                                <span class="chk-wrap mr-2">
                                                    <label class="check-in-label">
                                                        <input type="checkbox" name="log" value="1">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </span>
                                                <span style="display: inline-block; vertical-align: sub;">Search Log</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <button type="button" class="btn form-button btn-import search_users">
                                                <i class="fas fa-search"></i>Search
                                            </button>
                                            <button type="button" class="btn form-button btn-import reset">
                                                <i class="fas fa-sync"></i>Reset
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered tabled-search" id="master-table">
                                        <thead class="thead-sort">
                                        <tr>
                                            <th class="sort-active">S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Received Date</th>
                                            <th style="width: 245px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layout.common.messages.error')
    @include('layout.common.messages.success')
@endsection

@section('additional-js')
    <script src="{{asset('assets')}}/plugin/dataTables/datatables.min.js"></script>
    <script src="{{asset('assets')}}/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets/plugin/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('assets/plugin/chosen/prism.js') }}"></script>
    <script src="{{asset('assets/admin/custom/js/pagesettings/bl.js')}}"></script>
@endsection
