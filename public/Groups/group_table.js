// Yajra Datatable
jQuery(function(){
    var table = jQuery('#groups').DataTable({
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
    });
});


//Row selected and row color
jQuery(document).ready(function(){
    var table = jQuery('#groups').DataTable();

    jQuery('#groups tbody').on('click', 'tr', function(){
        // var data = table.row(this).data();

        if (jQuery(this).hasClass('selected'))  {
            jQuery(this).removeClass('selected');
            dataRow = "";
        }
        else {
            jQuery('tr.selected').removeClass('selected');
            jQuery(this).addClass('selected');
            var currow = jQuery(this).closest('tr');
            dataRow = jQuery('#groups').DataTable().row(currow).data();
            jQuery('#btnEdit').attr('href', urlAtag+"/"+dataRow['id']);
        }

    })
});
