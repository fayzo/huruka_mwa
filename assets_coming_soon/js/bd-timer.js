// var endDate = new Date().getTime() + 1000800000;
var endDate = new Date("Mar 5, 2021 15:37:25").getTime();

var x = setInterval(function() {

    var now =  new Date().getTime();

    var timeRemaining = endDate - now;

    var daysRemaining = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    var hoursRemaining = Math.floor((timeRemaining % (1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutesRemaining = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    var secondsRemaining = Math.floor((timeRemaining % (1000 * 60)) / (1000));

    document.getElementById("days").innerHTML = daysRemaining;
    document.getElementById("hours").innerHTML = hoursRemaining;
    document.getElementById("minutes").innerHTML = minutesRemaining;
    document.getElementById("seconds").innerHTML = secondsRemaining; 

    if (timeRemaining < 0) { 
        clearInterval(x);
		document.getElementById("days").innerHTML ='0'; 
		document.getElementById("hours").innerHTML ='0'; 
		document.getElementById("minutes").innerHTML ='0' ; 
        document.getElementById("seconds").innerHTML = '0';
        alert("Thank you for your patience");
    }

},1000);

$(document).ready(function () {

    $(document).on('click', '#newslatter_form_submit', function (e) {
        e.stopPropagation();
        var email = $('#newslatter_email_client');
        var form_id = $('#newslatter_form');

        
        if (isEmpty(email)) {
        
            $.ajax({
                    url: 'core/ajax_db/news_coming_soon',
                    method: "POST",
                    data: form_id.serialize(),
                    success: function (response) {
                        $("#responseNewslatter").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseNewslatter").fadeOut();
                        }, 3500);
                        setInterval(function () {
                            window.location.reload();
                            // location.reload();
                        }, 3800);
                    }, error: function (response) {
                        $("#responseNewslatter").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseNewslatter").fadeOut();
                        }, 3000);
                    }
                });
                return false;
        
            }
    });

});

function isEmpty(caller) {
    if (caller.val() == "") {
        caller.css("outline", "1px solid red");
        return false;
    } else {
        caller.css("outline", "1px solid green ");
    }
    return true;
}

function isEmptys(caller) {
    if (caller.val() != "") {
        caller.css("outline", "1px solid red");
        return false;
    }
    return true;
}
