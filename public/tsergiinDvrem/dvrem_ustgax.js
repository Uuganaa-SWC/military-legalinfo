// Delete user
jQuery(document).ready(function(){
    jQuery("#delete").click(function(){
        if(dataRow == ""){
            alertify.error("Устгах мөрийг сонгоно уу !!");
            return;
        }
        alertify.confirm( 'Дүрэм устгах !!','Та дүрэм устгахдаа итгэлтэй байна уу?', function (e) {
                if (e) {
                jQuery.ajax({
                        type: 'get',
                        url: medeeDelete,
                        data: {
                        id:dataRow['idid']
                        },
                    success:function(res){
                        if(res.status == 'success'){
                            alertify.success(res.msg);
                            dataRow = "";
                            resetDB();
                            table.rows('.selected').remove().draw(false);
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
        jQuery('#dvrem').dataTable().fnDestroy();
        var table = jQuery('.data-table').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "responsive":true,
            "ajax":{
                "url": getTable,
                "dataType": "json",
                "type": "get",
                "data":{
                }
            },
            columns: [
                { data: "idid", name: "idid",  render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'bulegNer', name: 'bulegNer'},
                {data: 'name', name: 'name'},
                // {data: 'mainInfo', name: 'mainInfo'},
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
