function settingsUsername(key) {
    var username = $("#username");
    var email = $("#email");
    var id = $("#id_userSetting");

    $.ajax({
        url: 'core/ajax_db/setting',
        method: "POST",
        dataType: "text",
        data: {
            key: key,
            id: id.val(),
            username: username.val(),
            email: email.val(),
        },
        success: function (response) {
            // console.log(response);
            if (response.indexOf('SUCCESS') >= 0) {
                $("#response_settings").html(response);
            } else {
                $("#response_settings").html(response);
            }
        }
    });
}

function settingsUsernamepass(key) {
    var currentpassword = $("#currentPassword");
    var newpassword = $("#newpassword");
    var verifypassword = $("#verifypassword");
    var id = $("#id_userSettingPass");
    //   use 1 or second method to validaton
    //    alert("complete register");

    if (isEmpty(currentpassword) && isEmpty(newpassword) && isEmpty(verifypassword)) {

        $.ajax({
            url: 'core/ajax_db/setting',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                currentpassword: currentpassword.val(),
                newpassword: newpassword.val(),
                verifypassword: verifypassword.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    $("#response_settingpass").html(response);
                } else if (response.indexOf('Current password') >= 0) {
                    $("#response_settingpass").html(response);
                    isEmptys(currentpassword);
                } else {
                    $("#response_settingpass").html(response);
                }
            }
        });
    }
}
       // DASHBOARD SETTINGS 
       // DASHBOARD SETTINGS 
       // DASHBOARD SETTINGS 

function settingsUsername1(key) {
    var username = $("#username1");
    var email = $("#email1");
    var id = $("#id_userSetting1");

    $.ajax({
        url: 'core/ajax_db/setting',
        method: "POST",
        dataType: "text",
        data: {
            key: key,
            id: id.val(),
            username: username.val(),
            email: email.val(),
        },
        success: function (response) {
            // console.log(response);
            if (response.indexOf('SUCCESS') >= 0) {
                $("#response_settings1").html(response);
            } else {
                $("#response_settings1").html(response);
            }
        }
    });
}

function settingsUsernamepass1(key) {
    var currentpassword = $("#current-password");
    var newpassword = $("#new-password");
    var verifypassword = $("#verify-password");
    var id = $("#id_userSettingPass1");
    //   use 1 or second method to validaton
    //    alert("complete register");

    if (isEmpty(currentpassword) && isEmpty(newpassword) && isEmpty(verifypassword)) {

        $.ajax({
            url: 'core/ajax_db/setting',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                currentpassword: currentpassword.val(),
                newpassword: newpassword.val(),
                verifypassword: verifypassword.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    $("#response_settingpass1").html(response);
                } else if (response.indexOf('Current password') >= 0) {
                    $("#response_settingpass1").html(response);
                    isEmptys(currentpassword);
                }else {
                    $("#response_settingpass1").html(response);
                }
            }
        });
    }
}

function close_account(key,no) {
    if (no == 'no') {
        var result = confirm("Are you sure you want to Open your account?");
    } else {
        var result = confirm("Are you sure you want to close your account?");
    }
    
    if (result) {
        
        $.ajax({
            url: 'core/ajax_db/setting',
            method: "POST",
            dataType: "text",
            data: {
                close_account: key,
                value: no
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    $("#response_close_account").html(response);
                    if (no == 'no') {
                        $("#close_account").attr('value', 'Yes! Close it!').attr("close_account("+key+",yes)");
                    } else {
                        $("#close_account").attr('value', 'Re-Open it!').attr("close_account("+key+",no)");
                    }
                }else {
                    $("#response_close_account").html(response);
                }
            }
        });
    } 
}

function delete_account(key,no) {

    var result = confirm("Are you sure you want to Delete complete your account?");
    
    if (result) {
        
        $.ajax({
            url: 'core/ajax_db/setting',
            method: "POST",
            dataType: "text",
            data: {
                delete_account: key,
                value: no
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    $("#response_delete_account").html(response);
                }else {
                    $("#response_delete_account").html(response);
                }
            }
        });
    } 
}

function isEmpty(caller) {
    if (caller.val() == "") {
        caller.css("border", "1px solid red");
        return false;
    } else {
        caller.css("border", "1px solid green ");
    }
    return true;
}

function isEmptys(caller) {
    if (caller.val() != "") {
        caller.css("border", "1px solid red");
        return false;
    }
    return true;
}
