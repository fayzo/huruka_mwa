$(document).ready(function () {

    $(document).on('click', '#CrowfundpostComment', function () {
        var comment = $('#commentField').val();
        var crowfund_id = $('#commentField').data('crowfund');

        if (comment != "") {
            $.ajax({
                url: 'core/ajax_db/crowfunding_comment',
                method: 'POST',
                dataType: 'text',
                data: {
                    comments: comment,
                    crowfund_id: crowfund_id,
                }, success: function (response) {
                    $('#comments').html(response);
                    $('#commentField').val("");
                    // console.log(response);
                }
            });
        }

    });

});