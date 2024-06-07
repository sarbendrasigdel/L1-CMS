
//fetch record in data table
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
        url: basePath + 'admin/fetch-mails',
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
        $(row).attr('data-id', data.MailId);
    },
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'email'},
        {data: 'created_at'},
        {data: 'actions', searchable: false, orderable: false, sortable: false,
            render: function(data, type, dataObject, meta) {
                var action = '';
                if(dataObject.is_editable){
                    if(dataObject.edit_permission){
                        action += '<a href="javascript:void(0);" data-toggle="modal" data-target="#viewModal" class="btn btn-sm form-button btn-success view-record" data-backdrop="static" data-keyboard="false"><i class="mr-1 fa fa-eye"></i> View</a>';
                    }

                    if(dataObject.delete_permission){
                        action += '<a href="javascript:void(0);" class="btn btn-sm form-button btn-danger delete-record"><i class="mr-1 fa fa-trash"></i> Delete</a>';
                    }
                }else{
                    action += 'Cannot be edited';
                }
                return action;
            }
        }
    ],
});