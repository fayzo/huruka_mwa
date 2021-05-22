$(document).ready(function () {
    
    $(document).on('click', '#coins-dropdown-menu', function () {
        var showcoins = 1;

        $.ajax({
            url: 'core/ajax_db/messages.php',
            method: 'POST',
            dataType: 'text',
            data: {
                showcoins: showcoins,
            }, success: function (response) {
                $("#coins-menu-view").html(response);
                // $("#email1").hide();
                console.log(response);
            }
        });
    });

    

    $(document).on('click', '.price-post', function (e) {
        e.stopPropagation();
        var post = $(this).data('pricejob');

        $.ajax({
            url: 'core/ajax_db/price_Post',
            method: 'POST',
            dataType: 'text',
            data: {
                name_detail: post,

            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".promote-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.reward_coins_tweet_id', function (e) {
        e.stopPropagation();

        var user_id = $(this).data('user_id');
        var tweet_id = $(this).data('tweet_id');

        var FormDatas = $('.form-coins'+tweet_id);
        var amount_coins = $('#amount_coins'+tweet_id);
        var comment_coins = $('#comment_coins'+tweet_id);
        var user_key = $('#user_key'+tweet_id).val();


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

                            $(".response_coins").html(response).css({"color":"red"});;
                            setTimeout(() => {
                                $(".promote-popup").hide();
                                $("#checkOUT").modal('show');
                                $("#checkOUT").delay(2000).fadeOut(450);
                            }, 2000);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);
                            setTimeout(() => {
                                location.reload();
                            }, 4000);

                        }
                    }
                });

        }

    });

    $(document).on('click', '#reward-coins-profile', function (e) {
            // event.preventDefault();
        e.stopPropagation();
        var user_id = $(this).data('user');
        var coins = $(this).data('coins');

        $.ajax({
            // url: 'flutter/pay',
            url: 'core/ajax_db/send_reward_coinsPop',
            method: 'POST',
            dataType: 'text',
            data: { 
                user_id : user_id,
                coins : coins,
            },
            success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".promote-popup").hide();
                });
                // console.log(response);
            }

        });
    });

    $(document).on('click', '.reward_coins_user_id', function (e) {
        e.stopPropagation();
        var user_id = $(this).data('user_id');
        var FormDatas = $('.form-coins'+user_id);
        var amount_coins = $('#amount_coins'+user_id);
        var comment_coins = $('#comment_coins'+user_id);
        var user_key = $('#user_key'+user_id).val();

        if (isEmpty(amount_coins) && isEmpty(comment_coins) ) {

            if (user_id != user_key) {

            $.ajax({
                url: 'core/ajax_db/transactions_coins',
                method: 'POST',
                dataType: 'text',
                data: FormDatas.serialize(),
                success: function (response) {
                    console.log(response);

                    if (response.indexOf('SUCCESS') >= 0) {

                        $(".response_coins").html(response).css({"color":"red"});;
                        setTimeout(() => {
                            $(".promote-popup").hide();
                            $("#checkOUT").modal('show');
                            $("#checkOUT").delay(2000).fadeOut(450);
                        }, 2000);
                        setTimeout(() => {
                            $("#checkOUT").modal('hide');
                        }, 3500);
                        setTimeout(() => {
                            location.reload();
                        }, 4000);
                        
                    }
                }
            });

        } else {

            isEmptys(amount_coins) || isEmptys(comment_coins) 
            $(".response_coins").html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"color":"red"});;
            setTimeout(() => {
                $(".promote-popup").hide();
                $("#response-send-money").html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"color":"red"});;
                $("#checkOUT").modal('show');
                $('#change-check').removeClass('fa fa-check-circle-o')
                .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                // $('#html-check').html('We can not process your payment').css({"text-align":"center"});
                $('#html-check').html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"text-align":"center"});
                $("#checkOUT").delay(2000).fadeOut(450);
            }, 2000);
            setTimeout(() => {
                $("#checkOUT").modal('hide');
            }, 3500);
            setTimeout(() => {
                location.reload();
            }, 4000);
        }

        }

    });


    
    $(document).on('click', '.reward_coins_tweet_id_user_id', function (e) {
        e.stopPropagation();

        var user_id = $(this).data('user_id');
        var tweet_id = $(this).data('tweet_id');

        var FormDatas = $('.form-coins'+tweet_id);
        var amount_coins = $('#amount_coins'+tweet_id);
        var comment_coins = $('#comment_coins'+tweet_id);
        var user_key = $('#user_key'+tweet_id).val();

        if (isEmpty(amount_coins) && isEmpty(comment_coins) ) {

            if (user_id != user_key) {

                $.ajax({
                    url: 'core/ajax_db/transactions_coins',
                    method: 'POST',
                    dataType: 'text',
                    data: FormDatas.serialize(),
                    success: function (response) {
                        console.log(response);
                        $(".response_coins").html(response);
                        if (response.indexOf('SUCCESS') >= 0) {

                            $(".response_coins").html(response).css({"color":"red"});;
                            setTimeout(() => {
                                $(".promote-popup").hide();
                                $("#checkOUT").modal('show');
                                $("#checkOUT").delay(2000).fadeOut(450);
                            }, 2000);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);
                            setTimeout(() => {
                                location.reload();
                            }, 4000);

                        }
                    }
                });

            } else {

                isEmptys(amount_coins) || isEmptys(comment_coins) 
                $(".response_coins").html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"color":"red"});;
                setTimeout(() => {
                    $(".promote-popup").hide();
                    $("#response-send-money").html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"color":"red"});;
                    $("#checkOUT").modal('show');
                    $('#change-check').removeClass('fa fa-check-circle-o')
                    .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                    // $('#html-check').html('We can not process your payment').css({"text-align":"center"});
                    $('#html-check').html('YOU CAN NOT SEND COINS TO YOURSELF !!!').css({"text-align":"center"});
                    $("#checkOUT").delay(2000).fadeOut(450);
                }, 2000);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 3500);
                setTimeout(() => {
                    location.reload();
                }, 4000);
            }

        }

    });

    $(document).on('click', '#update_transfer_payment', function (e) {
        e.stopPropagation();
        var withdraw_id = $(this).data('withdraw');
        var type = $(this).data('type');

            $.ajax({
                url: 'core/ajax_db/transactions_coins',
                method: 'POST',
                dataType: 'text',
                data: {
                    withdraw_id:withdraw_id,
                    status_type:type
                },
                success: function (response) {
                    console.log(response);
                    $(".response"+withdraw_id).html(response);
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

    });

    $(document).on('click', '.submit-account-payment-form', function (e) {
        e.stopPropagation();
        var FormDatas = $('#account-payment-form');
        var type_of_payment = $('#type_of_payment');

        if (isEmpty(type_of_payment) ) {

            $.ajax({
                url: 'core/ajax_db/transactions_coins',
                method: 'POST',
                dataType: 'text',
                data: FormDatas.serialize(),
                success: function (response) {
                    console.log(response);
                    $(".response-account-payment").html(response);
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

                    }else{
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



function coins_recharge(amount,month,firstname,lastname,email,user_id,coins) {
    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/test',
        // url: 'core/ajax_db/transactions_coins',
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
            // $(".popupTweet").hide();

            if (response.indexOf('SUCCESS') >= 0) {

                $(".balance-popup").hide();
                // window.open(objJSON.data.link, '_blank');
                // window.location.href = objJSON.data.link;
                // window.location = objJSON.data.link;
                // location.reload();
                $('#recharge-coins').html(response);

                $(".response_coins").html(response).css({"color":"red"});;

                setTimeout(() => {
                    $(".promote-popup").hide();
                    $("#checkOUT").modal('show');
                    $("#checkOUT").delay(2000).fadeOut(450);
                }, 2000);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 3500);
                setTimeout(() => {
                    location.reload();
                }, 4000);

                console.log(response);
                
            } else{
                $('#recharge-coins').html(response);

                $("#checkOUT").modal('show').css({"z-index":"20000"});
                $('#change-check').removeClass('fa fa-check-circle-o')
                .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                $('#html-check').html('We can not process your payment is to low !!!').css({"text-align":"center"});
                $("#checkOUT").delay(2000).fadeOut(450);
                setTimeout(() => {
                    $("#checkOUT").modal('hide');
                }, 1500);
                // setTimeout(() => {
                //     location.reload();
                // }, 2000);
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


$(document).on('click', '#reward-coins-profilecvnkdmdl', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var user_id = $(this).data('user');
        var coins = $(this).data('coins');

    $.ajax({
        // url: 'flutter/pay',
        url: 'core/ajax_db/transactions_coins',
        method: 'POST',
        dataType: 'text',
        data: { 
            user_id : user_id,
            coins : coins,
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
});


$(document).on('click', '.delete-all-coins', function (e) {
    e.preventDefault();
    var user_id = $(this).data('user');
    
    if (confirm('Are you sure you want withdrawal your money??')) {
        $.ajax({
            url: 'core/ajax_db/test',
            method: 'POST',
            dataType: 'text',
            data: {
                delete_all_coins: 'delete_all_coins',
                user_id: user_id,
            }, success: function (response) {
                
                if (response.indexOf('SUCCESS') >= 0) {

                    $(".response").html(response);

                    setTimeout(() => {
                        $(".donate-popup").hide();
                        $(".promote-popup").hide();
                        $("#checkOUT").modal('show');
                        $("#checkOUT").delay(2000).fadeOut(450);
                    }, 2000);
                    setTimeout(() => {
                        $("#checkOUT").modal('hide');
                    }, 3500);
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                    console.log(response);
                    
                } else{
                    $(".response").html(response);
    
                    $("#checkOUT").modal('show');
                    $('#change-check').removeClass('fa fa-check-circle-o')
                    .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                    $('#html-check').html('We can not process').css({"text-align":"center"});
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
});
    

$(document).on('click', '.delete-all-subscription-statement', function (e) {
    e.preventDefault();
    var user_id = $(this).data('user');
    
    if (confirm('Are you sure you want withdrawal your money??')) {
        $.ajax({
            url: 'core/ajax_db/test',
            method: 'POST',
            dataType: 'text',
            data: {
                delete_all_subscription_statement: 'delete_all_subscription_statement',
                user_id: user_id,
            }, success: function (response) {
                
                if (response.indexOf('SUCCESS') >= 0) {

                    $(".response").html(response);

                    setTimeout(() => {
                        $(".donate-popup").hide();
                        $(".promote-popup").hide();
                        $("#checkOUT").modal('show');
                        $("#checkOUT").delay(2000).fadeOut(450);
                    }, 2000);
                    setTimeout(() => {
                        $("#checkOUT").modal('hide');
                    }, 3500);
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                    console.log(response);
                    
                } else{
                    $(".response").html(response);
    
                    $("#checkOUT").modal('show');
                    $('#change-check').removeClass('fa fa-check-circle-o')
                    .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                    $('#html-check').html('We can not process').css({"text-align":"center"});
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
});
    