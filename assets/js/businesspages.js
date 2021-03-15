$(document).on('click','.viewBusiness',function () { 
    var rowID= $("#business_id0").data('business');

     $.ajax({
        url: 'core/ajax_db/businesspages_db',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'businessviewORedit',
            rowID: rowID
        }, success: function (response) {
                $(".The-company-name0").html(decodeHtmlEntities(response.companyname));
                $(".The-company-overview0").html(decodeHtmlEntities(response.overview));
                $(".company-history0").html(decodeHtmlEntities(response.history));
                $(".management-team0").html(decodeHtmlEntities(response.team));
                $(".legal-structure0").html(decodeHtmlEntities(response.legal_structure));
                $(".location-place0").html(decodeHtmlEntities(response.location_facilities));
                $(".mission-statement0").html(decodeHtmlEntities(response.mission_statement));
                $(".website0").html(response.website);
        }
    });
});

function BusinessEdits(rowID, type) {

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
                $("#The-company-overview").val(response.overview);
                $("#company-history").val(response.history);
                $("#management-team").val(response.team);
                $("#legal-structure").val(response.legal_structure);
                $("#location-place").val(response.location_facilities);
                $("#mission-statement").val(response.mission_statement);
                $("#website").val(response.website);

                $("#Businesspages").attr('value', 'update').attr('onclick', "ajax_requestsBusiness('update_Row')").show();
                $(".modal-title").html(response.companyname);
                $("#editPages").modal('show');
        }
    });
}

function ajax_requestsBusiness(key) {
    var id = $("#id_business");
    var companyname = $("#The-company-name");
    var overview = $("#The-company-overview");
    var history = $("#company-history");
    var team = $("#management-team");
    var legal_structure = $("#legal-structure");
    var location = $("#location-place");
    var mission_statement = $("#mission-statement");
    var website = $("#website");

    if (isEmpty(companyname) && isEmpty(overview) && isEmpty(history) && isEmpty(team) && isEmpty(legal_structure) && 
        isEmpty(location) && isEmpty(mission_statement)) {
        
    $.ajax({
        url: 'core/ajax_db/businesspages_db.php',
        type: 'post',
        dataType: 'text',
        data: {
            key: key,
            companyname: companyname.val(),
            overview: overview.val(),
            history: history.val(),
            team: team.val(),
            legal_structure: legal_structure.val(),
            location: location.val(),
            mission_statement: mission_statement.val(),
            website: website.val(),
            rowID: id.val()

        }, success: function (response) {
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


