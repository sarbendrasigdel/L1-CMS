@extends('layout.admin.master-layout')
@section('additional-css')
    <link rel="stylesheet" href="{{asset('assets/admin/custom/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/sweetalert/sweetalert.css')}}">
@endsection
@section('main-content')
    @include('admin.access.designations.partials.add')
    @include('admin.access.designations.partials.view')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <header class="page-header">
                                    <h3>
                                        User List
                                    </h3>
                                </header>
                            </div>
                            @can('create.user.designation')
                            <div class="col-lg-4 text-right">
                                <div class="link-btn-wrapper">
                                    <a href="#" class="btn link-btn" data-toggle="modal"
                                       data-target="#addModal" data-backdrop="static" data-keyboard="false">
                                        Add Designation
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                            @endcan
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
                                                @can('export.user.designation')
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
                                                   placeholder="Designation Name" name="designation_name">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Created By" name="created_by">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <input type="text" class="form-control created_date"
                                                   placeholder="Created Date" name="created_date">
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <select name="active_status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 pr-0">
                                            <button type="button" class="btn form-button btn-import search_designations">
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
                                    <table class="table table-striped table-bordered tabled-search" id="designation-table">
                                        <thead class="thead-sort">
                                        <tr>
                                            <th class="sort-active">S.No</th>
                                            <th>Designation Name</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
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
    <script src="{{asset('assets/admin/custom/js/access/designation.js')}}"></script>
@endsection
