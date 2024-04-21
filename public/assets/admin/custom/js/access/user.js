$(function(){
    $('.created_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
    });

    $('.multiple').select2({
        allowClear: true
    });

    $('form#add-user-form').find('input[type="search"]').on('keyup change', function(){
        var searchKey = $(this).val();
        if(searchKey != ''){
            $('form#add-user-form').find('.perm-block').each(function(){
                var permission = $(this).find('strong:first').text();
                if(permission.toLowerCase().search(searchKey.toLowerCase()) > -1){
                    $(this).removeClass('incorrect');
                }else{
                    $(this).addClass('incorrect');
                }
            });
        }else{
            $('form#add-user-form').find('.perm-block').each(function(){
                $(this).removeClass('incorrect');
            });
        }
    });

    $('form#edit-user-form').find('input[type="search"]').on('keyup change', function(){
        var searchKey = $(this).val();
        if(searchKey != ''){
            $('form#edit-user-form').find('.perm-block').each(function(){
                var permission = $(this).find('strong:first').text();
                if(permission.toLowerCase().search(searchKey.toLowerCase()) > -1){
                    $(this).removeClass('incorrect');
                }else{
                    $(this).addClass('incorrect');
                }
            });
        }else{
            $('form#edit-user-form').find('.perm-block').each(function(){
                $(this).removeClass('incorrect');
            });
        }
    });
});

/*========== SCRIPT TO ADD NEW USER =================*/
$(".chosen-select-width").chosen({ width: '100%' });
var addForm = $('body').find('form#add-user-form');
addForm.find('select[name="role"]').change(function(){
    $('.collapse').collapse("hide");
    var roleId = $(this).val();
    $.get(basePath+"admin/users/"+roleId+"/permission", function(role){
        var rolePermissions = '';
        var morePermission = '';
        $.each(role.permissions, function(index, perm){
            rolePermissions += '<div class="col-md-4 mt-2 perm-block"><strong>'+index[0].toUpperCase() +
                index.slice(1)+' Permissions</strong><hr class="mt-2 mb-2"/>';
            $.each(perm, function(key, value){
                rolePermissions += '<div class=""><span class="chk-wrap mr-2"><label class="check-in-label">';
                rolePermissions += '<input type="checkbox" class="sel sel-master" name="permissions[]" value="'+value['id']+'">';
                rolePermissions += '<span class="checkmark"></span></label></span> <span style="display: inline-block; vertical-align: sub;">'+value['display_name']+'</span> </div>';
            });
            rolePermissions += '</div>';
            setTimeout(function () {
                $('.sel').prop("checked", true);
                // $('.row-check-sel').prop("checked", true);
            }, 200);
        });
        if(role.morePermissions != ''){
            $.each(role.morePermissions, function(index, perm){
                morePermission += '<div class="col-md-4 mt-2 perm-block"><strong>'+index[0].toUpperCase() +
                    index.slice(1)+' Permissions</strong><hr class="mt-2 mb-2"/>';
                $.each(perm, function(key, value){
                    morePermission += '<div class=""><span class="chk-wrap mr-2"><label class="check-in-label">';
                    morePermission += '<input type="checkbox" class="nosel sel-master"  name="permissions[]" value="'+value['id']+'">';
                    morePermission += '<span class="checkmark"></span></label></span> <span style="display: inline-block; vertical-align: sub;">'+value['display_name']+'</span> </div>';
                });
                morePermission += '</div>';
            });
        }else{
            morePermission += '<div class="col-md-4 mt-2"><strong>No Permissions</strong></div>';
        }
        addForm.find('#role-perm').empty().html(rolePermissions);
        addForm.find('#more-perm').empty().html(morePermission);
        addForm.find('#more-perm').parents('.form-input-area').show();
    });
});

$('.add-user').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = new FormData();
    var form = addForm.serializeArray();
    $.each(form, function(key, val){
        form_data.append(val.name, val.value);
    });
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: basePath + "admin/users",
        data: form_data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            addForm.find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                userTable.draw();
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

/*========== END SCRIPT TO ADD NEW USER =================*/

/*========== START SCRIPT TO EDIT AND VIEW ADMIN USERS =================*/
$('#viewModal').find(".btn-edit").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to edit this user ?")) {
        $("input,.form-control").prop("disabled", false);
        $(".btn-edit").hide("500");
        $("#viewModal .modal-footer").show("500");
        $("#viewModal .form-button").show("500");
        $(".btn").removeClass("disabled");
        $('#change-pass').find('input').each(function(){
            if($('#change-pass').hasClass('collapse show')){
                $(this).prop("disabled", false);
            }else{
                $(this).prop("disabled", true);
            }
        });
    }
    else {
    }
});

$('#viewModal').find('.change-password').click(function(e){
    e.preventDefault();
    $('#viewModal').animate({ scrollTop: 0 }, 'slow');
    $('#change-pass').find('input').each(function(){
        if($('#change-pass').hasClass('collapse show')){
            $(this).prop("disabled", true);
            $('#change-pass').removeClass("change-pass");
        }else{
            $(this).prop("disabled", false);
            $('#change-pass').addClass("change-pass");
        }
    });
});

var editForm = $('form#edit-user-form');
$('table#user-table').delegate('.view-user', 'click', function(){
    var userId = $(this).parents('tr').attr('data-id');
    var log = $(this).attr('data-log');
    if(log == 1){
        $('#viewModal').find('.btn-edit').hide();
    }else{
        $('#viewModal').find('.btn-edit').show();
    }
    $.get(basePath+"admin/users/"+userId+"/edit", function(data){
        editForm.find('input[name="user_id"]').val(data.user.admin_user.id);
        editForm.find('input[name="full_name"]').val(data.user.full_name);
        editForm.find('input[name="email"]').val(data.user.email);
        editForm.find('input[name="phone"]').val(data.user.phone_number);
        editForm.find('select[name="designation"]').val(data.user.latest_designation.designation_id);
        editForm.find('select[name="designation"]').select2().trigger("change");
        editForm.find('input[name="address"]').val(data.user.address);
        if(data.user.admin_user.active_status){
            editForm.find('input[name="active_status"]').prop('checked', true);
        }
        var userData = '';
        if(data.user.admin_user_created_by){
            userData += '<div class="col-md-6"><label class="col-form-label">Created By : <b>'+data.user.admin_user_created_by.full_name+'</b> </label></div>';
            userData += '<div class="col-md-6"><label class="col-form-label">Created Date : <b>'+data.user.created_at+'</b> </label></div>';
        }

        if(data.user.admin_user_updated_by){
            userData += '<div class="col-md-6"><label class="col-form-label">Last Modified By : <b>'+data.user.admin_user_updated_by.full_name+'</b> </label></div>';
            userData += '<div class="col-md-6"><label class="col-form-label">Last Modified Date : <b>'+data.user.updated_at+'</b> </label></div>';
        }
        editForm.find('.user-data').html(userData);


        var assignedPermissions = '';
        var morePermission = '';
        $.each(data.permissions, function(index, perm){
            assignedPermissions += '<div class="col-md-4 mt-2 perm-block"><strong>'+index[0].toUpperCase() +
                index.slice(1)+' Permissions</strong><hr class="mt-2 mb-2"/>';
            $.each(perm, function(key, value){
                assignedPermissions += '<div class=""><span class="chk-wrap mr-2"><label class="check-in-label">';
                assignedPermissions += '<input type="checkbox" name="permissions[]" value="'+value['id']+'" checked="">';
                assignedPermissions += '<span class="checkmark"></span></label></span> <span style="display: inline-block; vertical-align: sub;">'+value['display_name']+'</span> </div>';
            });
            assignedPermissions += '</div>';
        });
        if(data.morePermissions != ''){
            $.each(data.morePermissions, function(index, perm){
                morePermission += '<div class="col-md-4 mt-2 perm-block"><strong>'+index[0].toUpperCase() +
                    index.slice(1)+' Permissions</strong><hr class="mt-2 mb-2"/>';
                $.each(perm, function(key, value){
                    morePermission += '<div class=""><span class="chk-wrap mr-2"><label class="check-in-label">';
                    morePermission += '<input type="checkbox" name="permissions[]" value="'+value['id']+'">';
                    morePermission += '<span class="checkmark"></span></label></span> <span style="display: inline-block; vertical-align: sub;">'+value['display_name']+'</span> </div>';
                });
                morePermission += '</div>';
            });
        }else{
            morePermission += '<div class="col-md-4 mt-2"><strong>No Permissions</strong></div>';
        }

        editForm.find('#assigned-perm').empty().html(assignedPermissions);
        editForm.find('#more-perm').empty().html(morePermission);
        editForm.find('input').each(function(){
            $(this).prop("disabled", true);
        });

        editForm.find('select').prop('disabled', true);
    });
});

$('#viewModal').on('hidden.bs.modal', function(){
    $('form#edit-user-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-user-form')[0].reset();
    $("#viewModal .modal-footer").hide("500");
    $("#viewModal .form-button").hide("500");
    $(".btn-edit").show("500");
    $('.collapse').collapse("hide");
});

$('.reset-edit-user-form').click(function(e){
    e.preventDefault();
    $('form#edit-user-form').find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find('form#edit-user-form')[0].reset();
    editForm.find('select').each(function(){
         $(this).val("");
         $(this).select2().trigger("change");
     });

    editForm.find('input[type="checkbox"]').each(function(){
         $(this).prop("checked", false);
     });
});

$('.update-user').click(function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var userId = $('form#edit-user-form').find('input[name="user_id"]').val();
    var form_data = new FormData();
    var form = editForm.serializeArray();
    $.each(form, function(key, val){
        form_data.append(val.name, val.value);
    });
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: basePath + "admin/users/"+ userId,
        data: form_data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            $('form#edit-user-form').find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                userTable.draw();
                $('#viewModal').modal('hide');
                $('.bg-success').find('.message-title').empty().text(data.title);
                $('.bg-success').find('.message-body').empty().text(data.message);
                $('.bg-success').show();
                setInterval(function () {
                    $('.bg-success').hide();
                }, 5000);
            } else {
                $('.modal-spinner').show();
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
                $('form#edit-user-form').find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    $('form#edit-user-form').find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    $('form#edit-user-form').find('#' + key + '_err').show();
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
/*========== END SCRIPT TO EDIT AND VIEW ADMIN USERS =================*/

/*========== START SCRIPT TO DELETE ADMIN USERS =================*/
$('table#user-table').delegate('.delete-user', 'click', function(e){
    e.preventDefault();
    var userId = $(this).parents('tr').attr('data-id');
    var thisReference = $(this);
    if($('#advancedSearchForm').find('input[name="log"]').prop("checked")){
        var log = 1;
    }else{
        var log = 0;
    }
    swal({
        title: "Are you sure want to delete this admin user?",
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
                url: basePath + 'admin/users/' + userId,
                type: 'post',
                data:{ log: log, id: userId, _method: 'DELETE', _token: csrfToken
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
            swal("Not Deleted", "Admin user is not Deleted. it is save.", "error");
        }
    });
});
/*========== END SCRIPT TO DELETE ADMIN USERS =================*/

/*========== START SCRIPT TO SWITCH PORTAL OF ADMIN USERS =================*/
/*========== END SCRIPT TO SWITCH PORTAL OF ADMIN USERS =================*/

/*========== SCRIPT FOR JQUERY DATATABLE =================*/
var userTable = $('#user-table').DataTable({
    order: [0, 'desc'],
    dom: 'lfrtip',
    serverSide: true,
    responsive: true,
    processing: true,
    language: {
        processing: '<div class="loader-containers"><div class="loader-contents"><img src="'+basePath +'assets/admin/images/loader.svg" alt=""></div></div>',
    },
    "ajax": {
        url: basePath + 'admin/fetch-users',
        type: "POST",
        dataType: 'json',

        'data': function (data) {
            data._token = csrfToken;
            data.columns[1]['search']['value'] = $('#advancedSearchForm').find('input[name="full_name"]').val();
            data.columns[2]['search']['value'] = $('#advancedSearchForm').find('input[name="username"]').val();
            data.columns[3]['search']['value'] = $('#advancedSearchForm').find('input[name="email"]').val();
            data.columns[4]['search']['value'] =  $('#advancedSearchForm').find('select[name="designation[]"]').val();
            data.columns[5]['search']['value'] = $('#advancedSearchForm').find('input[name="phone_number"]').val();
            data.columns[6]['search']['value'] = $('#advancedSearchForm').find('input[name="address"]').val();
            data.columns[7]['search']['value'] =  $('#advancedSearchForm').find('select[name="active_status"]').val();
            data.columns[8]['search']['value'] = $('#advancedSearchForm').find('input[name="created_by"]').val();
            var fromDate = $('#advancedSearchForm').find('input[name="from_date"]').val();
            var toDate = $('#advancedSearchForm').find('input[name="to_date"]').val();
            if(fromDate != ''){
                data.columns[10]['search']['value'] = fromDate;
                data.date = toDate;
            }else{
                data.columns[10]['search']['value'] = toDate;
                data.date = fromDate;
            }
            if($('#advancedSearchForm').find('input[name="log"]').prop("checked")){
                data.log = 1;
            }else{
                data.log = 0;
            }
        },
        error: function (error) {
            console.log(error);
        }
    },
    'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-id', data.userId);
    },
    columns: [
        {data: 'id'},
        {data: 'full_name'},
        {data: 'username'},
        {data: 'email'},
        {data: 'designation', orderable: false, sortable: false},
        {data: 'phone_number'},
        {data: 'address'},
        {data: 'active_status',
            render: function(data, type, dataObject, meta) {
                if(data){
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">InActive</span>';
                }
            }
        },
        {data: 'user_created_by_users_info_id'},
        {data: 'created_at'},
        {data: 'actions', searchable: false, orderable: false, sortable: false,
            render: function(data, type, dataObject, meta) {
                var action = '';
                if(dataObject.edit_permission){
                    action += '<a href="javascript:void(0);" data-toggle="modal" data-target="#viewModal" class="btn btn-sm form-button btn-success view-user" data-log="'+dataObject.log+'" data-backdrop="static" data-keyboard="false"><i class="mr-1 fa fa-eye"></i> View</a>';
                }

                // if(!dataObject.is_auth_user){
                //     if(dataObject.delete_permission){
                //         action += '<a href="javascript:void(0);" class="btn btn-sm form-button btn-danger delete-user"><i class="mr-1 fa fa-trash"></i> Delete</a>';
                //     }
                // }
                return action;
            }
        }
    ],
});

$('.custom-select').on('change', function () {
    $('body').find('#user-table_length select').val($(this).val()).trigger('change');
});

$('form#advancedSearchForm').find('.search_users').on('click', function () {
    userTable.draw();
});

$('#searchForm').keyup(function(){
    $('body').find('#user-table_filter input').val($(this).val()).trigger('keyup');
});

$('form#advancedSearchForm').find('.reset').on('click', function(){
    $('form#advancedSearchForm').find('select').each(function(){
        $(this).select2('destroy');
    });
    $('form#advancedSearchForm')[0].reset();
    $('form#advancedSearchForm').find('select').each(function(){
        $(this).addClass('select2');
    });
    $('form#advancedSearchForm').find(".select2").select2();
    $(".chosen-select-width").val([]);
    $(".chosen-select-width").trigger('chosen:updated');
    userTable.draw();
});
/*========== END SCRIPT FOR JQUERY DATATABLE =================*/

/*========== SCRIPT FOR Admin Users EXPORT =================*/
$('.export').on('click', function(e){
    e.preventDefault();
    var form = $('form#advancedSearchForm');
    var fromDate = $('#advancedSearchForm').find('input[name="from_date"]').val();
    var toDate = $('#advancedSearchForm').find('input[name="to_date"]').val();
    if(fromDate != ''){
        var createdDate = toDate;
        var date = toDate;
    }else{
        var createdDate = toDate;
        var date = fromDate;
    }
    if($('#advancedSearchForm').find('input[name="log"]').prop("checked")){
        var log = 1;
    }else{
        var log = 0;
    }
    var searchFormData = {
        full_name: form.find('input[name="full_name"]').val(),
        username: form.find('input[name="username"]').val(),
        email: form.find('input[name="email"]').val(),
        designation:  form.find('select[name="designation"]').val(),
        phone_number: form.find('input[name="phone_number"]').val(),
        address: form.find('input[name="address"]').val(),
        active_status:  form.find('select[name="active_status"]').val(),
        created_by: form.find('input[name="created_by"]').val(),
        created_date: createdDate,
        date: date,
        log: log,
        search_key: $('#searchForm').val(),
    }

    var url = basePath + "admin/users/export?"+  $.param(searchFormData);


    window.location = url;
});
/*========== END SCRIPT FOR Admin Users EXPORT =================*/

