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


$(document).on('click', '#submit-form-send-money', function (e) {
    // event.preventDefault();
    e.stopPropagation();
    var formdatas = $('#send-money-form');
    var username = $('#status-send-money');
    var amount = $('#amount-send-money');
    var amount_available = $('#amount_available').val();

    if (isEmpty(username) && isEmpty(amount) && amount_available >= 100.00){

    if (amount.val() >= 50.00){

    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/test',
        method: "POST",
        dataType: 'text',
        data: formdatas.serialize(),
        success: function (response) {
            $(".balance-popup").hide();
            $(".promote-popup").hide();
            // $(".popupTweet").hide();

            if (response.indexOf('SUCCESS') >= 0) {
                // location.reload();
                $("#checkOUT").modal('show');
                $('#html-check').html(response).css({"text-align":"center"});
                $("#checkOUT").delay(2000).fadeOut(450);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 1500);
                setTimeout(() => {
                    location.reload();
                }, 2000);
                console.log(response);
                
            } else{
                $("#response-send-money").html(response).css({"color":"red"});;
                $("#checkOUT").modal('show');
                $('#change-check').removeClass('fa fa-check-circle-o')
                .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                // $('#html-check').html('We can not process your payment').css({"text-align":"center"});
                $('#html-check').html(response).css({"text-align":"center"});
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
        }else {
            $("#checkOUT").modal('show');
            $('#change-check').removeClass('fa fa-check-circle-o')
            .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
            $('#html-check').html('We can not process your payment is to low').css({"text-align":"center"});
            $("#checkOUT").delay(2000).fadeOut(450);
            setTimeout(() => {
                $("#checkOUT").modal('hide');
            }, 1500);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    } else {
        $("#response-send-money").html('We can not process your payment is to low').css({"color":"red"});;

        isEmptys(username) || isEmptys(amount)
    }
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
            $(".balance-popup").hide();
            $(".promote-popup").hide();
            // $(".popupTweet").hide();

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


function withdraw_money(amount,month,firstname,lastname,email,fund_id,user_id,coins) {

    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/test',
        method: 'POST',
        dataType : "text",
        // contentType: "application/json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            pay: 'pay',
            subscription: 'withdraw_coins',
            withdraw: coins,
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
            $(".balance-popup").hide();
            $(".promote-popup").hide();
            // $(".popupTweet").hide();

            if (response.indexOf('SUCCESS') >= 0) {
                // window.open(objJSON.data.link, '_blank');
                // window.location.href = objJSON.data.link;
                // window.location = objJSON.data.link;
                // location.reload();
                
                if (coins == 'fundraising withdraw') {
                    
                    $.ajax({
                        url: 'core/ajax_db/fund_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: fund_id,
                        }, success: function (response) {
                            $("#checkOUT").modal('show');
                            $("#checkOUT").delay(2000).fadeOut(450);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 1500);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            // console.log(response);
                        }

                    });
                }

                if (coins == 'tweet withdraw') {
                    
                        $.ajax({

                            url: 'core/ajax_db/deletePost',
                            method: 'POST',
                            dataType: 'text',
                            data: {
                            deleteTweetHome: fund_id,
                        }, success: function (response) {
                            $("#checkOUT").modal('show');
                            $("#checkOUT").delay(2000).fadeOut(450);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 1500);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            // console.log(response);
                        }

                    });
                }

                if (coins == 'crowfund withdraw') {
                    
                    $.ajax({
                        url: 'core/ajax_db/crowfund_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: fund_id,
                        }, success: function (response) {
                            $("#checkOUT").modal('show');
                            $("#checkOUT").delay(2000).fadeOut(450);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 1500);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            // console.log(response);
                        }

                    });
                }
                
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

// function withdraw_coins(amount,month,firstname,lastname,email,user_id,coins) {

    $(document).on('click', '.submit-form-withdraw-money', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var formdatas = $('#withdraw-money-form');
        var amount = $('#amount-withdraw-money');
        var amount_available = $('#amount_available_').val();
    
    if (isEmpty(amount) && amount.val() >= 5000 && amount_available >= 100.00){

    if (confirm('Are you sure you want withdrawal your money??')) {

    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/test',
        method: 'POST',
        dataType: 'text',
        data: formdatas.serialize(),
        success: function (response) {
            // var  objJSON = JSON.parse(response);
            // console.log(objJSON.status,objJSON.data.link);
            // if (objJSON.status == "success") {
            $(".balance-popup").hide();
            $(".promote-popup").hide();
            // $(".popupTweet").hide();

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
                console.log(response);

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
  }else{
        isEmptys(amount)
      $("#checkOUT").modal('show');
      $('#change-check').removeClass('fa fa-check-circle-o')
      .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
      $('#html-check').html('We can not process your payment is to low').css({"text-align":"center"});
      $("#checkOUT").delay(2000).fadeOut(450);
      setTimeout(() => {
          $("#checkOUT").modal('hide');
      }, 1500);
      setTimeout(() => {
          location.reload();
      }, 2000);

  }
});


