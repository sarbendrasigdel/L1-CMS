$(function(){
    $('.created_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
});

var addForm = $('form#add-form');
$('.add-btn').on('click', function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var form_data = addForm.serializeArray();

    $.ajax({
        type: "POST",
        url: basePath + "admin/seo-setting",
        data: form_data,
        success: function (data) {
            addForm.find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                masterTable.draw();
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
    $('#addModal').find(addForm)[0].reset();
    addForm.find('select').each(function(){
        $(this).val("");
        $(this).select2("destroy").select2();
    });
    $('.collapse').collapse("hide");
});

$('.reset-btn').click(function(e){
    e.preventDefault();
    addForm.find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#addModal').find(addForm)[0].reset();
    addForm.find('select').each(function(){
        $(this).val("");
        $(this).select2("destroy").select2();
    });
});

/*========== END SCRIPT TO ADD NEW DESIGNATION =================*/

/*========== START SCRIPT TO EDIT AND VIEW DESIGNATION =================*/
$('#viewModal').find(".btn-edit").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to edit?")) {
        $("input,.form-control").prop("disabled", false);
        $(".btn-edit").hide("500");
        $("#viewModal .modal-footer").show("500");
        $(".btn").removeClass("disabled");
    }
    else {
    }
});


var editForm = $('form#edit-form');
$('table#master-table').delegate('.view-btn', 'click', function(){
    var globalDataId = $(this).parents('tr').attr('data-id');
    $.get(basePath+"admin/seo-setting/"+globalDataId+"/edit", function(data){
        editForm.find('input[name="editFormId"]').val(globalDataId);
        editForm.find('select[name="page_name"]').val(data.page_name).select2("destroy").select2();
        editForm.find('input[name="meta_title"]').val(data.meta_title);
        editForm.find('textarea[name="meta_description"]').val(data.meta_description);

        if(data.active_status){
            editForm.find('input[name="active_status"]').prop('checked', true);
        }

        editForm.find('select').prop("disabled", true);
        editForm.find('textarea').prop("disabled", true);
        editForm.find('input').each(function(){
            $(this).prop("disabled", true);
        });

    });
});

$('#viewModal').on('hidden.bs.modal', function(){
    editForm.find('.error-message').each(function(){
        $(this).empty().hide();
    });
    $('#viewModal').find(editForm)[0].reset();
    $(".btn-edit").show();
    $("#viewModal .modal-footer").hide("500");
});


$('.update-btn').click(function(e){
    e.preventDefault();
    $('.modal-spinner').show();
    var globalDataId = editForm.find('input[name="editFormId"]').val();
    var form_data = editForm.serializeArray();

    $.ajax({
        type: "POST",
        url: basePath + "admin/seo-setting/"+ globalDataId,
        data: form_data,
        success: function (data) {
            editForm.find('.error-message').each(function(){
                $(this).empty().hide();
            });
            if (data.status) {
                masterTable.draw();
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
                editForm.find('.error-message').each(function(){
                    $(this).empty().hide();
                });
                var errors = $.parseJSON(error.responseText);
                $.each(errors.errors, function (key, val) {
                    editForm.find('#' + key + '_err').empty().append('<i class="fa fa-info-circle"></i>' + val);
                    editForm.find('#' + key + '_err').show();
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
$('table#master-table').delegate('.delete-btn', 'click', function(e){
    e.preventDefault();
    var globalDataId = $(this).parents('tr').attr('data-id');
    var thisReference = $(this);
    swal({
        title: "Are you sure want to delete this?",
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
                url: basePath + 'admin/seo-setting/' + globalDataId,
                type: 'post',
                data:{ id:globalDataId, _method: 'DELETE', _token: csrfToken
                },
                success: function(data){
                    console.log(data)
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
                        swal("Not Deleted", data.message, "error");
                    }
                },
                error: function(){},
            });
        }else{
            swal("Not Deleted", "Data is not Deleted. it is save.", "error");
        }
    });
});


/*========== END SCRIPT TO DELETE DESIGNATION =================*/

/*========== SCRIPT FOR JQUERY DATATABLE =================*/
var masterTable = $('#master-table').DataTable({
    order: [0, 'desc'],
    dom: 'lfrtip',
    serverSide: true,
    responsive: true,
    processing: true,
    language: {
        processing: '<div class="loader-containers"><div class="loader-contents"><img src="'+basePath +'assets/admin/images/loader.svg" alt=""></div></div>',
    },
    "ajax": {
        url: basePath + 'admin/fetch-seo-setting',
        type: "POST",
        dataType: 'json',

        'data': function (data) {
            data._token = csrfToken;
            data.columns[1]['search']['value'] = $('#advancedSearchForm').find('input[name="name"]').val();
            data.columns[2]['search']['value'] =  $('#advancedSearchForm').find('select[name="active_status"]').val();
        },
        error: function (error) {
            console.log(error);
        }
    },
    'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-id', data.globalDataId);
    },
    columns: [
        {data: 'id'},
        {data: 'page_name'},
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
                    action += '<a href="javascript:void(0);" data-toggle="modal" data-target="#viewModal" class="btn btn-sm form-button btn-success view-btn" data-backdrop="static" data-keyboard="false"><i class="mr-1 fa fa-eye"></i> View</a>';
                }
                if(dataObject.delete_permission){
                    action += '<a href="javascript:void(0);" class="btn btn-sm form-button btn-danger delete-btn"><i class="mr-1 fa fa-trash"></i> Delete</a>';
                }
                return action;
            }
        }
    ],
});

$('.custom-select').on('change', function () {
    $('body').find('#master-table_length select').val($(this).val()).trigger('change');
});

$('form#advancedSearchForm').find('.search_field').on('click', function () {
    masterTable.draw();
});

$('#searchForm').keyup(function(){
    $('body').find('#master-table_filter input').val($(this).val()).trigger('keyup');
});

$('form#advancedSearchForm').find('.reset_advance_search').on('click', function(){
    $('form#advancedSearchForm')[0].reset();
    $('select[name="active_status"]').trigger("change");
    masterTable.draw();
});
/*========== END SCRIPT FOR JQUERY DATATABLE =================*/
