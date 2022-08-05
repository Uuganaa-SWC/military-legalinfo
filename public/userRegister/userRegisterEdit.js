jQuery("#editUser").click(function () {
    if (dataRow == "") {
        alertify.error("Засах мөрийг сонгоно уу!!!");
        return;
    }
    jQuery("#phone_numbers").val(dataRow["phone_number"]);
    jQuery("#moneys").val(dataRow["money"]);
    jQuery("#dates").val(dataRow["date"]);
    jQuery("#isTokens").val(dataRow["isToken"]);
    jQuery("#tailbars").val(dataRow["tailbar"]);
    jQuery("#editUserRegister").modal("show");
});

jQuery("#editSaveUser").click(function () {
    editsRules();
});

function editsRules() {
    jQuery.ajax({
        type: "post",
        url: jQuery("#editSaveUser").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr("content"),
            id: dataRow["id"],
            phone_number: jQuery("#phone_numbers").val(),
            money: jQuery("#moneys").val(),
            date: jQuery("#dates").val(),
            isToken: jQuery("#isTokens").val(),
            tailbar: jQuery("#tailbars").val(),
        },
        success: function (res) {
            if (res.status === "success") {
                alertify.success(res.msg);
                resetDB();
                jQuery("#editUserRegister").modal("hide");
            } else {
                alertify.error(res.msg);
            }
        },
    });
}

function resetDB() {
    jQuery("#userRegister").dataTable().fnDestroy();
    var table = jQuery(".data-table")
        .DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            responsive: true,
            ajax: {
                url: getTable,
                dataType: "json",
                type: "get",
                data: {},
            },
            columns: [
                {
                    data: "id",
                    name: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                { data: "phone_number", name: "phone_number" },
                { data: "money", name: "money" },
                { data: "date", name: "date" },
                // { data: "isToken", name: "isToken" },
                { data: "tailbar", name: "tailbar" },
            ],
            language: {
                lengthMenu: "_MENU_ мөрөөр харах",
                zeroRecords: "Хайлт илэрцгүй байна",
                info: "Нийт _PAGES_ хуудаснаас _PAGE_-р хуудсыг харж байна (нийт _MAX_ ш )",
                infoEmpty: "Хайлт илэрцгүй",
                infoFiltered: "(_MAX_ мөрөөс хайлт хийлээ)",
                sSearch: "Хайх : ",

                paginate: {
                    previous: "Өмнөх",
                    next: "Дараах",
                },
            },
        })
        .ajax.reload();
}
