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
                        <form id="add-form">
                            @csrf
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Hero Section</legend>
                                <div class="row">
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Heading<sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="heading_err"
                                                       style="display: none;"></small>
                                                       <textarea name="heading"
                                                       class="form-control" id="editor1" value=" " 
                                                       placeholder ="Heading">{{@$home->heading}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Description<sup
                                                class="text-danger">*</sup></label> 
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="description_err"
                                                       style="display: none;"></small>
                                                <textarea name="description"
                                                 id="editor2"  class="form-control" value=" ">{{@$home->description}}</textarea>
                                            </div>
                                        </div>
                                </div>
                            </fieldset >
                            <fieldset class="scheduler-border">
                                
                                <legend class="scheduler-border">Discover section</legend>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Discover section Image <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <div class="input-group">
                                               <span class="input-group-btn">
                                                 <a data-input="thumbnail-discover" data-preview="holder-discover"
                                                    class="lfm btn btn-primary">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                               </span>
                                                <input id="thumbnail-discover" class="form-control" type="text"
                                                       name="discover_img"
                                                       value="{{@$home->discover_img ?? ""}}">
                                            </div>
    
                                            <div id="holder-discover">
                                                <img
                                                    src="{{asset(@$home->discover_img)}}"
                                                    style="height: 5rem;">
    
                                            </div>
                                            <small class="error-message" id="discover_img_err"
                                                   style="display: none;bottom: 0;"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Description<sup
                                            class="text-danger">*</sup></label> 
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="discover_text_err"
                                                   style="display: none;"></small>
                                            <textarea name="discover_text"
                                            id="editor3"    class="form-control" value=" ">{{@$home->discover_text}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Founders Quote<sup
                                            class="text-danger">*</sup></label> 
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="quote_err"
                                                   style="display: none;"></small>
                                            <textarea name="quote" id="editor4"
                                                      class="form-control" value="">{{@$home->quote}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                
                                <legend class="scheduler-border">Service section</legend>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">service Image <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <div class="input-group">
                                               <span class="input-group-btn">
                                                 <a data-input="thumbnail-service" data-preview="holder-service"
                                                    class="lfm btn btn-primary">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                               </span>
                                                <input id="thumbnail-service" class="form-control" type="text"
                                                       name="service_img"
                                                       value="{{@$home->service_img ?? ""}}">
                                            </div>
    
                                            <div id="holder-service">
                                                <img
                                                    src="{{asset(@$home->service_img)}}"
                                                    style="height: 5rem;">
    
                                            </div>
                                            <small class="error-message" id="service_img_err"
                                                   style="display: none;bottom: 0;"></small>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </fieldset>
                            <div class="offset-md-6 pt-4">
                                <button type="submit" class="btn form-button btn-success save-button">Save
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
    <script src="{{asset('assets')}}/plugin/dataTables/datatables.min.js"></script>
    <script src="{{asset('assets')}}/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets/plugin/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('assets/plugin/chosen/prism.js') }}"></script>
    <script src="{{asset('assets/admin/custom/js/pagesettings/home.js')}}"></script>
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        var route_prefix = "{{ url('/laravel-filemanager') }}";
        $('.lfm').filemanager('image', {prefix: route_prefix});
    </script>
    <script>
        CKEDITOR.replace("editor1")
        CKEDITOR.replace("editor2")
        CKEDITOR.replace("editor3")
        CKEDITOR.replace("editor4")
    </script>
@endsection
