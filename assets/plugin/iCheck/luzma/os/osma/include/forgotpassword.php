<?php 
include "../core/init.php";

if (isset($_SESSION['keycreate'])) {
    // header('location: '.CREATE_PASSPOWRD.'');
    $email_hash= md5($_SESSION['email_hash']);

    $users->updates('users',array( 
        'user_id' => $_SESSION['keycreate'],
        'email_hash' => $email_hash),$_SESSION['keycreate']);

    $email= $_SESSION['email'];
    // $email_verified= "https://".$_SERVER['HTTP_HOST']."/email_verified?token=$email_hash";
    // $email_verified= "'http://localhost/irangiro_social_site/'email_verified?token=$email_hash";
    $email_verified= BASE_URL_PUBLIC."email_verified?token=$email_hash";

    require '../email_verified_thank.php';
    
    // exit();
    
    // exit('<div class="alert alert-success alert-dismissible fade show text-center">
    //                 <button class="close" data-dismiss="alert" type="button">
    //                     <span>&times;</span>
    //                 </button>
    //                 <strong>SUCCESS CHECK YOUR EMAIL ACCOUNT </strong> </div>');
    
    header('location: '.BASE_URL_PUBLIC.'include/forgotpassword_response');
    exit();
    // exit(file_get_contents('forgotpassword_response.php'));

}

if(isset($_POST['key'])){

 if ($_POST['key'] == 'email') {
    
    $email =  $users->test_input($_POST['email']);

    if (strpos($email,'@') == false && strlen($email) > 20) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username must be between 6-10 character</strong> </div>');
    }else if (strpos($email,'@') !== false && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Invalid email</strong> </div>');
    }else {

        $user_id=$users->forgotUsername('users', array(
            'user_id' => $email, 
            'username' => $email, 
            'email' => $email, 
        ),array(
            'username' => $email, 
            'email' => $email, 
        ));

        $users->forgotUsernameCountsTimesHeCreates('users',
            array('forgotUsernameCountsTimesHeCreates' => 'forgotUsernameCountsTimesHeCreates  + 1'
            ),$user_id);

        $users->forgotUsernameCountsTo3Update('users',array(
            'forgotUsernameCounts' => 'forgotUsernameCounts + 1'
        ),$user_id);

        $users->user_id($user_id);

        $users->UserEmailNotExit('users', array(
            'username' => $email, 
            'email' => $email, 
        ),array(
        'username' => $email, 
        'email' => $email, 
        ));


    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome</title>
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/font-awesome/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo BASE_URL_LINK;?>dist/css/AdminLTE.css" rel="stylesheet" >
    <link href="<?php echo BASE_URL_LINK;?>plugin/skins/_all-skins.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/background.css">

    <style>

    #container h1 {
        font-weight: bold;
        margin: 0;
        /* font-size: 15px; */
    }

    .form-container p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: .5px;
        margin: 20px 0 30px;
    }

    .form-container span {
        font-size: 12px;
    }

    .form-container a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    .form-container {
        margin-top: 10%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: small;
    }

    .form-container input {
        background: rgb(238, 238, 238);
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
        border-radius: 20px;
        outline: none;
    }

    input:hover {
        outline: none;
    }

    .input-group span {
        border-radius: 30px;
        padding: 0px 3px !important;
    }

    .input-group-text {
        margin-top: 9px;
        border: none;
    }

    .redbutton {
        border-radius: 20px;
        border: 1px solid #ff4b2b;
        background: #ff4b2b;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-right: 12px;
    }

    .blackbutton {
        border-radius: 20px;
        border: 1px solid #504b4a;
        background: #58585f;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-right: 12px;
    }

    .blackbutton a {
        font-size: 12px;
        text-decoration: none;
        color: #fff;
    }

    button:active {
        transform: scale(.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background: transparent;
        border-color: #fff;
    }
    </style>
</head>

<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition fixed sidebar-collapse skin-blue">
<!-- Site wrapper skin-blue -->
<div class="wrapper">
    <!-- =============================================== -->
    <!-- navbar path -->
    <?php include '../header_navbar_footer/navbar.php'; ?>
    <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper chair">
    <!-- <div style="float:left;margin:50px 50px;">
            < ?php echo $home->options0();?>
    </div> -->

    <!-- Main content -->
    <section class="content container ">

    <div id="container">

        <div class="form-container">
            <form action="post">
                <h2 style="text-align: center;">Forgot Password</h2>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
                <div class="row">

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">@</span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Username Or Email" />
                        </div>
                    </div>

                </div>
                <div style="margin-top:7px;">
                    <div id="response"></div>

                    <button class="blackbutton" type="button"><a href="<?php echo LOGIN ;?>">Cancel</a></button>
                    <button class="redbutton" id="submit" onclick="forgot('email')" type="button">submit</button>
                </div>
            </form>
            <!-- </div> -->

        </div>
 
    </section>
    </div><!-- content-wrapper  -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.01
      </div>
      <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://irangiro.com">irangiro</a>.</strong> All rights
      reserved.
    </footer>

</div><!-- wrapper -->

        <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
        <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
        <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo BASE_URL_LINK ;?>js/adminlte.js"></script>

        <script>
        function forgot(key) {
            var email = $("#email");
            //   use 1 or second method to validaton
            if (isEmpty(email)) {
                //    alert("complete register");
                $.ajax({
                    url: "forgotpassword",
                    method: "POST",
                    dataType: "text",
                    data: {
                        key: key,
                        email: email.val(),
                    },
                    success: function(response) {
                        $("#response").html(response);
                        console.log(response);
                        if (response.indexOf('SUCCESS') >= 0) {
                            // setInterval(() => {
                            //     // window.location = 'createpassword';
                            // }, 1000);
                                location.reload();
                        }else {
                            isEmptys(email)
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
                caller.css("border", "1px solid green");
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
        </script>
</body>

</html>