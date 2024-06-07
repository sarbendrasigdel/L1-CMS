$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$('.add-btn').on('click', function(e){
    e.preventDefault();
    var form_data = $('form#contact-from').serializeArray();

    console.log(form_data);
    $.ajax({
        type: "POST",
        url: basePath + "submit-contact",
        data: form_data,
        success: function (data) {
            // console.log(data);
            alert('Thankyou for your query!');
            $('#contact-from')[0].reset();
        },
        error: function (error) {
            console.log(error)

            if (error.status === 422 && error.readyState == 4) {
                $('form#contact-from').find('.error-message').each(function(){
                    $(this).empty();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#contact-from').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#contact-from').find('#' + key + '_err').show();


                });
            }
        },
        complete: function(){
            console.log('success');
        }
    });
});


});