//----------------------------------------
//------ MULTIFILE UPLOAD FUNCTIONS ------
//----------------------------------------

(function (gform, gfMultiFileUploader, $) {
    $(document).bind('gform_post_render', function(e, formID){

        $("form#gform_" + formID + " .gform_fileupload_multifile").each(function(){
            var settings = $(this).data('settings');
            var uploader = gfMultiFileUploader.uploaders[settings.container];
            uploader.bind('BeforeUpload', function(up, file) {
                uploader.settings.multipart_params.form_id = uploader.settings.multipart_params.original_id;
            });
        });

    });

    gform.addFilter('gform_file_upload_markup', function(html, file, up, strings, imagesUrl){
        var html = '<strong>' + file.name + '</strong>';
        var formId = up.settings.multipart_params.random_id;
        var fieldId = up.settings.multipart_params.field_id;
        html = "<img "
            + "class='gform_delete' "
            + "src='" + imagesUrl + "/delete.png' "
            + "onclick='gformDeleteUploadedFile(" + formId + "," + fieldId + ", this);' "
            + "onkeypress='gformDeleteUploadedFile(" + formId + "," + fieldId + ", this);' "
            + "alt='"+ strings.delete_file + "' "
            + "title='" + strings.delete_file
            + "' /> "
            + html;
        return html;
    });

}(window.gform = window.gform || {}, window.gfMultiFileUploader = window.gfMultiFileUploader || {}, jQuery));