$(document).ready(function () {

    $(document).on('click', '#funding_Comment', function () {
        var comment = $('#commentField').val();
        var fund_id = $('#commentField').data('fund');

        if (comment != "") {
            $.ajax({
                url: 'core/ajax_db/fundraising_comment',
                method: 'POST',
                dataType: 'text',
                data: {
                    comments: comment,
                    fund_id: fund_id,
                }, success: function (response) {
                    $('#comments').html(response);
                    $('#commentField').val("");
                    // console.log(response);
                }
            });
        }

    });

});