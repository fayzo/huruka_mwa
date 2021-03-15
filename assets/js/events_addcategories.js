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

    $(document).on('click', '#form-events', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var country = $('#country');
        var province = $('.provincecode');
        var districts = $('.districtcode');
        var sector = $('.sectorcode');
        var cell = $('.codecell');
        var village = $('.CodeVillage');

        var additioninformation = $('#addition-information');
        var photo = $('#photo');
        var video = $('#video');
        var youtube = $('#youtube');
        var categories_events = $('#categories_events');

        var name_place = $('#name_place');
        var location_events = $('#location_events');
        var start_events = $('#start_events');
        var date0 = $('#date0');
        var title = $('#title');
        var authors = $('#authors');

        var photo_Title0 = $('#photo-Title0');
        var photo_Title1 = $('#photo-Title1');
        var photo_Title2 = $('#photo-Title2');
        var photo_Title3 = $('#photo-Title3');
        var photo_Title4 = $('#photo-Title4');
        var photo_Title5 = $('#photo-Title5');


        if (isEmpty(country) && isEmpty(province) && isEmpty(districts) && isEmpty(sector) && 
            isEmpty(cell) && isEmpty(village) && isEmpty(title) && isEmpty(authors) && isEmpty(name_place) && isEmpty(location_events) && isEmpty(date0)  && isEmpty(start_events)  && isEmpty(categories_events) && isEmpty(additioninformation) && 
            isEmpty(photo) && isEmpty(video) && isEmpty(youtube) && isEmpty(photo_Title0) && isEmpty(photo_Title1) && isEmpty(photo_Title2) &&
            isEmpty(photo_Title3) && isEmpty(photo_Title4) && isEmpty(photo_Title5)) {
            
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
                    data: new FormData(this),
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
                        }, 2000);
                        setInterval(function () {
                            location.reload();
                        }, 2400);
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
