$(document).ready(function () {

    $(document).on('click', '.deleteHouse', function (e) {
        e.preventDefault();
        var house_id = $(this).data('house');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/house_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteEvents: user_id,
                showpopupdelete: house_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".house-popup").hide();
                });
                $(".delete-it-house").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/house_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: house_id,
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

    $(document).on('click', '.update-house-btn', function (e) {
        e.preventDefault();
        var house_id = $(this).data('house');
        var user_id = $(this).data('user');
        var available = $('#available' + house_id).val();
        var discount_change = $('#discount_change' + house_id).val();
        var discount_price = $('#discount_price' + house_id).val();
        var price = $('#price' + house_id).val();
        var banner = $('#banner' + house_id).val();

            $.ajax({
                url: 'core/ajax_db/house_delete',
                method: 'POST',
                dataType: 'text',
                data: {
                    house_id: house_id,
                    user_id: user_id,
                    available: available,
                    discount_change: discount_change,
                    discount_price: discount_price,
                    price: price,
                    banner: banner,
                }, success: function (response) {
                    $("#response"+ house_id).html(response);
                    setInterval(function () {
                        $("#response"+ house_id).fadeOut();
                    }, 1000);
                    setInterval(function () {
                        location.reload();
                    }, 1100);
                    // console.log(response);
                }

            });
        });

});