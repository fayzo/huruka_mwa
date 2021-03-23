$(document).ready(function() {

    // $(document).on('click', '#send', function (event) {

    // $('#messageForm').submit(function (event) {
    $(document).on('click', "#send", function (event) {

        event.preventDefault();
        $('.progress').removeClass().addClass('progress-xss');
        var formdatas = $('#messageForm');
        var message= $('#msg').val();
        var get_id= $(this).data('user');
        var image_name = $('#msg-upload').val();

        if (image_name == '') {
        
            if (message != '') {

                    $.ajax({
                        url: 'core/ajax_db/messages',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            sendMessage: message,
                            get_idd: get_id,
                        }, 
                        success: function (response) {
                            getmessages();
                            $("#msg").val('');
                            // console.log(response);
                        }
                    });
                    
                }else{
                    $("#User_response-posts").html('Type or choose image to post').fadeIn();
                    setInterval(function() {
                        $("#User_response-posts").fadeOut();
                        }, 6000);
                }

            }else {

                var extensions = $('#msg-upload').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extensions, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                    $("#User_response-posts").html('Invalid Image File').fadeIn();
                    setInterval(function () {
                        $("#User_response-posts").fadeOut();
                    }, 4000);
                    $('#msg-upload').val('');
                    return false;

                }else{

                    $.ajax({
                        url: "core/ajax_db/postUsermessage",
                        method: "POST",
                        // data: new FormData(this),
                        data: formdatas.serializefiles(),
                        contentType: false,
                        processData: false,
                        xhr: function(){
                            var xhr = new XMLHttpRequest();
                            xhr.upload.addEventListener('progress',function(e){
                                var progress= Math.round((e.loaded/e.total)*100);
                                $('.progress-hide').show();
                                $('#pro').css('width',progress +'%');
                                $('#pro').html(progress +'%');
                            });
    
                            xhr.addEventListener('load', function (e) { 
                                $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                            });
                              return xhr;
                        },
                        success: function (response) {
                            $("#msg").val('');
                            $('#msg-upload').val('');

                            $("#User_response-posts").html(response).fadeIn();
                            setInterval(function () {
                                $("#User_response-posts").fadeOut();
                            }, 1000);
                            setInterval(function () {
                                // location.reload();
                            }, 2400);
                        }, error: function (response) {
                            $("#User_response-posts").html(response).fadeIn();
                            setInterval(function () {
                                $("#User_response-posts").fadeOut();
                            }, 3000);
                       }
                    });
                    // return false;
                }
                console.log(image_name);
            }

    });
});
