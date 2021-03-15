$(document).ready(function () {

    $(document).on('click', '.emailSent', function (e) {
        e.stopPropagation();
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/unemployment_Emailmessage',
            method: 'POST',
            dataType: 'text',
            data: {
                user_id: user_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".user-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('keyup', '.searchUnemployment', function () {
        if ($(this).val() != "") {
            $('.job-hide').hide();
        } else {
            $('.job-hide').show();
        }
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/unemployment_Emailmessage',
            method: 'POST',
            dataType: 'text',
            data: {
                search: searching,
            }, success: function (response) {
                $(".job-show").html(response);
                // console.log(response);
            }
        });
    });

    $(document).on('keyup', '.searchemployment', function () {
        if ($(this).val() != "") {
            $('.job-hide').hide();
        } else {
            $('.job-hide').show();
        }
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/unemployment_Emailmessage',
            method: 'POST',
            dataType: 'text',
            data: {
                searchProfess: searching,
            }, success: function (response) {
                $(".job-show").html(response);
                // console.log(response);
            }
        });
    });

    $(document).on('click', '#unemployment', function () {
        var user_id = $(this).data('user');
        $.ajax({
            url: 'core/ajax_db/unemployment_profile',
            method: 'POST',
            dataType: 'text',
            data: {
                user_id: user_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".user-popup").hide();
                });
                // console.log(response);
            }
        });
    });

     // THIS IS FOR UNEMPLOYMENT & PROFESSIONAL
    // THIS IS FOR UNEMPLOYMENT & PROFESSIONAL

    $(document).on('click', '#addposts_career', function (e) {
        for(instance in CKEDITOR.instances){
            CKEDITOR.instances[instance].updateElement();
        }
        e.preventDefault();
        var user_id1 = $("#user_id1");
        var Career = $("#Career");
        var years = $("#years");
        var field = $("#field");
        var diploma = $("#diploma");
        var age = $("#age");
        var status = $("#status");
        var phone = $("#phone");
        var course = $("#course");
        var editor1 = CKEDITOR.instances.editor1.getData();
        // if (isEmpty(categories_jobs) && isEmpty(job_title) && isEmpty(job_summary) && isEmpty(responsibilities_duties) && isEmpty(qualifications_skills) &&
        //     isEmpty(conditions) && isEmpty(deadline)) {
        if (isEmpty(Career) && isEmpty(years) && isEmpty(field) && isEmpty(diploma) && 
            isEmpty(age) && isEmpty(status) && isEmpty(phone) && isEmpty(course)) {

            $.ajax({
                url: 'core/ajax_db/unemployment_profile',
                type: 'post',
                dataType: 'text',
                // data: form,
                data:  {
                    key: 'Unemployment',
                    user_id1: user_id1.val(),
                    Career: Career.val(),
                    years: years.val(),
                    field: field.val(),
                    diploma: diploma.val(),
                    age: age.val(),
                    status: status.val(),
                    phone: phone.val(),
                    course: course.val(),
                    editor1: editor1,

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



function unemploymentEdits(user_id) {
    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    $.ajax({
        url: 'core/ajax_db/unemployment_profile',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'edit',
            rowID: user_id
        }, success: function (response) {
                $(".edit-body").fadeIn();
                $("#Career").val(response.career);
                $("#years").val(response.years);
                $("#field").val(response.field);
                $("#diploma").val(response.diploma);
                $("#age").val(response.age);
                $("#status").val(response.status);
                $("#phone").val(response.phone);
                $("#course").val(response.course);
                CKEDITOR.instances.editor1.setData(response.about,function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.editor1.updateElement();

                $("#addposts_career").attr('value', 'update').attr('onclick', "ajax_requestsPostsUnemploy('update')").attr('id', 'n').fadeIn();
                
                $(".modal-title").html(response.username);
                $("#addPostjobs").modal('show');
        }
    });
}


function ajax_requestsPostsUnemploy(key) {
    for(instance in CKEDITOR.instances){
        CKEDITOR.instances[instance].updateElement();
    }
    var user_id1 = $("#user_id1");
    var Career = $("#Career");
    var years = $("#years");
    var field = $("#field");
    var diploma = $("#diploma");
    var age = $("#age");
    var status = $("#status");
    var phone = $("#phone");
    var course = $("#course");
    var editor1 = CKEDITOR.instances.editor1.getData();
    // if (isEmpty(categories_jobs) && isEmpty(job_title) && isEmpty(job_summary) && isEmpty(responsibilities_duties) && isEmpty(qualifications_skills) &&
    //     isEmpty(conditions) && isEmpty(deadline)) {
    if (isEmpty(Career) && isEmpty(years) && isEmpty(field) && isEmpty(diploma) && 
        isEmpty(age) && isEmpty(status) && isEmpty(phone) && isEmpty(course)) {

        $.ajax({
            url: 'core/ajax_db/unemployment_profile',
            type: 'post',
            dataType: 'text',
            // data: form,
            data:  {
                key: 'Unemployment',
                user_id1: user_id1.val(),
                Career: Career.val(),
                years: years.val(),
                field: field.val(),
                diploma: diploma.val(),
                age: age.val(),
                status: status.val(),
                phone: phone.val(),
                course: course.val(),
                editor1: editor1,

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
                }else{
                     Career.val("");
                     years.val("");
                     field.val("");
                     diploma.val("");
                     age.val("");
                     status.val("");
                     phone.val("");
                     course.val('');
                }
            }
        });
    }
}
