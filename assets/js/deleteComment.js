$(document).ready(function (e) {

    $(document).on('click', '.deleteTweet', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');
        $('.form-coins'+tweet_id).removeClass();
        $('#amount_coins'+tweet_id).removeAttr('id');
        $('#comment_coins'+tweet_id).removeAttr('id');
        $(".response_coins").removeClass();
        
        $.ajax({
            url: 'core/ajax_db/deletePost',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteTweet: comment_by,
                showpopupdelete: tweet_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".retweet-popup").hide();
                });
                $(".delete-it").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/deletePost',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: tweet_id,
                        }, success: function (response) {
                            $("#userComment_" + tweet_id).html('');
                            $("#responseDeletePost").html(response);
                            setInterval(function() {
                                $("#responseDeletePost").fadeOut();
                            }, 1000);
                            setInterval(function() {
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

    $(document).on('click', '.pinTweet', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deletePost',
            method: 'POST',
            dataType: 'text',
            data: {
                pin_user_id: comment_by,
                pin_Tweet_id: tweet_id,
            }, success: function (response) {
                
                $("#userComment_" + tweet_id).html('');
                $("#responseDeletePin"+ tweet_id).html(response);
                setInterval(function() {
                    $("#responseDeletePin"+ tweet_id).fadeOut();
                }, 1000);
                setInterval(function() {
                    location.reload();
                }, 1100);
                // console.log(response);
            }

        });
    });

    $(document).on('click', '.pinRetweet', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deletePost',
            method: 'POST',
            dataType: 'text',
            data: {
                pin_user_id: comment_by,
                pin_Retweet_id: tweet_id,
            }, success: function (response) {
                
                $("#userComment_" + tweet_id).html('');
                $("#responseDeletePin"+ tweet_id).html(response);
                setInterval(function() {
                    $("#responseDeletePin"+ tweet_id).fadeOut();
                }, 1000);
                setInterval(function() {
                    location.reload();
                }, 1100);
                // console.log(response);
            }

        });
    });
    

    $(document).on('click', '.unpinTweet', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deletePost',
            method: 'POST',
            dataType: 'text',
            data: {
                pin_user_id: comment_by,
                unpin_Tweet_id: tweet_id,
            }, success: function (response) {
                
                $("#userComment_" + tweet_id).html('');
                $("#responseDeletePin"+ tweet_id).html(response);
                setInterval(function() {
                    $("#responseDeletePin"+ tweet_id).fadeOut();
                }, 1000);
                setInterval(function() {
                    location.reload();
                }, 1100);
                // console.log(response);
            }

        });
    });

    $(document).on('click', '.unpinRetweet', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deletePost',
            method: 'POST',
            dataType: 'text',
            data: {
                pin_user_id: comment_by,
                unpin_Retweet_id: tweet_id,
            }, success: function (response) {
                
                $("#userComment_" + tweet_id).html('');
                $("#responseDeletePin"+ tweet_id).html(response);
                setInterval(function() {
                    $("#responseDeletePin"+ tweet_id).fadeOut();
                }, 1000);
                setInterval(function() {
                    location.reload();
                }, 1100);
                // console.log(response);
            }

        });
    });
    
    $(document).on('click', '.delete_retweet_by', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deletePost_retweet_by',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteTweet: comment_by,
                showpopupdelete: tweet_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".retweet-popup").hide();
                });
                $(".delete-it").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/deletePost_retweet_by',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: tweet_id,
                        }, success: function (response) {
                            $("#userComment_" + tweet_id).html('');
                            $("#responseDeletePost").html(response);
                            setInterval(function() {
                                $("#responseDeletePost").fadeOut();
                            }, 1000);
                            setInterval(function() {
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

    $(document).on('click', '.deleteComment', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_id = $(this).data('comment');

        $.ajax({
            url: 'core/ajax_db/deleteComment',
            method: 'POST',
            dataType: 'text',
            data: {
                tweet_idcommment: tweet_id,
                deletecomment: comment_id,
            }, success: function (response) {
                $("#responseComment").html(response);
                $(".tweet-show-popup-box-cut").click(function () {
                    $(".tweet-show-popup-wrap").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.deleteCommentPost', function (e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet');
        var comment_by = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/deleteCommentPost',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteTweet: comment_by,
                showpopupdelete: tweet_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-its").click(function () {
                    $(".retweet-popup").hide();
                });
                $(".delete-its").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/deleteCommentPost',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: tweet_id,
                        }, success: function (response) {
                            $("#responseDeletePost").html(response);
                            setInterval(function() {
                                $("#responseDeletePost").fadeOut();
                            }, 1000);
                            setInterval(function() {
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
   

    $(document).on('click', '.deleteCommentPostSeconds0', function (e) {
        e.preventDefault();
        var comment_id = $(this).data('comment');
        var comment_by = $(this).data('user');

                $.ajax({
                    url: 'core/ajax_db/posts_comments',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        deleteCommentHome0: comment_id,
                        comment_by: comment_by,
                    }, success: function (response) {
                        $("#responseDeletePostSeconds0").html(response);
                        $("#userComment0" + comment_id).html('');
                        setInterval(function() {
                            $("#responseDeletePostSeconds0").fadeOut();
                        }, 1000);
                        setInterval(function() {
                            // location.reload();
                        }, 1100);
                        // console.log(response);
                    }

                });
   
        });

    $(document).on('click', '.deleteCommentPostSecondDelete', function (e) {
        e.preventDefault();
        var comment_id = $(this).data('comment');
        var comment_by = $(this).data('user');

                $.ajax({
                    url: 'core/ajax_db/posts_comments',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        deleteCommentHome: comment_id,
                        comment_by: comment_by,
                    }, success: function (response) {
                        $("#responseDeletePostSecond").html(response);
                        $("#userComment" + comment_id).html('');
                        setInterval(function() {
                            $("#responseDeletePostSecond").fadeOut();
                        }, 1000);
                        setInterval(function() {
                            // location.reload();
                        }, 1100);
                        // console.log(response);
                    }

                });
   
        });
});

function delete_all(delete_all,number){

    if (confirm('Are you sure you want to delete??')) {

        $.ajax({
            url: 'core/ajax_db/dashboard_delete_all',
            method: 'POST',
            dataType: 'text',
            data: {
                delete_all: delete_all,
            }, success: function (response) {
                $("#responseDelete"+number).html(response);
                setInterval(function() {
                    location.reload();
                }, 1100);
                console.log(response);
            }

        });
    }
}

function approval_user_ui(rowID,approval,number) {
    if (confirm('Are you sure??')) {
        $.ajax({
            url: 'core/ajax_db/dashboard_delete_all',
            method: 'POST',
            dataType: 'text',
            data: {
                key: approval,
                rowID: rowID
            }, success: function (response) {
                $("#responseDelete"+number).html(response);
                $("#title"+number).html(approval);
                alert(response);
            }
        });
    }
}