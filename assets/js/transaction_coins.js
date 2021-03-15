$(document).ready(function () {
    
    $(document).on('click', '.reward_coins', function (e) {
        e.stopPropagation();
        var FormDatas = $('.form-coins');
        var amount_coins = $('#amount_coins');
        var comment_coins = $('#comment_coins');

        if (isEmpty(amount_coins) && isEmpty(comment_coins) ) {

            $.ajax({
                url: 'core/ajax_db/transactions_coins',
                method: 'POST',
                dataType: 'text',
                data: FormDatas.serialize(),
                success: function (response) {
                    $(".response_coins").html(response);
                    console.log(response);
                }
            });

        }

    });
    
    $(document).on('click', '.reward_coins_tweet_id', function (e) {
        e.stopPropagation();
        var tweet_id = $(this).data('tweet_id');
        var FormDatas = $('.form-coins'+tweet_id);
        var amount_coins = $('#amount_coins'+tweet_id);
        var comment_coins = $('#comment_coins'+tweet_id);

        if (isEmpty(amount_coins) && isEmpty(comment_coins) ) {

            $.ajax({
                url: 'core/ajax_db/transactions_coins',
                method: 'POST',
                dataType: 'text',
                data: FormDatas.serialize(),
                success: function (response) {
                    $(".response_coins").html(response);
                    console.log(response);
                }
            });

        }

    });

});


