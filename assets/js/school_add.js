$(document).ready(function () {

$(document).on('click', '#add_school', function (e) {
    $('.progress-hidex').hide();
    $('.progress-hidec').hide();
    $('.progress-hidez').hide();

    $('#provincecode').attr('id', 'provincecode-remove');
    $('#districtcode').attr('id', 'districtcode-remove');
    $('#sectorcode').attr('id', 'sectorcode-remove');
    $('#codecell').attr('id', 'codecell-remove');
    $('#CodeVillage').attr('id', 'CodeVillage-remove');

    e.stopPropagation();
    var school_view = $(this).data('school');

    $.ajax({
        url: 'core/ajax_db/school_add.php',
        method: 'POST',
        dataType: 'text',
        data: {
            school_view: school_view,
        }, success: function (response) {
            $(".popupTweet").html(response);
            $(".close-imagePopup").click(function () {
                $(".school-popup").hide();
            });
            console.log(response);
        }
    });
});

$(document).on('click', '#school-help-add', function (e) {
    // event.preventDefault();

    e.stopPropagation();
    var formdatas = $('#form-school');
    var title = $('#title');
    var author = $('#author');
    var phone = $('#phone');
    var additioninformation = $('#addition-information');
    var photo = $('#photo');
    var other_photo = $('#other-photo');
    var video = $('#video');
    var youtube = $('#youtube');
    var categories_of_school = $('#categories_of_school');
    var type_of_school = $('#type_of_school');
    var location_province = $('#provincecode');
    var location_districts = $('#districtcode');
    var location_Sector = $('#sectorcode');
    var location_cell = $('#codecell');
    var location_village = $('#CodeVillage');

    if (isEmpty(title) && isEmpty(author) &&isEmpty(phone) && 
        isEmpty(location_province) && isEmpty(location_districts) &&
        isEmpty(location_Sector) && isEmpty(location_cell) && isEmpty(location_village) &&
        isEmpty(categories_of_school) && isEmpty(type_of_school) && isEmpty(additioninformation) &&
         isEmpty(photo) && isEmpty(other_photo) && isEmpty(video) && isEmpty(youtube)) {

        var extensions1 = $('#photo').val().split('.').pop().toLowerCase();
        var extensions2 = $('#other-photo').val().split('.').pop().toLowerCase();

        if (jQuery.inArray(extensions1, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
            $("#responseSubmitschool").html('Invalid Image File').fadeIn();
            setInterval(function () {
                $("#responseSubmitschool").fadeOut();
            }, 4000);
            $('#photo').val('');
            return false;
        } else if (jQuery.inArray(extensions2, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
            $("#responseSubmitschool").html('Invalid Image File').fadeIn();
            setInterval(function () {
                $("#responseSubmitschool").fadeOut();
            }, 4000);
            $('#other-photo').val('');
            return false;
        } else {
            $.ajax({
                url: 'core/ajax_db/school_add.php',
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
                    $("#responseSubmitschool").html(response).fadeIn();
                    setInterval(function () {
                        $("#responseSubmitschool").fadeOut();
                    }, 2000);
                    setInterval(function () {
                        location.reload();
                    }, 2400);
                }, error: function (response) {
                    $("#responseSubmitschool").html(response).fadeIn();
                    setInterval(function () {
                        $("#responseSubmitschool").fadeOut();
                    }, 3000);
                }
            });
            return false;
        }
    }
 });

    $(document).on('keyup', '.searchSchool', function () {
        if ($(this).val() != "") {
            $('.school-hide').hide();
        } else {
            $('.school-hide').show();
        }
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/school_FecthPaginat.php',
            method: 'POST',
            dataType: 'text',
            data: {
                search: searching,
            }, success: function (response) {
                $(".school-show").html(response);
                console.log(response);
            }
        });
    });

    $(document).on('click', '#school-readmore', function (e) {
        e.stopPropagation();
        var school_id = $(this).data('school');

        $.ajax({
            url: 'core/ajax_db/school_readmore.php',
            method: 'POST',
            dataType: 'text',
            data: {
                school_id: school_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".school-popup").hide();
                });
                console.log(response);
            }
        });
    });
});


   