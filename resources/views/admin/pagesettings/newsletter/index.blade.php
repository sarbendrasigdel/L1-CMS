@extends('layout.admin.master-layout')
@section('additional-css')
    <link rel="stylesheet" href="{{asset('assets/admin/custom/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/chosen/chosen.css') }}">
    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
        }
    </style>
@endsection
@section('main-content')
    {{-- @include('admin.access.users.partials.view')
    @include('admin.access.users.partials.add') --}}
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        @include('layout.common.modal-spinner')
                        <form id="">
                            @csrf
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Home Page Information</legend>
                                <div class="row">
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Company Name <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_name_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Company Name" name="company_name"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Company Logo <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <div class="input-group">
                                                   <span class="input-group-btn">
                                                     <a data-input="thumbnail" data-preview="holder"
                                                        class="lfm btn btn-primary">
                                                       <i class="fa fa-picture-o"></i> Choose
                                                     </a>
                                                   </span>
                                                    <input id="thumbnail" class="form-control" type="text"
                                                           name="company_logo"
                                                           value="">
                                                </div>

                                                <div id="holder">
                                                    <img
                                                        src=""
                                                        style="height: 5rem;">

                                                </div>
                                                <small class="error-message" id="company_logo_err"
                                                       style="display: none;bottom: 0;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Company Email <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_email_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Company Email" name="company_email"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Company Location <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_location_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Company Location" name="company_location"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Contact Number <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="contact_number_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Contact Number" name="contact_number"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Copyright </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="copyright_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Copyright" name="copyright"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Meta Title </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="meta_title_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Meta Title" name="meta_title"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Meta Description </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="meta_description_err"
                                                       style="display: none;"></small>
                                                <textarea name="meta_description"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-input-area">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label">
                                                    Status </label>
                                                <div class="col-sm-8 pl-lg-0">
                                                    <label class="switch">
                                                        <input type="checkbox" id="event-fee-switch"
                                                               name="active_status"
                                                               value="1"  >
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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
    <script src="{{asset('assets/admin/custom/js/access/user.js')}}"></script>
@endsection
