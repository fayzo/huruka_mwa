$(document).ready(function () {

    $(document).on('click', '.delete-sale', function (e) {
        e.preventDefault();
        var sale_id = $(this).data('sale');
        var user_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/sale_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                deleteEvents: user_id,
                showpopupdelete: sale_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-retweet-popup,.cancel-it").click(function () {
                    $(".sale-popup").hide();
                });
                $(".delete-it-sale").click(function () {
                    $.ajax({
                        url: 'core/ajax_db/sale_delete',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            deleteTweetHome: sale_id,
                        }, success: function (response) {
                            $("#responseDeletePost").html(response);
                            setInterval(function () {
                                $("#responseDeletePost").fadeOut();
                            }, 1000);
                            setInterval(function () {
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

    $(document).on('click', '.update-sale-btn', function (e) {
        e.preventDefault();
        var sale_id = $(this).data('sale');
        var user_id = $(this).data('user');
        var title = $('#title' + sale_id).val();
        var available = $('#available' + sale_id).val();
        var discount_change = $('#discount_change' + sale_id).val();
        var discount_price = $('#discount_price' + sale_id).val();
        var price = $('#price' + sale_id).val();
        var banner = $('#banner' + sale_id).val();

        $.ajax({
            url: 'core/ajax_db/sale_delete',
            method: 'POST',
            dataType: 'text',
            data: {
                sale_id: sale_id,
                user_id: user_id,
                title: title,
                available: available,
                discount_change: discount_change,
                discount_price: discount_price,
                price: price,
                banner: banner,
            }, success: function (response) {
                $("#response" + sale_id).html(response);
                setInterval(function () {
                    $("#response" + sale_id).fadeOut();
                }, 1000);
                setInterval(function () {
                    location.reload();
                }, 1100);
                // console.log(response);
            }

        });
    });

    $(document).on('change', '#update-form-sale', function (e) {
        e.preventDefault();
        var sale_id = $(this).data('sale');
        var image = $(this).val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $(this).val('');
            return false;
        } else {
            $('#form-photo'+sale_id).submit();
            // console.log(image);
        }
        
    });

});

function saleuploadz(success, fileName) {
    if (success) {
        $('#salePreview' + success).attr("src",fileName);
        // $('#salePreview'+success).attr("src", fileName);
        // $('#fileInput').attr("value", fileName);
        console.log(success);
        console.log(fileName);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}
