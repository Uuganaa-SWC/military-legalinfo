jQuery("#btnSetFeaturedImage").click(function(){
    window.open(
        "/laravel-filemanager?type=Images&amp;CKEditor=description&amp;CKEditorFuncNum=1&amp;langCode=en",
        "",
        "width='80%',height=600,left=200,top=200"
    );
});

window.SetUrl = (url, width, height, alt) => {
    jQuery("#Image").val(url[0].url);
    // setPdf(url[0].url);
};

jQuery("#newMedee").click(function(){
    if(jQuery("#txtTitle").val() == ""){
        alertify.error("Гарчиг оруулна уу!");
        return;
    }
    if(jQuery("#Image").val() == ""){
        alertify.error("Зураг оруулна уу!");
        return;
    }

    jQuery.ajax({
        type: "POST",
        url: jQuery("#newMedee").attr("post-url"),
        data:{
            _token: jQuery('meta[name="csrf-token"]').attr('content'),
            id: jQuery("#medeeID").val(),
            title: jQuery("#txtTitle").val(),
            image: jQuery("#Image").val(),
            about: CKEDITOR.instances['my-editor'].getData(),
        },
        success:function(res){
            if(res.status === "alertify.success"){
                alertify.success(res.msg);
            }
            else{
                alertify.error(res.msg);
            }
        }
    });
});
