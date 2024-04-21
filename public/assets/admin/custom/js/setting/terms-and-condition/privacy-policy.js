$(document).ready(function (){
    /*========== SCRIPT TO ADD NEW PRIVACY POLICY =================*/
    $('.add-privacy-policy').on('click', function (e){
        e.preventDefault();
        $('.modal-spinner').show();
        CKEDITOR.instances['backinputone'].updateElement();
        var form_data = $('form#add-privacy-policy-form').serializeArray();
        $.ajax({
            type: "POST",
            url: basePath + "admin/privacy-policy",
            data: form_data,
            dataType: 'json',
            success: function (data) {
                $('form#add-privacy-policy-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                if (data.status) {
                    $('.bg-success').find('.message-title').empty().text(data.title);
                    $('.bg-success').find('.message-body').empty().text(data.message);
                    $('.bg-success').show();
                    setInterval(function () {
                        $('.bg-success').hide();
                    }, 5000);
                } else {
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
                    $('form#add-privacy-policy-form').find('.error-message').each(function(){
                        $(this).empty().hide();
                    });
                    var errors = $.parseJSON(error.responseText);
                    $.each(errors.errors, function (key, val) {
                        $('form#add-privacy-policy-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                        $('form#add-privacy-policy-form').find('#' + key + '_err').show();
                    });
                }
            },
            complete: function(){
                setInterval(function () {
                    $('.modal-spinner').hide();
                }, 1000);
            }
        });
    });
});
