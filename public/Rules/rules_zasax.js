jQuery("#edit").click(function(){
    if(dataRow == ""){
        alertify.error("Засах мөрийг сонгоно уу!!!");
        return;
    }
        jQuery("#txtRules").val(dataRow['bulegNer']);
    jQuery('#editRules').modal('show');
});



jQuery("#editSaveRule").click(function(){
    editsRules();
});


function editsRules(){
    jQuery.ajax({
        type:"post",
        url:jQuery("#editSaveRule").attr("post-url"),
        data:{
            _token:jQuery('meta[name="csrf-token"]').attr('content'),
            id:dataRow['id'],
            bulegNer:jQuery("#txtRules").val(),
        },
        success:function(res){
            if(res.status === "alertify.success"){
                alertify.success(res.msg);
                resetDB();
                jQuery('#editRules').modal('hide');
            }
            else{
                alertify.error(res.msg);
            }
        }
    });
}

function resetDB(){
    jQuery('#rules').dataTable().fnDestroy();
    var table = jQuery('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "ajax":{
            "url": getTable,
            "dataType": "json",
            "type": "get",
            "data":{
            }
        },
        columns: [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'bulegNer', name: 'bulegNer'},
        ],
        "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Хайлт илэрцгүй байна",
            "info": "Нийт _PAGES_ хуудаснаас _PAGE_-р хуудсыг харж байна (нийт _MAX_ ш )",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх : ",

            "paginate": {
                "previous": "Өмнөх",
                "next": "Дараах"
            }
        },
    }).ajax.reload();
}
