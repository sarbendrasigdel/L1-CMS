@extends('layout.admin.master-layout')
@section('additional-css')
    <link rel="stylesheet" href="{{asset('assets/admin/custom/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/sweetalert/sweetalert.css')}}">
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
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        @include('layout.common.modal-spinner')

                        <form id="add-site-settings-form" autocomplete="off">
                            @csrf
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Site Information</legend>
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
                                                       value="{{ @$siteSettings->company_name}}">
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
                                                           value="{{ @$siteSettings->company_logo ?? ""}}">
                                                </div>

                                                <div id="holder">
                                                    <img
                                                        src="{{asset(@$siteSettings->company_logo)}}"
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
                                                       value="{{ @$siteSettings->company_email ?? '' }}">
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
                                                       value="{{ @$siteSettings->company_location ?? ''}}">
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
                                                       value="{{ @$siteSettings->contact_number ?? ''}}">
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
                                                       value="{{ @$siteSettings->copyright}}">
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
                                                       value="{{ @$siteSettings->meta_title}}">
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
                                                          class="form-control">{{ @$siteSettings->meta_description}}</textarea>
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
                                                               value="1" {{@$siteSettings->active_status == true ? 'checked':'' }} >
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Social Media</legend>

                                <div class="row">
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Facebook </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="facebook_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Facebook" name="facebook"
                                                       value="{{ @$siteSettings->facebook ?? ''}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Instagram </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="instagram_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Instagram" name="instagram"
                                                       value="{{ @$siteSettings->instagram ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Twitter </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="twitter_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Twitter" name="twitter"
                                                       value="{{ @$siteSettings->twitter ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Linkedin </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="linkedin_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Linkedin" name="linkedin"
                                                       value="{{ @$siteSettings->linkedin ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Youtube </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="youtube_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Youtube" name="youtube"
                                                       value="{{ @$siteSettings->youtube ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="offset-md-6 pt-4">
                                <button type="submit" class="btn form-button btn-success add-site-settings">Save
                                </button>
                            </div>
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
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        var route_prefix = "{{ url('/laravel-filemanager') }}";
        $('.lfm').filemanager('image', {prefix: route_prefix});
    </script>
    <script src="{{asset('assets/admin/custom/js/setting/site-setting/site-setting.js')}}"></script>
@endsection


