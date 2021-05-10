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
                    console.log(response);
                    $(".response_coins").html(response);
                    if (response.indexOf('SUCCESS') >= 0) {

                        $(".popupTweet").delay(3000).hide();
                        $("#checkOUT").delay(3000).modal('show');
                        $("#checkOUT").delay(2000).fadeOut(450);
                        setTimeout(() => {
                            $("#checkOUT").modal('hide');
                        }, 2000);
                        setTimeout(() => {
                            location.reload();
                        }, 2500);

                    }
                }
            });

        }

    });

});

function coins(amount,month,firstname,lastname,email,user_id,coins) {
    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/test',
        method: 'POST',
        dataType : "text",
        // contentType: "application/json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            pay: 'pay',
            subscription: coins,
            description: coins,
            month: month,
            amount: amount,
            name: firstname+' '+lastname,
            email: email,
            user_id: user_id
        },
        success: function (response) {
            // var  objJSON = JSON.parse(response);
            // console.log(objJSON.status,objJSON.data.link);
            // if (objJSON.status == "success") {
            $(".promote-popup").hide();

            if (response.indexOf('SUCCESS') >= 0) {
                // window.open(objJSON.data.link, '_blank');
                // window.location.href = objJSON.data.link;
                // window.location = objJSON.data.link;
                // location.reload();
                $("#checkOUT").modal('show');
                $("#checkOUT").delay(2000).fadeOut(450);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 1500);
                setTimeout(() => {
                    location.reload();
                }, 2000);
                console.log(response);
                
            } else{

                $("#checkOUT").modal('show');
                $('#change-check').removeClass('fa fa-check-circle-o')
                .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                $('#html-check').html('We can not process your payment').css({"text-align":"center"});
                $("#checkOUT").delay(2000).fadeOut(450);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 1500);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        }
    });
}


