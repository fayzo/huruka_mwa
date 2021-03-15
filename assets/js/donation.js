$(document).ready(function () {

    $(document).on('click', '.donation-crowfund-btn', function () {
        var user_id = $(this).data('user');
        var fund_id = $(this).data('fund');
        $.ajax({
            url: 'core/ajax_db/crowfund_donate',
            method: 'POST',
            dataType: 'text',
            data: {
                user_id: user_id,
                fund_id: fund_id,
            }, success: function (response) {
                // location.reload();
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".donate-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.donation-fundraising-btn', function () {
        var user_id = $(this).data('user');
        var fund_id = $(this).data('fund');
        $.ajax({
            url: 'core/ajax_db/fund_donate',
            method: 'POST',
            dataType: 'text',
            data: {
                user_id: user_id,
                fund_id: fund_id,
            }, success: function (response) {
                // location.reload();
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".donate-popup").hide();
                });
                // console.log(response);
            }
        });
    });

});