$(document).ready(function () {

    $(document).on('click', '#add_icyamunara', function (e) {
        $('.progress-hidex').hide();
        $('.progress-hidec').hide();
        $('.progress-hidez').hide();
        e.stopPropagation();
        var icyamunara_view = $(this).data('icyamunara');

        $.ajax({
            url: 'core/ajax_db/icyamunara_addcategories',
            method: 'POST',
            dataType: 'text',
            data: {
                icyamunara_view: icyamunara_view,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".icyamunara-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '#icyamunara-readmore', function () {
        // e.stopPropagation();
        var house_id = $(this).data('icyamunara');

        $.ajax({
            url: 'core/ajax_db/icyamunara_readmore',
            method: 'POST',
            dataType: 'text',
            data: {
                house_id: house_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".icyamunara-popup").hide();
                });
                // console.log(response);
            }
        });
    });

    $(document).on('click', '#submit-form-icyamunara', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var formdatas = $('#form-icyamunara');
        var authors = $('#authors');
        var additioninformation = $('#addition-information');
        var photo = $('#photo');
        var other_photo = $('#other-photo');
        var phone = $('#phone');
        var price3 = $('#price');
        var authors = $('#author');
        var province = $('.provincecode');
        var districts = $('.districtcode');
        var sector = $('.sectorcode');
        var cell = $('.codecell');
        var village = $('.CodeVillage');
        var photo_Titleo0 = $('#photo-Titleo0');
        var photo_Title0 = $('#photo-Title0');
        var photo_Title1 = $('#photo-Title1');
        var photo_Title2 = $('#photo-Title2');
        var photo_Title3 = $('#photo-Title3');
        var photo_Title4 = $('#photo-Title4');
        var photo_Title5 = $('#photo-Title5');


        if (isEmpty(province) && isEmpty(districts) &&
            isEmpty(sector) && isEmpty(cell) && isEmpty(village) && isEmpty(additioninformation)  && 
            isEmpty(authors) && isEmpty(price3) && isEmpty(phone) && isEmpty(photo) &&
            isEmpty(other_photo) && isEmpty(photo_Titleo0) && isEmpty(photo_Title0) && isEmpty(photo_Title1) &&
            isEmpty(photo_Title2) && isEmpty(photo_Title3) && isEmpty(photo_Title4) && isEmpty(photo_Title5)) {

            var extensions3 = $('#photo').val().split('.').pop().toLowerCase();
            var extensions4 = $('#other-photo').val().split('.').pop().toLowerCase();

            if (jQuery.inArray(extensions3, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmithouse").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmithouse").fadeOut();
                }, 4000);
                $('#photo').val('');
                return false;
            } else if (jQuery.inArray(extensions4, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmithouse").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmithouse").fadeOut();
                }, 4000);
                $('#other-photo').val('');
                return false;
            } else {
                $.ajax({
                    url: 'core/ajax_db/icyamunara_addcategories',
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
                        $("#responseSubmithouse").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmithouse").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmithouse").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmithouse").fadeOut();
                        }, 3000);
                    }
                });
                return false;
            }
        }
    });

});