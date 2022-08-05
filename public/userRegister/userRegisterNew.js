jQuery("#addGroup").click(function () {
    jQuery("#newUserRegister").modal("show");
});

jQuery("#btnSaveRule").click(function () {
    if (jQuery("#phone_number").val() == "") {
        alertify.error("Утасны дугаар оруулна уу!");
        return;
    }
    if (jQuery("#money").val() == "") {
        alertify.error("Мөнгөн дүн оруулна уу!");
        return;
    }
    if (jQuery("#date").val() == "") {
        alertify.error("Огноо оруулна уу!");
        return;
    }

    jQuery.ajax({
        type: "post",
        url: jQuery("#btnSaveRule").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr("content"),
            phone_number: jQuery("#phone_number").val(),
            money: jQuery("#money").val(),
            date: jQuery("#date").val(),
            isToken: jQuery("#isToken").val(),
            tailbar: jQuery("#tailbar").val(),
        },
        success: function (res) {
            if (res.status === "success") {
                alertify.success(res.msg);
                jQuery("#newUserRegister").modal("hide");
                resetDB();
            } else {
                alertify.error(res.msg);
            }
        },
    });
    function resetDB() {
        jQuery("#userRegister").dataTable().fnDestroy();
        var table = jQuery(".data-table")
            .DataTable({
                dom: "Bfrtip",
                buttons: ["print", "excel"],
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
                    {
                        data: "isToken",
                        name: "isToken",
                        render: function (data, type, row, meta) {
                            if (data != 0) {
                                return "Идэвхитэй";
                            } else {
                                return "Идэвхигүй";
                            }
                        },
                    },
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
});
