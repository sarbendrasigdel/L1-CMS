
$('body').delegate('input.required', 'keyup',function(event){
    if($(this).val() == ''){
        $(this).parent().find('.lg-error').html($(this).attr('placeholder')+' is required').show();
    }else{
        $(this).parent().find('.lg-error').html('').hide();

        if (event.which === 13) {
            $('.btn-login').trigger('click');
        }

    }
});


$('.btn-login').on('click', function(e){
    e.preventDefault();

    var formStatus = true;
    $('#loginForm input.required').each(function () {
        if ($(this).val() == '') {
            formStatus = false;
            $(this).parent().find('.lg-error').html($(this).attr('placeholder')+' is required').show();
        } else {
            $(this).parent().find('.lg-error').html('').hide();
        }
    });

    if (formStatus) {
        captchaFormId = "loginForm";
        grecaptcha.execute();
    }


});

function onSubmit(token) {
    $('.loader-container').show();
    var formData = $('form#loginForm').serializeArray();
    $.ajax({
        type: "POST",
        url: baseUrl + "admin-login",
        data: formData,
        success: function(data){
            if(data.status == 'true'){
                window.location = data.url;
            }else{
                $('form#loginForm').find('.lg-error').each(function(){
                    $(this).empty().hide();
                });
                $('form#loginForm').find('.lg-error-top').empty().append('<span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> '+ data.message).show();
                $('.loader-container').hide();
            }
        },
        error: function(error){
            if( error.status === 422 && error.readyState == 4) {
                $('form#loginForm').find('.lg-error').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#loginForm').find('#'+key+'_error').empty().append('<span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> '+ val).show();
                });
                $('.loader-container').hide();
            }
        },
    });
}

