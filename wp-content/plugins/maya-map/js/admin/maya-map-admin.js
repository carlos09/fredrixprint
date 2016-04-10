jQuery(document).ready(function() {
/*
jQuery('#upload_maya_map_custom_marker').click(function() {
   //$tax_image_id=jQuery('.tax_image').attr('id');
 formfield = jQuery('#maya_map_custom_marker').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 //console.log(formfield);
 return false;
});

window.send_to_editor = function(html) {
 img_map_url = jQuery('img',html).attr('src');
  console.log(img_map_url);
jQuery('#maya_map_custom_marker').val(img_map_url);
 tb_remove();
}*/
var uploadID = ''; /*setup the var*/

jQuery('#upload_maya_map_custom_marker').click(function() {
    uploadID = jQuery(this).prev('input'); /*grab the specific input*/
    formfield = jQuery('#maya_map_custom_marker').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            uploadID.val(imgurl); /*assign the value to the input*/
            tb_remove();
        };
    return false;
});


jQuery('.failed_rows_wrapper .table_wrapper').hide();
jQuery('.failed_rows_wrapper .failed_rows_wrapper_show').click(function(){
    jQuery('.failed_rows_wrapper .table_wrapper').slideToggle(400);
});

});