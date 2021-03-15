$(document).ready(function () {
    $(document).on('click', '.like-fundraising-btn', function () {
        var fund_id = $(this).data('fund');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/fundraising_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: fund_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-fundraising-btn');
                button.removeClass('like-fundraising-btn');
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
    $(document).on('click', '.unlike-fundraising-btn', function () {
        var fund_id = $(this).data('fund');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/fundraising_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: fund_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-fundraising-btn');
                button.removeClass('unlike-fundraising-btn');
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
    $(document).on('click', '.like-fundraisingUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/fundraisingUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-fundraisingUser-btn');
                button.removeClass('like-fundraisingUser-btn');
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
    $(document).on('click', '.unlike-fundraisingUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/fundraisingUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-fundraisingUser-btn');
                button.removeClass('unlike-fundraisingUser-btn');
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