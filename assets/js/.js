$(document).ready(function () {

    var url = location.href.replace(/[^/]*$/,'');
    var path = window.location.href;
	var pathname = window.location.pathname;
    // var filename =pathname.lastIndexOf('/') + 1;
    var filename = pathname.split('/').pop();
    // Account for home page with empty path
    if (path == '' ) {
        path = path;
    }
    // var target = $('nav > ul > li a[href="'+path+'"]');
    // var targetValue = $('nav > ul > li a:first').attr('href');
    var targetValue = 'promote_ads';
	// Add active class to target link
    
	// if (path == url+targetValue) {
    //     CKEDITOR.replace('editor1')
    //     console.log(targetValue,path,pathname,filename,url);
	// }
    
    $(document).on('click', '.promote_forms', function () {

        $.ajax({
            url: 'core/ajax_db/message_promote_forms',
            method: 'POST',
            dataType: 'text',
            data: {
            }, success: function (response) {
                $(".popupTweet").html(response);
                CKEDITOR.replace('editor1') // THIS IS FOR MESSAGE
                $(".closeTweetPopup").click(function () {
                    $(".popup-tweet-wrap").hide();
                });

                // console.log(response);
            }
        });
    });


    $(document).on('submit', "#promoteForm", function (e) {
        
        for(instance in CKEDITOR.instances){
            CKEDITOR.instances[instance].updateElement();
        }
        e.preventDefault();
        var id = $('#id_posts').val();
        var image_name = $('#file').val();
        var title_name = $('#title_name').val();
        var donation_payment = $('#donation_payment').val();
        var money_to_target = $('#money_to_target').val();
        var youtube = $('#youtube').val();
        // var textarea = $('.status').val();
        var textarea = CKEDITOR.instances.editor1.getData();

         if (image_name == '') {

            if (textarea != '') {
                $.ajax({
                    url: "core/ajax_db/message_promote_post",
                    method: "POST",
                    data: {
                        key: 'textarea',
                        id: id,
                        status: textarea,
                        title_name: title_name,
                        donation_payment: donation_payment,
                        money_to_target: money_to_target,
                        youtube: youtube,
                    },
                    success: function (response) {
                        $("#response-posts").html(response);
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 800);
                        setInterval(function () {
                             location.reload();
                        }, 1100);
                    }, error: function (response) {
                        $("#response-posts").html(response);
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        },2000);
                    }
                });

            } else {
                $("#empty-posts").html('Type or choose image to post').fadeIn();
                setInterval(function () {
                    $("#empty-posts").fadeOut();
                }, 6000);
            }
        } else {
            var extensions = $('#file').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extensions, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {

                $("#response-posts").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#response-posts").fadeOut();
                }, 3000);
                $('#file').val('');
                return false;
            } else {
                $.ajax({
                    url: "core/ajax_db/message_promote_post",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            var progress = Math.round((e.loaded / e.total) * 100);
                            $('.progress-hided').show();
                            $('#prog').css('width', progress + '%');
                            $('#prog').html(progress + '%');
                        });
                        xhr.addEventListener('load', function (e) {
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                        return xhr;
                    },
                    success: function (response) {
                        $("#response-posts").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 1000);
                        setInterval(function () {
                            location.reload();
                        }, 1100);
                    }, error: function (response) {
                        $("#response-posts").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 2000);
                    }
                });
                return false;
            }
        }
    });//#popupForm End form submitted 
});
 
