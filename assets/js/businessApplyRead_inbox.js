$(document).ready(function () {

    $(document).on('click', '.deleteforminbox',function (e) {
        e.preventDefault();
        var deletes = $(this).data('delete');
        var cvid = $(this).data('cvid');

                $.ajax({
                    url: 'core/ajax_db/businessApplyViewInbox',
                    method: 'POST',
                    dataType: 'text',
                    data:{
                        delete: deletes,
                        cvid: cvid,
                   },
                    success: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 3000);
                    }
                });
         
    });

    $(document).on('click', '.deleteTrashinbox',function (e) {
        e.preventDefault();
        var deletes = $(this).data('delete');
        var trashid = $(this).data('trashid');

                $.ajax({
                    url: 'core/ajax_db/businessApplyViewTrash',
                    method: "POST",
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        delete: deletes,
                        trashid: trashid,
                    },
                    success: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 3000);
                    }
                });
         
    });
    
    $(document).on('click', '.alldeleteinbox',function (e) {
        e.preventDefault();

        $.ajax({
            url: 'core/ajax_db/businessApplyViewTrash.php',
            method: "POST",
            dataType: 'text',
            data: $('#form-delete-all').serialize(),
            success: function (response) {
                $("#responseSubmitalldelete").html(response).fadeIn();
                setInterval(function () {
                    $("#responseSubmitalldelete").fadeOut();
                }, 2000);
                setInterval(function () {
                    // location.reload();
                }, 2400);
            }, error: function (response) {
                $("#responseSubmitalldelete").html(response).fadeIn();
                setInterval(function () {
                    $("#responseSubmitalldelete").fadeOut();
                }, 3000);
            }
        });
         
    });

    $(document).on('click', '.alldeleteSent',function (e) {
        e.preventDefault();

        $.ajax({
            url: 'core/ajax_db/businessApplyViewTrash.php',
            method: "POST",
            dataType: 'text',
            data: $('#form-delete-all-sent').serialize(),
            success: function (response) {
                $("#responseSubmitalldeleteSent").html(response).fadeIn();
                setInterval(function () {
                    $("#responseSubmitalldeleteSent").fadeOut();
                }, 2000);
                setInterval(function () {
                    // location.reload();
                }, 2400);
            }, error: function (response) {
                $("#responseSubmitalldeleteSent").html(response).fadeIn();
                setInterval(function () {
                    $("#responseSubmitalldeleteSent").fadeOut();
                }, 3000);
            }
        });
         
    });

    $(document).on('click', '.alldeleteTrash',function (e) {
                e.preventDefault();

                $.ajax({
                    url: 'core/ajax_db/businessApplyViewTrash.php',
                    method: "POST",
                    dataType: 'text',
                    data: $('#form-delete-all-trash').serialize(),
                    success: function (response) {
                        $("#responseSubmitalldeleteTrash").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitalldeleteTrash").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmitalldeleteTrash").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitalldeleteTrash").fadeOut();
                        }, 3000);
                    }
                });
         
    });

    $('#form-trash0').submit(function (event) {
        // $('#form-trash0').find('input[type=checkbox]').prop('checked', function (event){
            e.preventDefault();
            // var b = $("input:checkbox:not(:checked)");
            // $(b).each(function () {
            //     $(this).val(0);
            //     $(this).attr("checked", true);
            // });

                $.ajax({
                    url: 'core/ajax_db/businessApplyViewTrash.php',
                    method: "POST",
                    data: $(this).serialize(),
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                        console.log(response);
                    }, error: function (response) {
                        $("#responseSubmitdelete").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitdelete").fadeOut();
                        }, 3000);
                    }
                });
         
            // });
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
