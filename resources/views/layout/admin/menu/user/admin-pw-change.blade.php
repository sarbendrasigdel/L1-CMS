@extends('layout.admin.master-layout')
@section('additional-css')
    <link rel="stylesheet" href="{{asset('assets/admin/custom/css/custom.css')}}">
@endsection
@section('main-content')
    @include('layout.common.messages.error')
    @include('layout.common.messages.success')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-box">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <header class="page-header">
                                    <h3>
                                        Change Password
                                    </h3>
                                </header>
                            </div>
                        </div>
                        <form id="add-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Old Password <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-4 pl-lg-0">
                                            <input type="password"
                                                   class="form-control" id="old_password"
                                                   placeholder="Old Password" name="old_password" />
                                            <div class="pw-show-hide pw-show-hide-js">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </div>
                                            <small class="error-message" id="old_password_err" style="display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            New Password <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-4 pl-lg-0">
                                            <input type="password"
                                                   class="form-control" id="password"
                                                   placeholder="New Password" name="password" />
                                            <div class="pw-show-hide pw-show-hide-js">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </div>
                                            <small class="error-message" id="password_err" style="display: none;"></small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Confirm Password <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-4 pl-lg-0">
                                            <input type="password"
                                                   class="form-control" id="password_confirmation"
                                                   placeholder="Confirm Password"
                                                   name="password_confirmation" value="{{ old('password_confirmation') }}" />
                                            <div class="pw-show-hide pw-show-hide-js">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </div>
                                            <small class="error-message" id="password_confirmation_err" style="display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success add-btn">Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional-js')
    <script>
        $(function() {
            var timeout = 3000; // in miliseconds (3*1000)
            $('.alert').delay(timeout).fadeOut(300);
        });
    </script>
    <script>
        $('.add-btn').on('click', function(e){
            e.preventDefault();
            $('.modal-spinner').show();
            var form_data = $('form#add-form').serializeArray();

            $.ajax({
                type: "POST",
                url: basePath + "admin/admin-pw-change",
                data: form_data,
                success: function (data) {
                    $('form#add-form').find('.error-message').each(function(){
                        $(this).empty().hide();
                    });
                    if (data.status) {
                        setTimeout(function () {
                            location.href = data.logout;
                        }, 1000);
                        $('.bg-success').find('.message-title').empty().text(data.title);
                        $('.bg-success').find('.message-body').empty().text(data.message);
                        $('.bg-success').show();
                        setInterval(function () {
                            $('.bg-success').hide();
                        }, 5000);
                    } else {
                        $('.modal-spinner').hide();
                        $('.bg-danger').find('.message-title').empty().text(data.title);
                        $('.bg-danger').find('.message-body').empty().text(data.message);
                        $('.bg-danger').show();
                        setInterval(function () {
                            $('.bg-danger').hide();
                        }, 5000);
                    }
                },
                error: function (error) {
                    if (error.status === 422 && error.readyState == 4) {
                        $('.modal-spinner').hide();
                        $('form#add-form').find('.error-message').each(function(){
                            $(this).empty().hide();
                        });
                        var errors = $.parseJSON(error.responseText);
                        $.each(errors.errors, function (key, val) {
                            $('form#add-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                            $('form#add-form').find('#' + key + '_err').show();
                        });
                    }
                }
            });
        });
    </script>
@endsection
