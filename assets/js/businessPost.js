
$(document).ready(function () {
    $("#addPostsjobs").on('click', function () {
        CKEDITOR.replace('editor1')
        $("#addPostjobs").modal('show');
        $(".view-body").fadeOut();
        // $("#posts").attr('value', 'save').attr('onclick', "ajax_requestsPosts('create')").fadeIn();
    });

    $("#Postjobs").on('hidden.bs.modal', function () {
        $(".edit-body").fadeIn();
        $("#id_posts").val(0);
        $("#businessID_posts").val();
        $(".job-title").val("");
        $(".job-summary").val("");
        $(".responsibilities-duties").val("");
        $(".qualifications-skills").val("");
        $(".terms-conditions").val("");
        $("#categories_jobs").val("");
        $(".deadline").val("");
        $(".website").val("");
    });
    
    jobspostsFetch(0, 50);
    jobspostsFetchOn(0, 50);

    $(document).on('click', '#addposts', function (e) {

        for(instance in CKEDITOR.instances){
            CKEDITOR.instances[instance].updateElement();
        }
        e.preventDefault();
        // e.stopPropagation();
        // var form =$('#form1').serialize();
        var id = $("#id_posts1");
        var businessID = $("#businessID_posts1");
        var job_title = $(".job-title1");
        var job_summary = CKEDITOR.instances.editor1.getData();
        var website = $(".website1");
        var deadline = $(".deadline1");
        var categories_jobs = $("#categories_jobs1");
        $("#editor1").fadeOut();

        if (isEmpty(categories_jobs) && isEmpty(job_title) && isEmpty(deadline)) {

            $.ajax({
                url: 'core/ajax_db/businessPosts_db',
                type: 'post',
                dataType: 'text',
                // data: form,
                data:  {
                    key: 'create',
                    job_title: job_title.val(),
                    job_summary: job_summary,
                    // responsibilities_duties: responsibilities_duties.val(),
                    // qualifications_skills: qualifications_skills.val(),
                    // conditions: conditions.val(),
                    deadline: deadline.val(),
                    website: website.val(),
                    rowID: id.val(),
                    categories_jobs: categories_jobs.val(),
                    businessID: businessID.val(),

                },
                beforeSubmit: function(){
                    for(instance in CKEDITOR.instances){
                        CKEDITOR.instances[instance].updateElement();
                    }
                },
                success: function (response) {
                    if (response != "success") {
                        // alert(response);
                        $("#responseBusinessJobs1").html(response);
                    }
                    // console.log(response);
                }
            });
        }
    });

   
});



function PostsEdits(rowID, businessID, type) {
    CKEDITOR.replace('editor4')
    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    $.ajax({
        url: 'core/ajax_db/businessPosts_db',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'edit',
            rowID: rowID,
            businessID: businessID,
        }, success: function (response) {
            if (type == "view") {
                $(".edit-body").fadeOut();
                $(".view-body").fadeIn();
                $("#id_posts0").val(rowID);
                $("#businessID_id0").val(businessID);
                $(".job-title0").html(response.job_title);
                $(".job-summary0").html(response.job_summary);
                $(".categories_jobs0").html(response.categories_jobs);
                $(".deadlin0e").html(response.deadline);
                $(".website0").html(response.website);
                $("#posts").fadeOut();

            }else {
                $(".edit-body").fadeIn();
                $(".view-body").fadeOut();
                $("#id_posts").val(rowID);
                $("#businessID_posts").val(businessID);
                $(".job-title").val(response.job_title);
                // $(".job-summary").val(response.job_summary);
                CKEDITOR.instances.editor4.setData(response.job_summary,function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.editor4.updateElement();

                $(".categories_jobsx").html(response.categories_jobs);
                $(".deadline").val(response.deadline);
                $(".website").val(response.website);
                $("#posts").attr('value', 'update').attr('onclick', "ajax_requestsPosts('update')").fadeIn();
            }
            $(".modal-title").html(response.job_title);
            $("#Postjobs").modal('show');
        }
    });
}

function ajax_requestsPosts(key) {
    CKEDITOR.replace('editor4')
    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    var id = $("#id_posts");
    var job_title= $(".job-title");
    var job_summary= $(".job-summary");
    var businessID = $("#businessID_posts");
    var job_title=  $(".job-title");
    var job_summary=  $(".job-summary");
    var deadline= $(".deadline");
    var website = $(".website");
    var categories_jobs = $("#categories_jobs");
    var editor4 = CKEDITOR.instances.editor4.getData();

    if (isEmpty(categories_jobs) && isEmpty(job_title) && isEmpty(job_summary) &&
        isEmpty(conditions) && isEmpty(deadline)) {

        $.ajax({
            url: 'core/ajax_db/businessPosts_db',
            type: 'post',
            dataType: 'text',
            data: {
                key: key,
                job_title: job_title.val(),
                deadline: deadline.val(),
                website: website.val(),
                rowID: id.val(),
                categories_jobs: categories_jobs.val(),
                businessID: businessID.val(),
                editor2: editor4,

            }, 
            beforeSubmit: function(){
                for(instance in CKEDITOR.instances){
                    CKEDITOR.instances[instance].updateElement();
                }
            },
            success: function (response) {
                if (response != "success") {
                    // alert(response);
                    $("#responseBusinessJobs").html(response);
                }else{
                     job_title.val("");
                     job_summary.val("");
                     deadline.val('');
                     website.val("");
                    categories_jobs.val("");

                }
            }
        });
    }
}

function jobspostsFetch(begin_nmber,end_nmber) {

    $.ajax({
        url: 'core/ajax_db/businessPosts_db',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'jobspostsFetch',
            begin_nmber: begin_nmber,
            end_nmber: end_nmber,
        }, success: function (response) {
            if (response != "Max") {
                $('#tbody-jobsFetch').append(response);
                begin_nmber += end_nmber;
            } else
                $(".table-jobsFetch").DataTable();
        }
    });
}

function jobspostsFetchOn(begin_nmber,end_nmber) {

    $.ajax({
        url: 'core/ajax_db/businessPosts_db',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'jobspostsFetchOn',
            begin_nmber: begin_nmber,
            end_nmber: end_nmber,
        }, success: function (response) {
            if (response != "Max") {
                $('#tbody-jobsFetchOn').append(response);
                begin_nmber += end_nmber;
            } else
                $(".table-jobsFetchOn").DataTable();
        }
    });
}

function jobsdeleteRow(rowID) {
          if (confirm('Are you sure??')) {
              $.ajax({
                  url: 'core/ajax_db/businessPosts_db',
                  method: 'POST',
                  dataType: 'text',
                  data: {
                      key: 'delete',
                      rowID: rowID
                  }, success: function (response) {
                      $("#title"+rowID).parent().remove();
                      jobspostsFetch(0, 50);
                      alert(response);
                  }
         });
     }
 }

function shows(rowID,turnOnOff) {
         if (confirm('Are you sure??')) {
             $.ajax({
                 url: 'core/ajax_db/businessPosts_db',
                 method: 'POST',
                 dataType: 'text',
                 data: {
                     key: turnOnOff,
                     rowID: rowID
                 }, success: function (response) {
                     $("#title"+rowID).parent().remove();
                     alert(response);
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