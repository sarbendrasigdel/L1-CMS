$(function(){
    $('.created_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });

    $('form#add-role-form').find('input[type="search"]').on('keyup change', function(){
        var searchKey = $(this).val();
        if(searchKey != ''){
            $('form#add-role-form').find('.perm-block').each(function(){
                var permission = $(this).find('strong:first').text();
                if(permission.toLowerCase().search(searchKey.toLowerCase()) > -1){
                    $(this).removeClass('incorrect');
                }else{
                    $(this).addClass('incorrect');
                }
            });
        }else{
            $('form#add-role-form').find('.perm-block').each(function(){
                $(this).removeClass('incorrect');
            });
        }
    });

    $('form#edit-role-form').find('input[type="search"]').on('keyup change', function(){
        var searchKey = $(this).val();
        if(searchKey != ''){
            $('form#edit-role-form').find('.perm-block').each(function(){
                var permission = $(this).find('strong:first').text();
                if(permission.toLowerCase().search(searchKey.toLowerCase()) > -1){
                    $(this).removeClass('incorrect');
                }else{
                    $(this).addClass('incorrect');
                }
            });
        }else{
            $('form#edit-role-form').find('.perm-block').each(function(){
                $(this).removeClass('incorrect');
            });
        }
    });
});
/*========== SCRIPT TO ADD NEW ROLE =================*/
$('.row-check').change(function(){
    var className = $(this).attr('data-perm');
    if($(this).prop("checked") == true){
        $('.'+className).find('input[name="permissions[]"]').each(function(){
            $(this).prop("checked", true);
        });
    }else{
        $('.'+className).find('input[name="permissions[]"]').each(function(){
            $(this).prop("checked", false);
        });
    }
});

$('.add-role').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = $('form#add-role-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/roles",
        data: form_data,
        success: function (data) {
            $('form#add-role-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                rolesTable.draw();
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
                $('form#add-role-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#add-role-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#add-role-form').find('#' + key + '_err').show();


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
    $('form#add-role-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find('form#add-role-form')[0].reset();
});

$('.reset-role').click(function(e){
    e.preventDefault();
    $('form#add-role-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find('form#add-role-form')[0].reset();
});

/*========== END SCRIPT TO ADD NEW ROLE =================*/

/*========== START SCRIPT TO EDIT AND VIEW ROLE =================*/
$('#viewModal').find(".btn-edit").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to edit this role ?")) {
        $("input,.form-control").prop("disabled", false);
        $(".btn-edit").hide("500");
        $("#viewModal .modal-footer").show("500");
        $(".btn").removeClass("disabled");
    }
    else {
    }
});

$('table#role-table').delegate('.view-role', 'click', function(){
    var roleId = $(this).parents('tr').attr('data-id');
    $.get(basePath+"admin/roles/"+roleId+"/edit", function(role){
        var form = $('form#edit-role-form');
        form.find('input[name="role_id"]').val(roleId);
        form.find('input[name="role_name"]').val(role.name);
        form.find('input[name="display_name"]').val(role.display_name);
        if(role.active_status){
            form.find('input[name="active_status"]').prop('checked', true);
        }
        $.each(role.permissions, function(index, perm){
            form.find('input[name="permissions[]"][value="'+perm.id+'"]').prop('checked',true);
        });
        var user = '';
        if(role.admin_user_info){
            user += '<div class="col-md-6"><label class="col-form-label">Created By : <b>'+role.admin_user_info.full_name+'</b> </label></div>';
            user += '<div class="col-md-6"><label class="col-form-label">Created Date : <b>'+role.created_at+'</b> </label></div>';
        }

        if(role.updated_by_admin_user_info){
            user += '<div class="col-md-6"><label class="col-form-label">Last Modified By : <b>'+role.updated_by_admin_user_info.full_name+'</b> </label></div>';
            user += '<div class="col-md-6"><label class="col-form-label">Last Modified Date : <b>'+role.updated_at+'</b> </label></div>';
        }
        form.find('.user-data').html(user);

        form.find('input').each(function(){
           $(this).prop("disabled", true);
        });
    });
});

$('#viewModal').on('hidden.bs.modal', function(){
    $('form#edit-role-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-role-form')[0].reset();
    $("#viewModal .modal-footer").hide("500");
    $(".btn-edit").show("500");
});

$('.reset-edit-role-form').click(function(e){
    e.preventDefault();
    $('form#edit-role-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-role-form')[0].reset();
});

$('.update-role').click(function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var roleId = $('form#edit-role-form').find('input[name="role_id"]').val();
    var form_data = $('form#edit-role-form').serializeArray();
    $.ajax({
        type: "POST",
        url: basePath + "admin/roles/"+ roleId,
        data: form_data,
        success: function (data) {
            $('form#edit-role-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                rolesTable.draw();
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
                $('form#edit-role-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#edit-role-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#edit-role-form').find('#' + key + '_err').show();
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
/*========== END SCRIPT TO EDIT AND VIEW ROLE =================*/

/*========== END SCRIPT TO DELETE ROLE =================*/
$('table#role-table').delegate('.delete-role', 'click', function(e){
    e.preventDefault();
    var roleId = $(this).parents('tr').attr('data-id');
    var thisReference = $(this);
    swal({
        title: "Are you sure want to delete this role?",
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
                url: basePath + 'admin/roles/' + roleId,
                type: 'post',
                data:{ id:roleId, _method: 'DELETE', _token: csrfToken
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
            swal("Not Deleted", "Role is not Deleted. it is save.", "error");
        }
    });
});
/*========== END SCRIPT TO DELETE ROLE =================*/

/*========== SCRIPT FOR JQUERY DATATABLE =================*/
var rolesTable = $('#role-table').DataTable({
    order: [0, 'desc'],
    dom: 'lfrtip',
    serverSide: true,
    responsive: true,
    processing: true,
    language: {
        processing: '<div class="loader-containers"><div class="loader-contents"><img src="'+basePath +'assets/admin/images/loader.svg" alt=""></div></div>',
    },
    "ajax": {
        url: basePath + 'admin/fetch-roles',
        type: "POST",
        dataType: 'json',

        'data': function (data) {
            data._token = csrfToken;
            data.columns[1]['search']['value'] = $('#advancedSearchForm').find('input[name="role_name"]').val();
            data.columns[2]['search']['value'] = $('#advancedSearchForm').find('input[name="display_name"]').val();
            data.columns[3]['search']['value'] = $('#advancedSearchForm').find('input[name="created_by"]').val();
            data.columns[4]['search']['value'] = $('#advancedSearchForm').find('input[name="created_date"]').val();
            data.columns[5]['search']['value'] =  $('#advancedSearchForm').find('select[name="active_status"]').val();
        },
        error: function (error) {
            console.log(error);
        }
    },
    'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-id', data.roleId);
    },
    columns: [
        {data: 'id',},
        {data: 'name'},
        {data: 'display_name'},
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
                if(dataObject.edit_permission){
                    action += '<a href="javascript:void(0);" data-toggle="modal" data-target="#viewModal" class="btn btn-sm form-button btn-success view-role" data-backdrop="static" data-keyboard="false"><i class="mr-1 fa fa-eye"></i> View</a>';
                }

                if(dataObject.delete_permission){
                    action += '<a href="javascript:void(0);" class="btn btn-sm form-button btn-danger delete-role"><i class="mr-1 fa fa-trash"></i> Delete</a>';
                }
                return action;
            }
        }
    ],
});

$('.custom-select').on('change', function () {
    $('body').find('#role-table_length select').val($(this).val()).trigger('change');
});

$('form#advancedSearchForm').find('.search_roles').on('click', function () {
    rolesTable.draw();
});

$('#searchForm').keyup(function(){
    $('body').find('#role-table_filter input').val($(this).val()).trigger('keyup');
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
    rolesTable.draw();
});
/*========== END SCRIPT FOR JQUERY DATATABLE =================*/

/*========== SCRIPT FOR ROLES EXPORT =================*/
$('.export_role').on('click', function(e){
    e.preventDefault();
    var form = $('form#advancedSearchForm');
    var searchFormData = {
        name: form.find('input[name="role_name"]').val(),
        display_name: form.find('input[name="display_name"]').val(),
        created_by: form.find('input[name="created_by"]').val(),
        created_date: form.find('input[name="created_date"]').val(),
        active_status: form.find('select[name="active_status"]').val(),
        search_key: $('#searchForm').val(),
    }

    var url = basePath + "admin/roles/export?"+  $.param(searchFormData);


    window.location = url;
});
/*========== END SCRIPT FOR ROLES EXPORT =================*/
