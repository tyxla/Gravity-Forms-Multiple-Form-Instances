/*
Copyright 2009-2016 Rocketgenius, Inc.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/

//----------------------------------------
//------ MULTIFILE UPLOAD FUNCTIONS ------
//----------------------------------------

(function (gfMultiFileUploader, $) {
    gfMultiFileUploader.uploaders = {};
    var strings = typeof gform_gravityforms != 'undefined' ? gform_gravityforms.strings : {};
    var imagesUrl = typeof gform_gravityforms != 'undefined' ? gform_gravityforms.vars.images_url : "";

    $(document).unbind('gform_post_render');
    $(document).bind('gform_post_render', function(e, formID){

        $("form#gform_" + formID + " .gform_fileupload_multifile").each(function(){
            setup(this);
        });
        var $form = $("form#gform_" + formID);
        if($form.length > 0){
            $form.submit(function(){
                var pendingUploads = false;
                $.each(gfMultiFileUploader.uploaders, function(i, uploader){
                    if(uploader.total.queued>0){
                        pendingUploads = true;
                        return false;
                    }
                });
                if(pendingUploads){
                    alert(strings.currently_uploading);
                    window["gf_submitting_" + formID] = false;
                    $('#gform_ajax_spinner_' + formID).remove();
                    return false;
                }
            });
        }

    });

    gfMultiFileUploader.setup = function (uploadElement){
        setup( uploadElement );
    };

    function setup(uploadElement){
        var settings = $(uploadElement).data('settings');

        var uploader = new plupload.Uploader(settings);
        formID = uploader.settings.multipart_params.random_id;
        gfMultiFileUploader.uploaders[settings.container] = uploader;
        var formID;
        var uniqueID;

        uploader.bind('Init', function(up, params) {
            if(!up.features.dragdrop)
                $(".gform_drop_instructions").hide();
            var fieldID = up.settings.multipart_params.field_id;
            var maxFiles = parseInt(up.settings.gf_vars.max_files);
            var initFileCount = countFiles(fieldID);
            if(maxFiles > 0 && initFileCount >= maxFiles){
                gfMultiFileUploader.toggleDisabled(up.settings, true);
            }

        });

        gfMultiFileUploader.toggleDisabled = function (settings, disabled){

            var button = typeof settings.browse_button == "string" ? $("#" + settings.browse_button) : $(settings.browse_button);
            button.prop("disabled", disabled);
        };

        function addMessage(messagesID, message){
            $("#" + messagesID).prepend("<li>" + message + "</li>");
        }

        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {
            var max = parseInt(up.settings.gf_vars.max_files),
                fieldID = up.settings.multipart_params.field_id,
                totalCount = countFiles(fieldID),
                disallowed = up.settings.gf_vars.disallowed_extensions,
                extension;

            if( max > 0 && totalCount >= max){
                $.each(files, function(i, file) {
                    up.removeFile(file);
                    return;
                });
                return;
            }
            $.each(files, function(i, file) {

                extension = file.name.split('.').pop();

                if($.inArray(extension, disallowed) > -1){
                    addMessage(up.settings.gf_vars.message_id, file.name + " - " + strings.illegal_extension);
                    up.removeFile(file);
                    return;
                }

                if ((file.status == plupload.FAILED) || (max > 0 && totalCount >= max)){
                    up.removeFile(file);
                    return;
                }

                var size = typeof file.size !== 'undefined' ? plupload.formatSize(file.size) : strings.in_progress;
                var status = '<div id="'
                    + file.id
                    + '" class="ginput_preview">'
                    + file.name
                    + ' (' + size + ') <b></b> '
                    + '<a href="javascript:void(0)" title="' + strings.cancel_upload + '" onclick=\'$this=jQuery(this); var uploader = gfMultiFileUploader.uploaders.' + up.settings.container + ';uploader.stop();uploader.removeFile(uploader.getFile("' + file.id +'"));$this.after("' + strings.cancelled + '"); uploader.start();$this.remove();\' onkeypress=\'$this=jQuery(this); var uploader = gfMultiFileUploader.uploaders.' + up.settings.container + ';uploader.stop();uploader.removeFile(uploader.getFile("' + file.id +'"));$this.after("' + strings.cancelled + '"); uploader.start();$this.remove();\'>' + strings.cancel + '</a>'
                    + '</div>';

                $('#' + up.settings.filelist).prepend(status);
                totalCount++;

            });

            up.refresh(); // Reposition Flash

            var formElementID = "form#gform_" + formID;
            var uidElementID = "input:hidden[name='gform_unique_id']";
            var uidSelector = formElementID + " " + uidElementID;
            var $uid = $(uidSelector);
            if($uid.length==0){
                $uid = $(uidElementID);
            }

            uniqueID = $uid.val();
            if('' === uniqueID){
                uniqueID = generateUniqueID();
                $uid.val(uniqueID);
            }


            if(max > 0 && totalCount >= max){
                gfMultiFileUploader.toggleDisabled(up.settings, true);
                addMessage(up.settings.gf_vars.message_id, strings.max_reached)
            }


            up.settings.multipart_params.gform_unique_id = uniqueID;
            up.start();

        });

        uploader.bind('UploadProgress', function(up, file) {
            var html = file.percent + "%";
            $('#' + file.id + " b").html(html);
        });

        uploader.bind('Error', function(up, err) {
            if(err.code === plupload.FILE_EXTENSION_ERROR){
                var extensions = typeof up.settings.filters.mime_types != 'undefined' ? up.settings.filters.mime_types[0].extensions /* plupoad 2 */ : up.settings.filters[0].extensions;
                addMessage(up.settings.gf_vars.message_id, err.file.name + " - " + strings.invalid_file_extension + " " + extensions);
            } else if (err.code === plupload.FILE_SIZE_ERROR) {
                addMessage(up.settings.gf_vars.message_id, err.file.name + " - " + strings.file_exceeds_limit);
            } else {
                var m = "<li>Error: " + err.code +
                    ", Message: " + err.message +
                    (err.file ? ", File: " + err.file.name : "") +
                    "</li>";

                addMessage(up.settings.gf_vars.message_id, m);
            }
            $('#' + err.file.id ).html('');

            up.refresh(); // Reposition Flash
        });

        uploader.bind('FileUploaded', function(up, file, result) {
            var response = $.secureEvalJSON(result.response);
            if(response.status == "error"){
                addMessage(up.settings.gf_vars.message_id, file.name + " - " + response.error.message);
                $('#' + file.id ).html('');
                return;
            }

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

            html = gform.applyFilters( 'gform_file_upload_markup', html, file, up, strings, imagesUrl );

            $( '#' + file.id ).html( html );

            var fieldID = up.settings.multipart_params["field_id"];

            if(file.percent == 100){
                if(response.status && response.status == 'ok'){
                    addFile(fieldID, response.data);
                }  else {
                    addMessage(up.settings.gf_vars.message_id, strings.unknown_error + ': ' + file.name);
                }
            }



        });

        function getAllFiles(){
            var selector = '#gform_uploaded_files_' + formID,
                $uploadedFiles = $(selector), files;

            files = $uploadedFiles.val();
            files = (typeof files === "undefined") || files === '' ? {} : $.parseJSON(files);

            return files;
        }


        function getFiles(fieldID){
            var allFiles = getAllFiles();
            var inputName = getInputName(fieldID);

            if(typeof allFiles[inputName] == 'undefined')
                allFiles[inputName] = [];
            return allFiles[inputName];
        }

        function countFiles(fieldID){
            var files = getFiles(fieldID);
            return files.length;
        }

        function addFile(fieldID, fileInfo){

            var files = getFiles(fieldID);

            files.unshift(fileInfo);
            setUploadedFiles(fieldID, files);
        }

        function setUploadedFiles(fieldID, files){
            var allFiles = getAllFiles();
            var $uploadedFiles = $('#gform_uploaded_files_' + formID);
            var inputName = getInputName(fieldID);
            allFiles[inputName] = files;
            $uploadedFiles.val($.toJSON(allFiles));
        }

        function getInputName(fieldID){
            return "input_" + fieldID;
        }

        // fixes drag and drop in IE10
        $("#" + settings.drop_element).on({
            "dragenter": ignoreDrag,
            "dragover": ignoreDrag
        });

        function ignoreDrag( e ) {
            e.preventDefault();
        }
    }


    function generateUniqueID() {
        return 'xxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : r & 0x3 | 0x8;
            return v.toString(16);
        });
    }


}(window.gfMultiFileUploader = window.gfMultiFileUploader || {}, jQuery));