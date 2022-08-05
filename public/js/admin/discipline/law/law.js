var articleID = 0;

    jQuery("#cmbLaw").change(function(){
    jQuery("#cmbParentArticle").find('option').remove();
    jQuery("#cmbParentArticle").append('<option value="-1">Сонгоно уу</option>');
    jQuery("#divChildCombo").hide();
    jQuery("#cmbChildArticle").find('option').remove();
    articleID = 0;
    CKEDITOR.instances.myeditor.setData('');
    $.ajax({
        type: 'post',
        url: jQuery("#cmbLaw").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr('content'),
            lawID:jQuery("#cmbLaw").val()
        },
        success:function(res){
            // console.log(res);
            $.each(res, function(i, item) {
                jQuery("#cmbParentArticle").append('<option value="' + item.id + '">' +  item.articleName + '</option>');
            });
        }
    });
});


$("#cmbParentArticle").change(function(){
    $.ajax({
        type: 'post',
        url: jQuery("#cmbParentArticle").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr('content'),
            id:jQuery("#cmbParentArticle").val()
        },
        success:function(res){
            if(res.length == 0){
                jQuery("#divChildCombo").hide();
                jQuery("#cmbChildArticle").find('option').remove();
                CKEDITOR.instances.myeditor.setData('');
                articleID = jQuery("#cmbParentArticle").val();
                loadLawDetails(jQuery("#cmbParentArticle").val());
            }
            else{
                CKEDITOR.instances.myeditor.setData('');
                jQuery("#divChildCombo").show();
                jQuery("#cmbChildArticle").find('option').remove();
                jQuery("#cmbChildArticle").append('<option value="-1">Сонгоно уу</option>');
                $.each(res, function(i, item) {
                    jQuery("#cmbChildArticle").append('<option value="' + item.id + '">' +  item.articleName + '</option>');
                });
            }

        }
    });
});

jQuery("#cmbChildArticle").change(function(){
    articleID = jQuery("#cmbChildArticle").val();
    loadLawDetails(jQuery("#cmbChildArticle").val());
});


function loadLawDetails(articleID){
    CKEDITOR.instances.myeditor.setData('');
    $.ajax({
        type: 'post',
        url: jQuery("#cmbChildArticle").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr('content'),
            articleID:articleID
        },
        success:function(res){
            if(res.length == 0){
            }
            else{
                $.each(res, function(i, item) {
                    CKEDITOR.instances.myeditor.setData(item.law);
                });
            }

        }
    });
}


$("#btnNewLaw").click(function(){
    if(articleID == 0){
        alertify.error("Бүлэг мүлгээ сонгооч");
        return;
    }
    if(articleID == -1){
        alertify.error("Бүлэг мүлгээ сонгооч");
        return;
    }
    $.ajax({
        type: 'post',
        url: jQuery("#btnNewLaw").attr("post-url"),
        data: {
            _token: jQuery('meta[name="csrf-token"]').attr('content'),
            articleID:articleID,
            law:CKEDITOR.instances["myeditor"].getData()
        },
        success:function(res){
            if(res.status == "success"){
                articleID = 0;
                alertify.alert(res.msg);
            }
            else{
                alertify.error(res.msg);
            }
        }
    });
});
