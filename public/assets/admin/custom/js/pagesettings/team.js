// $(".chosen-select-width").chosen({ width: '100%' });

$('.add-user').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = $('form#add-team-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/add-team",
        data: form_data,
        success: function (data) {
            $('form#add-designation-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                teamTable.draw();
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
                $('form#add-designation-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#add-designation-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#add-designation-form').find('#' + key + '_err').show();


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

$('#addModal').on('hidden.bs.modal', function(){
    addForm.find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find('form#add-user-form')[0].reset();
    addForm.find('#role-perm').empty();
    addForm.find('#more-perm').empty();
    addForm.find('#more-perm').parents('.form-input-area').hide();
    $('.collapse').collapse("hide");
});

$('.reset-user').click(function(e){
    e.preventDefault();
    addForm.find('.error-message').each(function(){
        $(this).empty().hide();
    });
});

var teamTable = $('#master-table').DataTable({
    order: [0, 'desc'],
    dom: 'lfrtip',
    serverSide: true,
    responsive: true,
    processing: true,
    language: {
        processing: '<div class="loader-containers"><div class="loader-contents"><img src="'+basePath +'assets/admin/images/loader.svg" alt=""></div></div>',
    },
    "ajax": {
        url: basePath + 'admin/fetch-teams',
        type: "POST",
        dataType: 'json',

        'data': function (data) {
            data._token = csrfToken;
            data.columns[1]['search']['value'] = $('#advancedSearchForm').find('input[name="designation_name"]').val();
            data.columns[2]['search']['value'] = $('#advancedSearchForm').find('input[name="created_by"]').val();
            data.columns[3]['search']['value'] = $('#advancedSearchForm').find('input[name="created_date"]').val();
            data.columns[4]['search']['value'] =  $('#advancedSearchForm').find('select[name="active_status"]').val();
        },
        error: function (error) {
            console.log(error);
        }
    },
    'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-id', data.teamId);
    },
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'position'},
        {data: 'active_status',
        render: function(data, type, dataObject, meta) {
            if(data){
                return '<span class="badge badge-success">Active</span>';
            }else{
                return '<span class="badge badge-danger">InActive</span>';
            }
        }
    },
    {data: 'created_at'},
        {data: 'actions', searchable: false, orderable: false, sortable: false,
            render: function(data, type, dataObject, meta) {
                var action = '';
                if(dataObject.is_editable){
                    if(dataObject.edit_permission){
                        action += '<a href="javascript:void(0);" data-toggle="modal" data-target="#viewModal" class="btn btn-sm form-button btn-success view-designation" data-backdrop="static" data-keyboard="false"><i class="mr-1 fa fa-eye"></i> View</a>';
                    }

                    if(dataObject.delete_permission){
                        action += '<a href="javascript:void(0);" class="btn btn-sm form-button btn-danger delete-designation"><i class="mr-1 fa fa-trash"></i> Delete</a>';
                    }
                }else{
                    action += 'Cannot be edited';
                }
                return action;
            }
        }
    ],
});

/*========== END SCRIPT TO ADD NEW DESIGNATION =================*/

/*========== START SCRIPT TO EDIT AND VIEW DESIGNATION =================*/
//edit 
$('#viewModal').find(".btn-edit").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to edit this record ?")) {
        $("input,.form-control").prop("disabled", false);
        $(".btn-edit").hide("500");
        $("#viewModal .modal-footer").show("500");
        $(".btn").removeClass("disabled");
    }
    else {
    }
});
$('#viewModal').on('hidden.bs.modal', function () {
    $("input,.form-control").prop("disabled", true);
    $('#viewModal .btn-edit').show();
    $("#viewModal .modal-footer").hide();
});


// fetch previous data
$('table#master-table').delegate('.view-designation', 'click', function(){
    var teamId = $(this).parents('tr').attr('data-id');
    $.get(basePath+"admin/team/"+teamId+"/edit", function(team){
        var form = $('form#edit-form');
        form.find('input[name="id"]').val(teamId);
        form.find('input[name="name"]').val(team.name);
        form.find('input[name="team_image"]').val(team.image);
        form.find('div#holder img').val(team.image);
        form.find('input[name="position"]').val(team.position);
        form.find('input[name="facebook"]').val(team.facebook);
        form.find('input[name="instagram"]').val(team.instagram);
        form.find('input[name="twitter"]').val(team.twitter);
        form.find('input[name="github"]').val(team.github);
        if(team.active_status){
            form.find('input[name="active_status"]').prop('checked', true);
        }
        if(team.image)
            {
                form.find('#holder img').attr('src',imagePath+team.image);
            }
       

        form.find('textarea').prop("disabled", true);
        form.find('input').each(function(){
            $(this).prop("disabled", true);
        });
    });
});

$('#addModal').on('hidden.bs.modal', function(){
    $('form#add-designation-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find('form#add-designation-form')[0].reset();
});

$('.reset-designation').click(function(e){
    e.preventDefault();
    $('form#add-designation-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find('form#add-designation-form')[0].reset();
});

$('.update-designation').click(function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var teamId = $('form#edit-form').find('input[name="id"]').val();
    var form_data = $('form#edit-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/team/"+ teamId,
        data: form_data,
        success: function (data) {
            $('form#edit-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                teamTable.draw();
                $('#viewModal').modal('hide');
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
                $('form#edit-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#edit-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#edit-form').find('#' + key + '_err').show();
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
/*========== END SCRIPT TO EDIT AND VIEW TEAM =================*/

/*========== START SCRIPT TO DELETE TEAM =================*/
$('table#master-table').delegate('.delete-designation', 'click', function(e){
    e.preventDefault();
    var teamId = $(this).parents('tr').attr('data-id');
    var thisReference = $(this);
    swal({
        title: "Are you sure want to delete this member?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#136ba7",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm){
            $.ajax({
                url: basePath + 'admin/teams/' + teamId,
                type: 'post',
                data:{ id:teamId, _method: 'DELETE', _token: csrfToken
                },
                success: function(data){
                    if(data.status){
                        swal({
                            title: data.msg,
                            type: "success",
                            confirmButtonColor: "#136ba7",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true,
                        }, function(isConfirm){
                            if(isConfirm){
                                thisReference.parents('tr').remove();
                            }
                        });
                    }else{
                        swal("Not Deleted", data.msg, "error");
                    }
                },
                error: function(){},
            });
        }else{
            swal("Not Deleted", "Designation is not Deleted. it is save.", "error");
        }
    });
});
/*========== END SCRIPT TO DELETE DESIGNATION =================*/
