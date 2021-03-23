
function BusinessEdits(rowID, type) {
    CKEDITOR.replace('editor3')

    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    $.ajax({
        url: 'core/ajax_db/businesspages_db',
        method: 'POST',
        dataType: 'json',
        data: {
            key:  type,
            rowID: rowID
        }, success: function (response) {
                $("#id_business").val(rowID);
                $("#The-company-name").val(response.companyname);
                CKEDITOR.instances.editor3.setData(response.overview,function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.editor3.updateElement();
                $("#website").val(response.website);
                $("#Businesspages").attr('value', 'update').attr('onclick', "ajax_requestsBusiness('update_Row')").show();
                $(".modal-title").html(response.companyname);
                $("#editPages").modal('show');
        }
    });
}

function ajax_requestsBusiness(key) {
    CKEDITOR.replace('editor3')

    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    var id = $("#id_business");
    var companyname = $("#The-company-name");
    var editor3 = CKEDITOR.instances.editor3.getData();
    var website = $("#website");

    if (isEmpty(companyname)) {
        
    $.ajax({
        url: 'core/ajax_db/businesspages_db.php',
        type: 'post',
        dataType: 'text',
        data: {
            key: key,
            companyname: companyname.val(),
            overview: editor3,
            website: website.val(),
            rowID: id.val(),

        }, 
        beforeSubmit: function(){
            for(instance in CKEDITOR.instances){
                CKEDITOR.instances[instance].updateElement();
            }
        }, 
        success: function (response) {
            if (response != "success") {
                // alert(response);
                $("#responseBusiness").html(response);
            } 
        }
    });
  }
}

function isEmpty(caller) {
    if (caller.val() == "") {
        caller.css("border", "1px solid red");
        return false;
    } else {
        caller.css("border", "1px solid green ");
    }
    return true;
}


function decodeHtmlEntities(str) {
    return String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
}
// function htmlEntities(str) {
//     return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
// }


