$(document).ready(function () {
    
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

function coins(amount,firstname,lastname,email,user_id,coins) {
    $.ajax({
        url: 'flutter/pay',
        method: 'POST',
        dataType : "text",
        // contentType: "application/json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            pay: 'pay',
            description: coins,
            amount: amount,
            name: firstname+' '+lastname,
            email: email,
            user_id: user_id
        },
        success: function (response) {
            var  objJSON = JSON.parse(response);
            // console.log(objJSON.status,objJSON.data.link);
            if (objJSON.status == "success") {
                window.open(objJSON.data.link, '_blank');
                // window.location.href = objJSON.data.link;
                // window.location = objJSON.data.link;
            } else{
                return 'We can not process your payment';
            }
        }
    });
}


