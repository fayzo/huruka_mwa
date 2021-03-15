   
   $(document).ready(function() {
            $("#admin").on('click', function () {
               $("#manage_admin_form").modal('show');
               $(".user_form").fadeIn();
               $("#profile_image_ADMIN").fadeOut();
               $("#button_admin").attr('value', "save").attr('onclick', "ajax_requests('add_admin')").fadeOut();
            });

            $("#manage_admin_form").on('hidden.bs.modal', function () {
               $("#editContent_admin").fadeIn();
               $("#showContent_admin").fadeOut();
               $("#profile_image_ADMIN").fadeOut();
               $("#admin_editRowID").val(0);
               $("#firstname").val("");
               $("#lastname").val("");
               $("#username").val("");
               $("#password").val("");
               $("#email").val("");
            //    $("#address").val("");
            //    $("#address2").val("");
               $("#country").val("");
               $("#state").val("");
               $("#closeBtn1").fadeIn();
               $("#button_admin").attr('value', 'Save').attr('onclick', "ajax_requests('add_admin')").fadeOut();
            });

            fetch_admin(0, 50);
            fetch_admin1(0, 50);
            $(".table_adminLA").DataTable({
                "lengthChange": true,
                "pageLength":10,
                "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
            });
        });

        function deleteRow(rowID) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: 'core/ajax_db/manage_admin_db',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRow',
                        rowID: rowID
                    }, success: function (response) {
                        $("#firstname"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewORedits(rowID, type) {
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'viewORedit',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#showContent_admin").fadeIn();
                        $("#editContent_admin").fadeOut();
                        $("#profile_image_ADMIN").fadeOut();
                        $(".user_form").fadeOut();
                        $("#firstnameView").html(response.firstname);
                        $("#lastnameView").html(response.lastname);
                        $("#usernameView").html(response.username);
                        $("#passwordView").html(response.password);
                        $("#emailViewz").html(response.email);
                        // $("#addressViewz").html(response.address);
                        // $("#address2View").html(response.address2);
                        $("#countryViewz").html(response.country);
                        // $("#stateViewz").html(response.state);
                        $("#button_admin").fadeOut();
                        $("#closeBtn1").fadeIn();
                    } else {
                        $("#editContent_admin").fadeIn();
                        $("#showContent_admin").fadeOut();
                        $("#profile_image_ADMIN").fadeOut();
                        $(".user_form").fadeOut();
                        $(".image").fadeOut();
                        $("#admin_editRowID").val(rowID);
                        $("#firstname").val(response.firstname);
                        $("#lastname").val(response.lastname);
                        $("#username").val(response.username);
                        $("#password").val(response.password);
                        $("#emailz").val(response.email);
                        // $("#addressz").val(response.address);
                        // $("#address2").val(response.address2);
                        $("#countryz").val(response.country);
                        // $("#statez").val(response.state);
                        $("#button_admin").attr('value', 'update').attr('onclick', "ajax_requests('update_Row')").fadeIn();
                        $("#closeBtn1").fadeIn();
                    }
                    $(".modal-title").html(response.firstname);
                    $("#manage_admin_form").modal('show');
                }
            });
        }

        function fetch_admin(start, limit) {
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'fetch_admin',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response != "Max") {
                        $('#tbody_admin').append(response);
                        start += limit;
                    //    fetch_admin(start, limit);
                    } else{
                        $(".table_admin").DataTable({
                            "lengthChange": true,
                            "pageLength":10,
                            "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
                        });
                     }
                }
            });
        }

        function fetch_admin1(start, limit) {
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'fetch_admin1',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response != "Max") {
                        $('#tbody_admin1').append(response);
                        start += limit;
                    //    fetch_admin(start, limit);
                    } else{
                        $(".table_admin1").DataTable({
                            "lengthChange": true,
                            "pageLength":10,
                         "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
                       });
                    }
                }
            });
        }

         function approved(rowID,approval) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/manage_admin_db',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: approval,
                        rowID: rowID
                    }, success: function (response) {
                        $("#title"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function ajax_requests(key) {
            var editRowID = $("#admin_editRowID");
            var firstname = $("#firstname");
            var lastname = $("#lastname");
            var username = $("#username");
            var password = $("#password");
            var email = $("#emailz");
            // var address = $("#addressz");
            // var address2 = $("#address2");
            var country = $("#countryz");
            var state = $("#statez");

                $.ajax({
                   url: 'core/ajax_db/manage_admin_db',
                   type: 'post',
                   dataType: 'text',
                   data: {
                       key: key,
                       firstname: firstname.val(),
                       lastname: lastname.val(),
                       username: username.val(),
                       password: password.val(),
                       email: email.val(),
                       country: country.val(),
                       state: state.val(),
                       rowID: editRowID.val()
                   }, success: function (response) {
                       if (response != "success"){
                           alert(response);
                      } else {
                           $("#firstname"+editRowID.val()).html(firstname.val());
                           $("#lastname"+editRowID.val()).html(lastname.val());
                           $("#username"+editRowID.val()).html(username.val());
                           $("#password"+editRowID.val()).html(password.val());
                           $("#email"+editRowID.val()).html(email.val());
                        //    $("#address"+editRowID.val()).html(address.val());
                        //    $("#address2"+editRowID.val()).html(address2.val());
                           $("#country"+editRowID.val()).html(country.val());
                           $("#state"+editRowID.val()).html(state.val());
                            firstname.val('');
                            lastname.val('');
                            username.val('');
                            password.val('');
                            email.val('');
                            // address.val('');
                            // address2.val('');
                            country.val('');
                            state.val('');
                           $("#manage_admin_form").modal('hide');
                           $("#button_admin").attr('value', 'Save').attr('onclick',"ajax_requests('add_admin')");
                       }
                   }
                });
            }
         
$(document).ready(function () {
    $("#users_form").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: 'core/ajax_db/adduser_upload',
            dataType: 'text',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (response) {
                //  $(".user_form").fadeOut
                //  $("#save").fadeOut();
                console.log(response);
            },
            success: function (response) {
                alert(response);
                console.log(response);
                //  $("#table_form").modal('hide').fadeOut();
            },
            error: function (response) {
                $("#err").html(response).fadeIn();
            }

        });
    }));
});
         
//  START OF UPLOAD IMAGE CONTENT 

$(document).ready(function () {
    //If image edit link is clicked
    $(".editLink").on('click', function (e) {
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });
    //On select file to upload
    $("#fileInput").on('change', function () {
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        } else {
            $('.uploadProcess').show();
            $('#uploadForm').hide();
            $("#picUploadForm").submit();
        }
    });
    $(".editLinks").on('click', function (e) {
        e.preventDefault();
        $("#cover_fileInput:hidden").trigger('click');
    });

    $("#cover_fileInput").on('change', function () {
        var cover_image = $('#cover_fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(cover_image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#cover_fileInput').val('');
            return false;
        } else {
            $('.cover_uploadProcess').show();
            $('#cover_uploadForm').hide();
            $("#cover_picUploadForm").submit();
        }
    });
});

// After completion of image upload process
function completeUpload(success, fileName) {
    if (success == $('#edit_profile').val()) {
        $('#imagePreview').attr("src", "");
        $('#imagePreview').attr("src", fileName);
        $('#fileInput').attr("value", fileName);
        $('.uploadProcess').hide();
        console.log(success);
        console.log(fileName);

    } else {
        $('.uploadProcess').hide();
        alert('There was an error during file upload!');
    }
    return true;
}

function cover_completeUpload(success, cover_Name) {
    if (success == $('#edit_profile').val()) {
        $('#cover_imagePreview').attr("src", "");
        $('#cover_imagePreview').attr("src", cover_Name);
        $('#cover_fileInput').attr("value", cover_Name);
        $('.cover_uploadProcess').hide();
        console.log(success);
        console.log(cover_Name);

    } else {
        $('.cover_uploadProcess').hide();
        alert('There was an error during file upload!');
    }
    return true;
}

$(document).on('click', '.update_profile_id', function () {
    $('#edit_profile').val($(this).attr("id"));
    $('#edit_cover').val($(this).attr("id"));
    var t = $(this).attr("id");
    console.log(t);
    $.ajax({
        url: 'core/ajax_db/manage_admin_db',
        type: 'post',
        dataType: 'json',
        data: {
            key: 'image',
            id: t
        },
        success: function (response) {
            $('#nameView4').html(response.username);
            var userPicture = (response.profile_image) ? 'assets/image/users_profile_cover/' + response.profile_image
                : 'assets/image/image_default/defaultprofileimage.png';
            var userPictureURL = userPicture;
            $('.imagePreview').attr('src', userPictureURL);
            $('#cover_nameView4').html(response.username);
            var cover_userPicture = (response.cover_image) ? 'assets/image/users_cover_profile/' + response.cover_image
                : 'assets/image/image_default/defaultCoverImage.png';
            var cover_userPictureURL = cover_userPicture;
            $('.cover_imagePreview').attr('src', cover_userPictureURL);
            $(".modal-title").html(response.username);
            $("#manage_admin_form").modal('show');
            $("#profile_image_ADMIN").fadeIn();
            $("#showContent_admin").fadeOut();
            $("#editContent_admin").fadeOut();
            $("#closeBtn").fadeIn();
            $("#button_admin").fadeOut();
            console.log(response);
            console.log(userPictureURL);
            console.log(cover_userPictureURL);
        }
    });
});
        

        