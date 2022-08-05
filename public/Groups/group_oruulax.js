jQuery("#addGroup").click(function(){
    jQuery('#newGroup').modal('show');
})


jQuery("#btnSaveRule").click(function(){
    if(jQuery("#cmbRules").val() == "-1"){
        alertify.error("Дүрэм сонгоно уу!");
        return;
    }
    if(jQuery("#txtGroup").val() == ""){
        alertify.error("Бүлгийн нэршил оруулна уу!");
        return;
    }

    jQuery.ajax({
        type:"post",
        url:jQuery("#btnSaveRule").attr("post-url"),
        data:{
            _token:jQuery('meta[name="csrf-token"]').attr('content'),
            duremID:jQuery("#cmbRules").val(),
            name:jQuery("#txtGroup").val(),
        },
        success:function(res){
            if(res.status === "alertify.success"){
                alertify.success(res.msg);
                resetDB();
                jQuery('#newRules').modal('hide');
                location.reload();
            }
            else{
                alertify.error(res.msg);
            }
        }
    });
    function resetDB(){
        jQuery('#groups').dataTable().fnDestroy();
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
                {data: 'name', name: 'name'}
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
})
