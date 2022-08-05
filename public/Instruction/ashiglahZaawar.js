jQuery("#newInstruction").click(function () {
    if (CKEDITOR.instances["my-editor"].getData() == "") {
        alertify.error("Заавар оруулна уу!");
        return;
    }

    jQuery.ajax({
        type: "post",
        url: jQuery("#newInstruction").attr("post-url"),
        data: {
            id: ID,
            _token: jQuery('meta[name="csrf-token"]').attr("content"),
            ashiglahMain: CKEDITOR.instances["my-editor"].getData(),
        },
        success: function (res) {
            if (res.status === "alertify.success") {
                alertify.success(res.msg);
            } else {
                alertify.error(res.msg);
            }
        },
    });
});
