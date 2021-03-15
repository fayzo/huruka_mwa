$(document).ready(function () {
    
    $(document).on('click', '#events_Comment', function () {
        var comment = $('#commentField').val();
        var events_id = $('#commentField').data('events');

        if (comment != "") {
            $.ajax({
                url: 'core/ajax_db/events_comment',
                method: 'POST',
                dataType: 'text',
                data: {
                    comments: comment,
                    events_id: events_id,
                }, success: function (response) {
                    $('#comments').html(response);
                    $('#commentField').val("");
                    // console.log(response);
                }
            });
        }

    });

    $(document).on('click', '.deleteEvents', function (e) {
        e.preventDefault();
        var events_id = $(this).data('events');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/events_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteEvents: user_id,
                showpopupdelete: events_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".events-popup").hide();
                });
                $(".delete-it-events").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/events_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: events_id,
                        }, success: function (response) {
                            $("#responseDeletePost").html(response);
                            setInterval(function () {
                                $("#responseDeletePost").fadeOut();
                            }, 1000);
                            setInterval(function () {
                                location.reload();
                            }, 1100);
                            // console.log(response);
                        }

                    });
                });
                // console.log(response);
            }

        });
    });

    $(document).on('click', '.deleteEventsComment', function (e) {
        e.preventDefault();
        var events_id = $(this).data('events');
        var comment_id = $(this).data('comment');

        $.ajax({
            url: 'core/ajax_db/events_comment',
            method: 'POST',
            dataType: 'text',
            data: {
                events_id: events_id,
                deletecomment_id: comment_id,
            }, success: function (response) {
                $("#responseComment").html(response);
                $("#userComment" + comment_id).html('');
                setInterval(function () {
                    $("#responseComment").fadeOut();
                }, 1000);
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.like-events-btn', function () {
        var events_id = $(this).data('events');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/events_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: events_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-events-btn');
                button.removeClass('like-events-btn');
                counter++;
                likescounter.text(counter++);
                button.find('.fa-heart-o').addClass('fa-heart').css('color', 'black');
                button.find('.fa-heart').removeClass('fa-heart-o');
               
                // location.reload();

                // console.log(response);
            }
        });
    });
});


$(document).ready(function () {
    $(document).on('click', '.unlike-events-btn', function () {
        var events_id = $(this).data('events');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/events_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: events_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-events-btn');
                button.removeClass('unlike-events-btn');
                counter--;
                if (counter === 0) {
                    likescounter.hide();
                } else {
                    likescounter.text(counter--);
                }
                button.find('.fa-heart').addClass('fa-heart-o');
                button.find('.fa-heart-o').removeClass('fa-heart');


                // console.log(response);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '.like-eventsUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/eventsUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-eventsUser-btn');
                button.removeClass('like-eventsUser-btn');
                counter++;
                likescounter.text(counter++);
                button.find('.fa-heart-o').addClass('fa-heart').css('color', 'black');
                button.find('.fa-heart').removeClass('fa-heart-o');
               
                // location.reload();

                // console.log(response);
            }
        });
    });
});


$(document).ready(function () {
    $(document).on('click', '.unlike-eventsUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/eventsUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-eventsUser-btn');
                button.removeClass('unlike-eventsUser-btn');
                counter--;
                if (counter === 0) {
                    likescounter.hide();
                } else {
                    likescounter.text(counter--);
                }
                button.find('.fa-heart').addClass('fa-heart-o');
                button.find('.fa-heart-o').removeClass('fa-heart');


                // console.log(response);
            }
        });
    });
});