$(document).on('click', '.deleteCrowFundraisingComment', function (e) {
    e.preventDefault();
    var fund_id = $(this).data('fund');
    var comment_id = $(this).data('comment');

    $.ajax({
        url: 'core/ajax_db/crowfunding_comment',
        method: 'POST',
        dataType: 'text',
        data: {
            fund_id: fund_id,
            deletecomment_id: comment_id,
        }, success: function (response) {
            $("#responseComment").html(response);
            $("#userComment"+comment_id).html('');
            $("#responseMess").html(response);
            setInterval(function () {
                $("#responseComment").fadeOut();
            }, 1000);

            // console.log(response);
        }
    });
});


    $(document).on('click', '.deleteCrowfund', function (e) {
        e.preventDefault();
        var fund_id = $(this).data('fund');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/crowfund_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                deletefund: user_id,
                showpopupdelete: fund_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".fund-popup").hide();
                });
                $(".delete-it-crowfund").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/crowfund_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: fund_id,
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
