$(document).ready(function () {

    $(document).on('click', '.deletecar', function (e) {
        e.preventDefault();
        var car_id = $(this).data('car');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/car_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteEvents: user_id,
                showpopupdelete: car_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".car-popup").hide();
                });
                $(".delete-it-car").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/car_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: car_id,
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

    $(document).on('click', '.update-car-btn', function (e) {
        e.preventDefault();
        var car_id = $(this).data('car');
        var user_id = $(this).data('user');
        var available = $('#available' + car_id).val();
        var discount_change = $('#discount_change' + car_id).val();
        var discount_price = $('#discount_price' + car_id).val();
        var price = $('#price' + car_id).val();
        var banner = $('#banner' + car_id).val();

            $.ajax({
                url: 'core/ajax_db/car_delete',
                method: 'POST',
                dataType: 'text',
                data: {
                    car_id: car_id,
                    user_id: user_id,
                    available: available,
                    discount_change: discount_change,
                    discount_price: discount_price,
                    price: price,
                    banner: banner,
                }, success: function (response) {
                    $("#response"+ car_id).html(response);
                    setInterval(function () {
                        $("#response"+ car_id).fadeOut();
                    }, 1000);
                    setInterval(function () {
                        location.reload();
                    }, 1100);
                    // console.log(response);
                }

            });
        });

});