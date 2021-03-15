$(document).ready(function () {

    $(document).on('click', '.deleteTweetSchool', function (e) {
        e.preventDefault();
        var school_id = $(this).data('school');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/school_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                delete_user_id: user_id,
                showpopupdelete: school_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".car-popup").hide();
                });
                $(".delete-it-car").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/school_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetSchool: school_id,
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


});