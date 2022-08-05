// Delete group
jQuery(document).ready(function(){
    jQuery("#groupDelete").click(function(){
        if(dataRow == ""){
            alertify.error("Устгах мөрийг сонгоно уу !!");
            return;
        }
        alertify.confirm( 'Бүлэг устгах !!','Та бүлэг устгахдаа итгэлтэй байна уу?', function (e) {
                if (e) {
                jQuery.ajax({
                        type: 'get',
                        url: groupDelete,
                        data: {
                        id:dataRow['id']
                        },
                    success:function(res){
                        if(res.status == 'success'){
                            alertify.success(res.msg);
                            dataRow = "";
                            resetDB();
                            table.rows('.selected').remove().draw(false);
                            location.reload();
                        }
                        else{
                            alertify.error(res.msg);
                        }
                    }
                });
            }
        }, function(){
            alertify.error("Цуцалсан");
        });
    });
    function resetDB(){
        jQuery('#groups').dataTable().fnDestroy();
        var table = jQuery('.data-table').DataTable({
            "processing": true,
            "serverSide": true,

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
                {data: 'name', name: 'name'},
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
});
