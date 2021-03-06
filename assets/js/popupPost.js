$(document).ready(function () {
    
    $(document).on('click','.t-show-popup',function () {
        var tweet_id= $(this).data('tweet');
        $('.form-coins'+tweet_id).removeClass();
        $('#amount_coins'+tweet_id).removeAttr('id');
        $('#comment_coins'+tweet_id).removeAttr('id');
        $(".response_coins").removeClass();
        
          $.ajax({
                    url: 'core/ajax_db/popupPost',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpoptweet: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".close-imagePopup").click(function () {
                            $(".tweet-show-popup-wrap").hide();
                        });
                        // console.log(response);
                    }
                });
    });

     $(document).on('click','.imagePopup',function (e) { 
         e.stopPropagation();
        var tweet_id= $(this).data('tweet');
          $.ajax({
              url: 'core/ajax_db/imagePopup',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpimage: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".close-imagePopup").click(function () {
                            $(".img-popup").hide();
                        });
                        // console.log(response);
                    }
                });
     });
    
    $(document).on('click','.imageViewPopup',function (e) { 
         e.stopPropagation();
        var tweet_id= $(this).data('tweet');
          $.ajax({
              url: 'core/ajax_db/imageViewPopup',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpimage: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".close-imagePopup").click(function () {
                            $(".img-popup").hide();
                        });
                        // console.log(response);
                    }
                });
         });
});