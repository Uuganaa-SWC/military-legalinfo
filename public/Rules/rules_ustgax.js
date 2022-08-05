// Delete user
jQuery(document).ready(function(){
    jQuery("#ruleDelete").click(function(){
        if(dataRow == ""){
            alertify.error("Устгах мөрийг сонгоно уу !!");
            return;
        }
        alertify.confirm( 'Дүрэм устгах !!','Та дүрэм устгахдаа итгэлтэй байна уу?', function (e) {
                if (e) {
                jQuery.ajax({
                        type: 'get',
                        url: ruleDelete,
                        data: {
                        id:dataRow['id']
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
        jQuery('#rules').dataTable().fnDestroy();
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
});
