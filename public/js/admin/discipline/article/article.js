jQuery("#btnNewArticle").click(function(){
    jQuery('#modalNewArticle').modal('show');
});

jQuery("#cmbLaw").change(function(){
    jQuery("#cmbParentArticle").find('option').remove();
    jQuery("#cmbParentArticle").append('<option value="-1">Сонгоно уу</option>');
    jQuery("#cmbParentArticle").append('<option value="0">Эцэг</option>');
    $.ajax({
      type: 'post',
      url: jQuery("#cmbLaw").attr("post-url"),
      data: {
          _token: jQuery('meta[name="csrf-token"]').attr('content'),
          lawID:jQuery("#cmbLaw").val()
      },
      success:function(res){
          $.each(res, function(i, item) {
              $("#cmbParentArticle").append('<option value="' + item.id + '">' +  item.articleName + '</option>');
          });
      }
    });
});

jQuery("#cmbSearchLaw").change(function(){
    window.location.replace(jQuery("#cmbSearchLaw").attr('post-url') + '/' + jQuery("#cmbSearchLaw").val());
});


jQuery("#btnPostArticle").click(function(){
    var art="0";
    if(jQuery("#cmbLaw").val() == -1){
        alertify.error("Хуулиа сонгоно уу");
        return;
    }
    if(jQuery("#cmbParentArticle").val() == -1){
        art="0";
    }
    else
        art = jQuery("#cmbParentArticle").val();
    if(jQuery("#txtArticleName").val() == ""){
        alertify.error("Заалтын нэрээ бичнэ үү");
        return;
    }
    $.ajax({
      type: 'post',
      url: jQuery("#btnPostArticle").attr("post-url"),
      data: {
          _token: jQuery('meta[name="csrf-token"]').attr('content'),
          lawID:jQuery("#cmbLaw").val(),
          parentID:art,
          articleName:jQuery("#txtArticleName").val()
      },
      success:function(res){
          if(res.status == 'success'){
              alertify.alert(res.msg);
          }
          else{
              alertify.error(res.msg);
          }
      }
    });
});


function refresh(lawID){

}
