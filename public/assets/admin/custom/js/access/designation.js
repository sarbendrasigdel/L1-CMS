$(function(){
    $('.created_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
});

/*========== SCRIPT TO ADD NEW DESIGNATION =================*/

$('.add-designation').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = $('form#add-designation-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/designations",
        data: form_data,
        success: function (data) {
            $('form#add-designation-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                designationTable.draw();
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

/*========== END SCRIPT TO ADD NEW DESIGNATION =================*/

/*========== START SCRIPT TO EDIT AND VIEW DESIGNATION =================*/
$('#viewModal').find(".btn-edit").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to edit this designation ?")) {
        $("input,.form-control").prop("disabled", false);
        $(".btn-edit").hide("500");
        $("#viewModal .modal-footer").show("500");
        $(".btn").removeClass("disabled");
    }
    else {
    }
});

$('table#designation-table').delegate('.view-designation', 'click', function(){
    var designationId = $(this).parents('tr').attr('data-id');
    $.get(basePath+"admin/designations/"+designationId+"/edit", function(designation){
        var form = $('form#edit-designation-form');
        form.find('input[name="designation_id"]').val(designationId);
        form.find('input[name="designation_name"]').val(designation.name);
        if(designation.active_status){
            form.find('input[name="active_status"]').prop('checked', true);
        }
        var user = '';
        if(designation.admin_user_info){
            user += '<div class="col-md-6"><label class="col-form-label">Created By : <b>'+designation.admin_user_info.full_name+'</b> </label></div>';
            user += '<div class="col-md-6"><label class="col-form-label">Created Date : <b>'+designation.created_at+'</b> </label></div>';
        }

        if(designation.updated_by_admin_user_info){
            user += '<div class="col-md-6"><label class="col-form-label">Last Modified By : <b>'+designation.updated_by_admin_user_info.full_name+'</b> </label></div>';
            user += '<div class="col-md-6"><label class="col-form-label">Last Modified Date : <b>'+designation.updated_at+'</b> </label></div>';
        }
        form.find('.user-data').html(user);

        form.find('textarea').prop("disabled", true);
        form.find('input').each(function(){
            $(this).prop("disabled", true);
        });
    });
});

$('#viewModal').on('hidden.bs.modal', function(){
    $('form#edit-designation-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-designation-form')[0].reset();
    $("#viewModal .modal-footer").hide("500");
    $(".btn-edit").show("500");
});

$('.reset-edit-designation-form').click(function(e){
    e.preventDefault();
    $('form#edit-designation-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-designation-form')[0].reset();
});

$('.update-designation').click(function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var designationId = $('form#edit-designation-form').find('input[name="designation_id"]').val();
    var form_data = $('form#edit-designation-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/designations/"+ designationId,
        data: form_data,
        success: function (data) {
            $('form#edit-designation-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                designationTable.draw();
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
                $('form#edit-designation-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#edit-designation-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#edit-designation-form').find('#' + key + '_err').show();
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
/*========== END SCRIPT TO EDIT AND VIEW DESIGNATION =================*/

/*========== START SCRIPT TO DELETE DESIGNATION =================*/
$('table#designation-table').delegate('.delete-designation', 'click', function(e){
    e.preventDefault();
    var designationId = $(this).parents('tr').attr('data-id');
    var thisReference = $(this);
    swal({
        title: "Are you sure want to delete this designation?",
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
                url: basePath + 'admin/designations/' + designationId,
                type: 'post',
                data:{ id:designationId, _method: 'DELETE', _token: csrfToken
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

/*========== SCRIPT FOR JQUERY DATATABLE =================*/
var designationTable = $('#designation-table').DataTable({
    order: [0, 'desc'],
    dom: 'lfrtip',
    serverSide: true,
    responsive: true,
    processing: true,
    language: {
        processing: '<div class="loader-containers"><div class="loader-contents"><img src="'+basePath +'assets/admin/images/loader.svg" alt=""></div></div>',
    },
    "ajax": {
        url: basePath + 'admin/fetch-designations',
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
        $(row).attr('data-id', data.designationId);
    },
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'created_by_admin_users_info_id'},
        {data: 'created_at'},
        {data: 'active_status',
            render: function(data, type, dataObject, meta) {
                if(data){
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">InActive</span>';
                }
            }
        },
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

$('.custom-select').on('change', function () {
    $('body').find('#designation-table_length select').val($(this).val()).trigger('change');
});

$('form#advancedSearchForm').find('.search_designations').on('click', function () {
    designationTable.draw();
});

$('#searchForm').keyup(function(){
    $('body').find('#designation-table_filter input').val($(this).val()).trigger('keyup');
});

$('form#advancedSearchForm').find('.reset').on('click', function(){
    $('form#advancedSearchForm').find('select').each(function(){
        $(this).select2('destroy');
    });
    $('form#advancedSearchForm')[0].reset();
    $('form#advancedSearchForm').find('select').each(function(){
        $(this).addClass('select2');
    });
    $(".select2").select2();
    designationTable.draw();
});
/*========== END SCRIPT FOR JQUERY DATATABLE =================*/

/*========== SCRIPT FOR DESIGNATION EXPORT =================*/
$('.export').on('click', function(e){
    e.preventDefault();
    var form = $('form#advancedSearchForm');
    var searchFormData = {
        name: form.find('input[name="designation_name"]').val(),
        created_by: form.find('input[name="created_by"]').val(),
        created_date: form.find('input[name="created_date"]').val(),
        active_status: form.find('select[name="active_status"]').val(),
        search_key: $('#searchForm').val(),
    }

    var url = basePath + "admin/designations/export?"+  $.param(searchFormData);


    window.location = url;
});
/*========== END SCRIPT FOR DESIGNATION EXPORT =================*/
