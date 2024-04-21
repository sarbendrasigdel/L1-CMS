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
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        @include('layout.common.modal-spinner')
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <header class="page-header">
                                    <h3>
                                        {{@$title}}
                                    </h3>
                                </header>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <form id="add-terms-and-condition-form" autocomplete="off">
                                    @csrf
                                    <div class="row form-input-area align-items-center">
                                        <div class="col-lg-12 form-input-area">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">
                                                    Title <sup class="text-danger">*</sup></label>
                                                <div class="col-sm-8 pl-lg-0">
                                                    <small class="error-message" id="title_err"
                                                           style="display: none;"></small>
                                                    <input type="text" name="title" class="form-control" value="{{ @$termsAndCondition->title }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-input-area">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">
                                                    Description <sup class="text-danger">*</sup></label>
                                                <div class="col-sm-8 pl-lg-0">
                                                    <small class="error-message" id="backinputone_err"
                                                           style="display: none;"></small>
                                                    <textarea class="form-control"
                                                              placeholder="Description" name="backinputone" id="backinputone"> {!! @$termsAndCondition->description !!}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-input-area">
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label">
                                                        Status </label>
                                                    <div class="col-sm-8 pl-lg-0">
                                                        <label class="switch">
                                                            <input type="checkbox" id="event-fee-switch1"
                                                                   name="active_status" value="1" {{@$termsAndCondition->active_status == '1'?'checked':'' }}>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-md-4 pt-4">
                                            <button type="submit" class="btn form-button btn-success add-terms-and-condition">Save</button>
                                        </div>
                                    </div>
                                </form>
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

    <script>
        CKEDITOR.replace( 'backinputone' );
    </script>
    <script src="{{asset('assets')}}/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets/plugin/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('assets/plugin/chosen/prism.js') }}"></script>
    <script src="{{asset('assets/admin/custom/js/setting/terms-and-condition/terms-and-condition.js')}}"></script>
@endsection

