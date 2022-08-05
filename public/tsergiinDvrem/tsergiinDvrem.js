// Yajra Datatable
jQuery(function(){
    var table = jQuery('#dvrem').DataTable({
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
    });
});


//Row selected and row color
jQuery(document).ready(function(){
    var table = jQuery('#dvrem').DataTable();

    jQuery('#dvrem tbody').on('click', 'tr', function(){
        // var data = table.row(this).data();

        if (jQuery(this).hasClass('selected'))  {
            jQuery(this).removeClass('selected');
            dataRow = "";
        }
        else {
            jQuery('tr.selected').removeClass('selected');
            jQuery(this).addClass('selected');
            var currow = jQuery(this).closest('tr');
            dataRow = jQuery('#dvrem').DataTable().row(currow).data();
            jQuery('#btnEdit').attr('href', urlAtag+"/"+dataRow['idid']);
            console.log(dataRow['idid'])
        }

    })
});


// jQuery(document).ready(function() {
//     jQuery('#dvrem').DataTable( {
//         "columnDefs": [
//             {
//                 "targets": [ 1 ],
//                 "visible": false,
//                 "searchable": false
//             }
//         ]
//     });
// });
