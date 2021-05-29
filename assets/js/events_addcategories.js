$(document).ready(function () {

    $(document).on('click', '#events-readmore', function (e) {
        e.stopPropagation();
        var events_id = $(this).data('events');

        $.ajax({
            url: 'core/ajax_db/events_readmore',
            method: 'POST',
            dataType: 'text',
            data: {
                events_id: events_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".events-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '#add_events', function (e) {
        $('.progress-hidex').hide();
        $('.progress-hidec').hide();
        $('.progress-hidez').hide();
        e.stopPropagation();
        var events_view = $(this).data('events');

        $.ajax({
            url: 'core/ajax_db/events_addcategories',
            method: 'POST',
            dataType: 'text',
            data: {
                events_view: events_view,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".events-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '#submit-form-events', function (e) {
        e.stopPropagation();
        var formdatas = $('#form-events');
        var title = $('#title');
        var country = $('#country');
        var location = $('#Location');
        var event_start = $('#event-start');
        var event_start_time = $('#event-start-time');
        var event_end_date = $('#event-end-date');
        var event_end_time = $('#event-end-time');
        
        var categories_events = $('#categories_events');
        var additioninformation = $('#addition-information');
        var photo = $('#photo');

        // var districts = $('.districtcode');
        // var sector = $('.sectorcode');
        // var cell = $('.codecell');
        // var village = $('.CodeVillage');
        // var video = $('#video');
        // var youtube = $('#youtube');
        
        if (isEmpty(title) && isEmpty(country) && isEmpty(location) &&
            isEmpty(event_start) && isEmpty(event_start_time) && 
            isEmpty(event_end_date) && isEmpty(event_end_time) &&
            isEmpty(categories_events) && isEmpty(additioninformation) && 
            isEmpty(photo) ) {
            
            var extensions1 = $('#photo').val().split('.').pop().toLowerCase();
            
            if (jQuery.inArray(extensions1, ['gif', 'png', 'jpg','jpeg']) == -1) {
                $("#responseSubmitevents").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmitevents").fadeOut();
                }, 4000);
                $('#photo').val('');
                return false;
          
            } else {
                $.ajax({
                    url: 'core/ajax_db/events_addcategories',
                    method: "POST",
                    // data: new FormData(this),
                    data: formdatas.serializefiles(),
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
                        $("#responseSubmitevents").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitevents").fadeOut();
                        }, 1000);
                        // setInterval(function () {
                        //     location.reload();
                        // }, 2400);
                        
                        setTimeout(() => {
                            $(".popupTweet").hide();
                            $("#checkOUT").modal('show').css({"z-index":"20000"});;
                            $("#checkOUT").delay(2000).fadeOut(450);
                        }, 1500);
                        setTimeout(() => {
                            $("#checkOUT").modal('hide');
                        }, 3500);
                        setTimeout(() => {
                            location.reload();
                        }, 4000);

                    }, error: function (response) {
                        $("#responseSubmitevents").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitevents").fadeOut();
                        }, 3000);
                    }
                });
                return false;
            }
        }
    });

    $(document).on('click', '.imageeventsViewPopup', function (e) {
        e.stopPropagation();
        var events_id = $(this).data('events');
        $.ajax({
            url: 'core/ajax_db/eventsraisingImageViewPopup',
            method: 'POST',
            dataType: 'text',
            data: {
                showpimage: events_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".img-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.events-retweet0', function () {
        $events_id = $(this).data('events');
        $tweet_events_by = $(this).data('user');
        $counter = $(this).find('.retweetcounter');
        $count = $counter.text();
        $button = $(this);

        $.ajax({
            url: 'core/ajax_db/events_share',
            method: 'POST',
            dataType: 'text',
            data: {
                showpopretweet_events_id: $events_id,
                tweet_events_By: $tweet_events_by,
            }, success: function (response) {
                $('.popupTweet').html(response);
                $('.close-retweet-popup').click(function () {
                    $('.events-share-popup').hide();
                });

                // console.log(response);
            }
        });
    });

    $(document).on('click', '.events-retweet-it', function () {
        $comment = $('.retweetMsg').val();

        $.ajax({
            url: 'core/ajax_db/events_share',
            method: 'POST',
            dataType: 'text',
            data: {
                retweet: $events_id,
                tweet_By: $tweet_events_by,
                comments: $comment
            }, success: function (response) {
                $('.events-share-popup').hide();
                $count++;
                $counter.text($count++);
                $button.removeClass('.events-retweet0').addClass('.events-retweeted0');

                // console.log(response);
            }
        });
    });
});

function isEmpty(caller) {
    if (caller.val() == "") {
        caller.css("outline", "1px solid red");
        return false;
    } else {
        caller.css("outline", "1px solid green ");
    }
    return true;
}

function isEmptys(caller) {
    if (caller.val() != "") {
        caller.css("outline", "1px solid red");
        return false;
    }
    return true;
}
