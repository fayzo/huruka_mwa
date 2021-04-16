<?php 
include "../core/init.php";

if (!isset($_SESSION['keycreate'])) {
    header('location: '.LOCKSCREEN_LOGIN.'');
    exit();
}

$user_id = $_SESSION['keycreate'];

if(isset($_POST['key'])){

 if ($_POST['key'] == 'password') {
    
     $password =  $users->test_input($_POST['newpassword']);
     $verifypassword =  $users->test_input($_POST['verifypassword']);

     if (strlen($password) > 8) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password must be between 4-8 character</strong> </div>');
     }else if (strlen($password) < 3) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password is too short</strong> </div>');
    }else if ($password != $verifypassword) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password Must eqaul to verification</strong> </div>');
    }else{

        $user_createPassword_id= $users->updates('users',array( 
            'user_id' => $user_id,
            'password' => $password),$user_id);

        $_SESSION['keys'] = $user_createPassword_id;

          $users->forgotUsernameCountsTodelete('users',
          array('forgotUsernameCounts' => 0, ),$user_createPassword_id);

          $users->forgotUsernameCountsTimesHeCreatespassword('users',
          array('forgotUsernameCountsTimesHeCreatespassword' => 'forgotUsernameCountsTimesHeCreatespassword + 1'),
          $user_createPassword_id);

          exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS NOW LOGIN</strong> </div>');
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

    .lockscreen-image>img {
        border-radius: 50%;
        background: #fff;
        padding: 5px;
        width: 70px;
        height: 70px;
    }

    .lockscreen-image {
        border-radius: 50%;
        z-index: 10;
    }

    .form-container {
        margin-top: 2%;
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

    button:focus {
        outline: none;
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

            <div class="lockscreen-image">
                <?php if(!empty($_SESSION['profile_img'])){ ?>
                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$_SESSION['profile_img'] ;?>" alt="User Image">
                <?php }else{ ?>
                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL; ?>" alt="User Image">
                <?php } ?>
            </div>

        <h4><?php echo $_SESSION['username'] ;?></h4>
            <form action="post">
                <h2 style="text-align: center;">Create Password</h2>
                <!-- <label for="country">Country</label> -->

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="text" name="newpassword" id="newpassword" class="form-control"
                        placeholder="New password" />
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="text" name="verifypassword" id="verifypassword" class="form-control"
                        placeholder="verify password" />
                </div>
                <div style="margin-top:7px;">
                    <div id="response"></div>

                    <div class="row">
                        <div class="col-6">
                            <button class="blackbutton" type="button"><a href="<?php echo LOGOUT ;?>">Cancel</a></button>
                        </div>
                        <div class="col-6">
                            <button class="redbutton" onclick="current('password')" type="button">submit</button>
                        </div>
                    </div>
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
      <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://irangiro.com">irangiro IRG</a>.</strong> All rights
      reserved.
    </footer>

</div><!-- wrapper -->

        <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
        <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
        <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo BASE_URL_LINK ;?>js/adminlte.js"></script>

        <script>
        function current(key) {
            var newpassword = $("#newpassword");
            var verifypassword = $("#verifypassword");
            //   use 1 or second method to validaton
            //    alert("complete register");

            if (isEmpty(newpassword) && isEmpty(verifypassword)) {

                $.ajax({
                    url: "createpassword",
                    method: "POST",
                    dataType: "text",
                    data: {
                        key: key,
                        newpassword: newpassword.val(),
                        verifypassword: verifypassword.val(),
                    },
                    success: function(response) {
                        $("#response").html(response);
                        console.log(response);
                        if (response.indexOf('SUCCESS') >= 0) {
                            setInterval(() => {
                                window.location = 'lockscreen.php';
                            }, 2000);
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
        </script>
</body>

</html>