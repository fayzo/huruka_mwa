$(document).ready(function () {

    $(document).on('click', '.post_as', function (e) {
        e.stopPropagation();
        var post_as = $(this).data('post_as');

        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: 'POST',
            dataType: 'text',
            data: {
                post_as: post_as,

            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".jobs-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.loginTerms', function (e) {
        e.stopPropagation();
        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: 'POST',
            dataType: 'text',
            data: {
                loginTerms: 'loginTerms',
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".jobs-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.loginTerms0', function (e) {
        e.stopPropagation();
        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: 'POST',
            dataType: 'text',
            data: {
                loginTerms0: 'loginTerms0',
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".jobs-popup").hide();
                });
                // console.log(response);
            }
        });
    });



    $(document).on('click', '.price-jobs', function (e) {
        e.stopPropagation();
        var post_jobs = $(this).data('pricejob');

        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: 'POST',
            dataType: 'text',
            data: {
                post_jobs: post_jobs,

            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".jobs-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.payment-job', function (e) {
        e.stopPropagation();
        var user = $(this).data('user');
        var payment_jobs_jobs = 'df';

        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: 'POST',
            dataType: 'text',
            data: {
                payment_jobs_jobs: payment_jobs_jobs,
                user: user

            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".jobs-popup").hide();
                });
                // console.log(response);
            }
        });
    });
});


function jobsLogin(key) {
    var username = $("#Username");
    var username = $("#Username");
    var email = $("#inputEmail");
    var password = $("#inputPassword");
    //   use 1 or second method to validaton
    if (isEmpty(username) && isEmpty(email) && isEmpty(password)) {
        //    alert("complete register");
        $.ajax({
            url: 'core/ajax_db/price_jobsPost',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                username: username.val(),
                email: email.val(),
                password: password.val(),
            },
            success: function (response) {
                $("#response").html(response).fadeIn();
                setInterval(function () {
                    $("#response").fadeOut();
                }, 2000);
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // window.location = '../indexx';
                    if(response.indexOf('SME') >= 0){
                        window.location = 'business_jobPost';
                    }else{
                        window.location = 'individual_jobPost';
                    }
                } else if (response.indexOf('Fail') >= 0) {
                    setInterval(() => {
                            // location.reload();
                        // window.location = 'lockscreen';
                    }, 1000);
                    isEmptys(password);
                } else {
                    isEmptys(username) || isEmptys(password);
                }
            }
        });
    }
}
