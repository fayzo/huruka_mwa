$(document).ready(function () {
    $(document).on('click', '.jobHovers', function () {
        // e.stopPropagation();
        var job_id = $(this).data('job');
        var business_id = $(this).data('business');
        $.ajax({
            url: 'core/ajax_db/businessPostView',
            method: 'POST',
            dataType: 'text',
            data: {
                job_id: job_id,
                business_id: business_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".job-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.jobHovers0', function () {
        // e.stopPropagation();
        var job_id = $(this).data('job');
        var business_id = $(this).data('business');
        $.ajax({
            url: 'core/ajax_db/businessPostView0',
            method: 'POST',
            dataType: 'text',
            data: {
                job_id: job_id,
                business_id: business_id,
            }, success: function (response) {
                $(".jobslarge").html(response);
                // console.log(response);
            }
        });
    });

    $(window).bind('load',function () {
        // var jobHovers0 = document.getElementsByClassName('jobHovers0')[0]; 
        // var jobHovers0 = document.querySelector('.jobHovers0')[0]; 
        var get= $('.jobHovers0').get(0); // $('jobHovers0').eq(0); // $('jobHovers0').first();
        var job_id = $(get).data('job');
        // console.log(Number.isInteger($(get).data('job')));
        if (Number.isInteger($(get).data('job')) === true) {
            
            var business_id = $(get).data('business');
            // console.log(get,$(get).data('job'));
            
            $.ajax({
                url: 'core/ajax_db/businessPostView0',
                method: 'POST',
                dataType: 'text',
                data: {
                    job_id: job_id,
                    business_id: business_id
                }, success: function (response) {
                    $(".jobslarge").html(response);
                    // console.log(response);
                }
            });

        }

    });

    $(document).on('click', '.inbox-view', function () {
        // e.stopPropagation();
        var cv_id = $(this).data('cv_id');
        $.ajax({
            url: 'core/ajax_db/businessApplyViewinbox',
            method: 'POST',
            dataType: 'text',
            data: {
                cv_id: cv_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".inbox-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.trash-view', function () {
        // e.stopPropagation();
        var trash_id = $(this).data('trash_id');
        $.ajax({
            url: 'core/ajax_db/businessApplyViewTrash',
            method: 'POST',
            dataType: 'text',
            data: {
                trash_id: trash_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".trash-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('keyup', '.search0', function () {
        if ($(this).val() != "") {
            $('.job-hide').hide();
        } else {
            $('.job-hide').show();
        }
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/businessPostView',
            method: 'POST',
            dataType: 'text',
            data: {
                search: searching,
            }, success: function (response) {
                $(".job-show").html(response);
                // console.log(response);
            }
        });
    });
});