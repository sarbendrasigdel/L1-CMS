var addForm = $('form#add-site-settings-form');
$('.add-site-settings').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = new FormData();

    var form = addForm.serializeArray();
    $.each(form, function(key, val){
        form_data.append(val.name, val.value);
    });
    $.ajax({
        type: "POST",
        url: basePath + "admin/site-settings",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            addForm.find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                $('#addModal').modal('hide');
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
                addForm.find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    addForm.find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    addForm.find('#' + key + '_err').show();


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