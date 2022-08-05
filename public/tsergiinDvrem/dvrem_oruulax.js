jQuery("#newDvrem").click(function(){
    if(jQuery("#durem").val() == "-1"){
        alertify.error("Дүрэм сонгоно уу!");
        return;
    }
    if(jQuery("#buleg").val() == "-1"){
        alertify.error("Бүлэг сонгоно уу!");
        return;
    }
    if(CKEDITOR.instances['my-editor'].getData() == ""){
        alertify.error("Өгөгдөл оруулна уу!");
        return;
    }

    jQuery.ajax({
        type: "post",
        url: jQuery("#newDvrem").attr("post-url"),
        data: {
            _token:jQuery('meta[name="csrf-token"]').attr('content'),
            duremID:jQuery("#durem").val(),
            bulegID:jQuery("#buleg").val(),
            mainInfo: CKEDITOR.instances['my-editor'].getData(),
        },
        success:function(res){
            if("alertify.success"){
                alertify.success(res.msg);
                // location.reload();
            }
            else{
                alertify.error(res.msg);
            }
        }
    })
});


jQuery(document).ready(function(){
    jQuery("#durem").on('change', function(){
        jQuery.ajax({
            type: "post",
            url: jQuery("#durem").attr("post-url"),
            data: {
                _token:jQuery('meta[name="csrf-token"]').attr('content'),
                id:jQuery("#durem").val(),
            },
            success:function(res){
                console.log(res)
                jQuery("#buleg").children().remove();
                jQuery.each(res, function(index) {
                    jQuery("#buleg")
                    .append("<option value="+res[index].bulegID+">"+res[index].name+"</option>")
                });
            }
        })
    });
});
