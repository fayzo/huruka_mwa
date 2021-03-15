$(document).ready(function () {
    $(document).on('click', '.like-crowfundraising-btn', function () {
        var fund_id = $(this).data('fund');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/crowfundraising_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: fund_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-crowfundraising-btn');
                button.removeClass('like-crowfundraising-btn');
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
    $(document).on('click', '.unlike-crowfundraising-btn', function () {
        var fund_id = $(this).data('fund');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/crowfundraising_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: fund_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-crowfundraising-btn');
                button.removeClass('unlike-crowfundraising-btn');
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
    $(document).on('click', '.like-crowfundraisingUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/crowfundraisingUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                like: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-crowfundraisingUser-btn');
                button.removeClass('like-crowfundraisingUser-btn');
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
    $(document).on('click', '.unlike-crowfundraisingUser-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/crowfundraisingUserComment_like',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-crowfundraisingUser-btn');
                button.removeClass('unlike-crowfundraisingUser-btn');
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