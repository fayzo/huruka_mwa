$(document).ready(function () {
    $("#myModalComposermessage").on('click', function () {
        $("#myModalComposer").modal('show');
        CKEDITOR.replace('editor2')
    });

    $(document).on('click', '#email-dropdown-menu', function () {
        var email_notificationDrpdown = 1;

        $.ajax({
            url: 'core/ajax_db/email_notification.php',
            method: 'POST',
            dataType: 'text',
            data: {
                email_notificationDrpdown: email_notificationDrpdown,
            }, success: function (response) {
                $("#email-menu-view").html(response);
                $("#email1").hide();
                console.log(response);
            }
        });
    });


    $(document).on('click', '.email-composer-new1', function (e) {
        for(instance in CKEDITOR.instances){
            CKEDITOR.instances[instance].updateElement();
        }
        // event.preventDefault();
        e.stopPropagation();
        var user_id = $('#user_id');
        var emailcomposer = $('.emailcomposer');
        var subjectcomposer = $('.subjectcomposer');
        // var textcomposer = $('.textcomposer');
        var editor2 = CKEDITOR.instances.editor2.getData();
         
        if (isEmpty(emailcomposer) && isEmpty(subjectcomposer) ) {
            var filecomposer = $('#filecomposer').val();
            var textarea = $('.textcomposer').val();

            if (textarea != '' && filecomposer == '') {

                    $.ajax({
                        url: "core/ajax_db/email_notification",
                        method: "POST",
                        data: {
                            key: 'textarea',
                            user_id: user_id.val(),
                            emailcomposer :emailcomposer.val(),
                            subjectcomposer: subjectcomposer.val(),
                            textcomposer: editor2,
                        },
                        success: function (response) {
                            $("#responseSubmit").html(response).fadeIn();
                            setInterval(function () {
                                $("#responseSubmit").fadeOut();
                            }, 2000);
                            setInterval(function () {
                                location.reload();
                            }, 2400);
                        }, error: function (response) {
                            $("#responseSubmit").html(response).fadeIn();
                            setInterval(function () {
                                $("#responseSubmit").fadeOut();
                            }, 3000);
                        }
                    });
            }else {

            var extensions3 = $('#filecomposer').val().split('.').pop().toLowerCase();

            if (jQuery.inArray(extensions3, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmit").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmit").fadeOut();
                }, 4000);
                $('#filecomposer').val('');
                return false;
            } else if ($('#sendx').attr("value") == "send") {
                //do button 1 thing
                var FormDatas = $('#email-composer-new');
                // var inbox = 'inbox';
                // '&' + $.param({'send':'inbox'});  
                var param =$('<input type="hidden" name="send">').val('inbox');
                FormDatas.append(param);
                // new FormData(this),
                
                $.ajax({
                    url: 'core/ajax_db/email_notification',
                    method: "POST",
                    data: FormDatas.serializefiles(),
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            var progress = Math.round((e.loaded / e.total) * 100);
                            $('.progress-hidex').show();
                            $('.progress-hidec').show();
                            $('.progress-hidez').show();
                            $('#prox').css('width', progress + '%');
                            $('#proc').css('width', progress + '%');
                            $('#proz').css('width', progress + '%');
                            $('#prox').html(progress + '%');
                            $('#proc').html(progress + '%');
                            $('#proz').html(progress + '%');
                        });

                        xhr.addEventListener('load', function (e) {
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                        return xhr;
                    },
                    success: function (response) {
                        $("#responseSubmit").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmit").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                        console.log(response);
                    }, error: function (response) {
                        $("#responseSubmit").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmit").fadeOut();
                        }, 3000);
                    }
                });
                return false;
            }
            }
        }
    });

    $(document).on('keyup', '.search-email-composerxxxx__', function () {
        // $('.message-recent').hide();
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/email_notification.php',
            method: 'POST',
            dataType: 'text',
            data: {
                search: searching,
            }, success: function (response) {
                var json = JSON.parse(response);
                $(".emailsendto").html(json.form);
                var myObj = json.email;
                var myDiv = document.getElementById("myDiv-search-email-composer");
                //Create and append select list
                var selectList = document.createElement("select");
                selectList.id = "emialTo";
                selectList.name = "emialTo";
                selectList.className = "custom-select d-block w-100 emialTo";
                myDiv.appendChild(selectList);

                var ordered = {};
                Object.keys(myObj).sort().forEach(function (key) {
                    ordered[key] = myObj[key];
                });
                // var ordered =Object.keys(myObj);
                // ordered.sort().forEach(function(key) {
                //     ordered[key] = myObj[key];
                // });

                for (var x in ordered) {
                    var option = document.createElement("option");
                    option.value = ordered[x];
                    option.text = x;
                    selectList.appendChild(option);
                }

                $(".emialTo").click(function () {
                    $('.search-email-composer').val($('option').val());
                    $("#myDiv-search-email-composer").hide();
                });
                // $(".search-email-composer").val(json.email);
                console.log(response);
            }
        });
    });

});
