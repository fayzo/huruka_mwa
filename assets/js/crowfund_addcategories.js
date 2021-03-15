$(document).ready(function () {

    $(document).on('click', '#crowfund-readmore', function (e) {
        e.stopPropagation();
        var crowfund_id = $(this).data('crowfund');

        $.ajax({
            url: 'core/ajax_db/crowfundraising_readmore',
            method: 'POST',
            dataType: 'text',
            data: {
                crowfund_id: crowfund_id,
                username: 'irangiro',
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".crowfund-popup").hide();
                });
                console.log(response);
            }
        });
    });

    $(document).on('click', '#add_crowfund', function (e) {
        $('.progress-hidex').hide();
        $('.progress-hidec').hide();
        $('.progress-hidez').hide();
        e.stopPropagation();
        var crowfund_view = $(this).data('crowfund');

        $.ajax({
            url: 'core/ajax_db/crowfundraising_addhelp',
            method: 'POST',
            dataType: 'text',
            data: {
                crowfund_view: crowfund_view,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".crowfund-popup").hide();
                });
                console.log(response);
            }
        });
    });

    $(document).on('click', '#submit-help-crowfund', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var formdatas = $('#form-crowfund');
        var firstname = $('#first-name');
        // var middlename = $('#middle-name');
        var lastname = $('#last-name');
        var email = $('#email');
        var telephone = $('#telephone');
        var address = $('#address');
        var country = $('#country');
        var additioninformation = $('#addition-information');
        var city = $('#city');
        // var province = $('#province');
        // var districts = $('#districts');
        // var sector = $('#sector');
        // var cell = $('#cell');
        // var village = $('#village');
        var province = $('.provincecode');
        var districts = $('.districtcode');
        var sector = $('.sectorcode');
        var cell = $('.codecell');
        var village = $('.CodeVillage');

        var money_raising = $('#money_raising');
        var photo = $('#photo');
        var other_photo = $('#other-photo');
        var video = $('#video');
        var youtube = $('#youtube');
        var categories_crowfundraising = $('#categories_crowfundraising');
        var photo_Titleo0 = $('#photo-Titleo0');
        var photo_Title0 = $('#photo-Title0');
        var photo_Title1 = $('#photo-Title1');
        var photo_Title2 = $('#photo-Title2');
        var photo_Title3 = $('#photo-Title3');
        var photo_Title4 = $('#photo-Title4');
        var photo_Title5 = $('#photo-Title5');

        if (isEmpty(firstname) && isEmpty(lastname) && isEmpty(email) && isEmpty(address) &&
            isEmpty(telephone) && isEmpty(country) && isEmpty(city) && isEmpty(province) && isEmpty(districts) &&
            isEmpty(sector) && isEmpty(cell) && isEmpty(village) && isEmpty(categories_crowfundraising) && isEmpty(money_raising) && isEmpty(additioninformation) && 
            isEmpty(photo) && isEmpty(other_photo) && isEmpty(video) && isEmpty(youtube) && isEmpty(photo_Titleo0) && isEmpty(photo_Title0) && isEmpty(photo_Title1) && isEmpty(photo_Title2) &&
            isEmpty(photo_Title3) && isEmpty(photo_Title4) && isEmpty(photo_Title5)) {
            
            var extensions1 = $('#photo').val().split('.').pop().toLowerCase();
            var extensions2 = $('#other-photo').val().split('.').pop().toLowerCase();
            
            if (jQuery.inArray(extensions1, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmithelp").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmithelp").fadeOut();
                }, 4000);
                $('#photo').val('');
                return false;
            } else if (jQuery.inArray(extensions2, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmithelp").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmithelp").fadeOut();
                }, 4000);
                $('#other-photo').val('');
                return false;
            } else {
                $.ajax({
                    url: 'core/ajax_db/crowfundraising_addhelp',
                    method: "POST",
                    // data: new FormData(this),
                    data: formdatas.serializefiles(),
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            var progress = Math.round((e.loaded / e.total) * 100);
                            $('.progress-hidex').show();
                            $('.progress-hidec').show();
                            $('.progress-hidez').show();
                            $('#prox').css('width', progress + '%');
                            $('#proc').css('width', progress + '%');
                            $('#proz').css('width', progress + '%');
                            $('#prox').html(progress + '%');
                            $('#proc').html(progress + '%');
                            $('#proz').html(progress + '%');
                        });

                        xhr.addEventListener('load', function (e) {
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                        return xhr;
                    },
                    success: function (response) {
                        $("#responseSubmithelp").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmithelp").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmithelp").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmithelp").fadeOut();
                        }, 3000);
                    }
                });
                return false;
            }
        }
    });

    $(document).on('click', '.imagecrowcrowfundViewPopup', function (e) {
        e.stopPropagation();
        var crowfund_id = $(this).data('crowfund');
        $.ajax({
            url: 'core/ajax_db/crowfundraisingImageViewPopup',
            method: 'POST',
            dataType: 'text',
            data: {
                showpimage: crowfund_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".img-popup").hide();
                });
                console.log(response);
            }
        });
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
