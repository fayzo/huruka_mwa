<?php 
include "../core/init.php";

if (!isset($_SESSION['keys'])) {
     header('location: '.LOGIN.'');
    exit();
}

if (isset($_POST['key']) == 'lockscreen') {

    $users->forgotUsernameCountsTodelete('users',
    array('forgotUsernameCounts' => 'forgotUsernameCounts +1', ),$_SESSION['keys']);

    $password = $users->test_input($_POST['password']);
    $sql= $db->query("SELECT user_id ,username,approval,chat,email FROM users WHERE user_id= $_SESSION[keys] AND password='{$password}' ");
    $row= $sql->fetch_assoc();

    if ($sql->num_rows > 0) {
        $datetime= date('Y-m-d H-i-s');
        $db->query("UPDATE users SET last_login = '$datetime'  WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $db->query("UPDATE users SET counts_login=counts_login + 1 WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $db->query("UPDATE users SET chat = 'on' WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $_SESSION['key'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['approval'] = $row['approval'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['chat'] = $row['chat'];
        exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Success</strong> </div>');
    }else{
        exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Please Try Again ...!!!</strong> </div>');
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

    .form-container {
        position: relative;
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
        padding: 15px 15px;
        margin: 10px 0;
        width: 100%;
        border-radius: 10px;
        outline: none;
        height: 45px
    }
    .lockscreen-credentials {
       margin-left: 78px;
    }

    .lockscreen-item {
        border-radius: 4px;
        padding: 0;
        position: relative;
        margin: 50px auto 30px auto;
        width: 300px;
    }
    .input-group-text{
        margin-top: 9px;
        border: none;
    }
   
     /* User image */

    .lockscreen-image {
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: -20px;
        z-index: 10;
    }
    #white .lockscreen-image>img {
        border-radius: 50%;
        background: #fff;
        padding: 5px;
        width: 100px;
        height: 100px;
    }

    #green .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(27, 168, 22);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #green .input-group-text{
        background-color: rgb(27, 168, 22);
    }
    #green .text-muted {
        color: #f3f6f9!important;
    }
    #red .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(240, 94, 94);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #red .input-group-text{
        background-color: #f05e5e;
    }
    #red .text-muted {
        color: #f3f6f9!important;
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
            <h4><?php echo $_SESSION['username']; ?></h4>
            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                <?php if(!empty($_SESSION['profile_img'])){ ?>
                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$_SESSION['profile_img'] ;?>" alt="User Image">
                <?php }else{ ?>
                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL; ?>" alt="User Image">
                <?php } ?>
                </div>
                <form class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" id="Password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <span class="input-group-text btn" onclick="lockscreen('lockscreen')" aria-label="Username"
                                aria-describedby="basic-addon1"><i class="fa fa-arrow-right text-muted"></i></span>
                        </div>
                    </div>
                </form>
                <p id="errors"></p>
                <div id="response"></div>
                <div class="help-block text-center">
                    <a class="alink" href="<?php echo FORGET_PASSPOWRD ;?>"> Enter your password or Forgot your password?</a>
                </div>
                <div class="help-block text-center">
                    or
                </div>
                <div class="text-center">
                    <a href="logout.php">Sign in as a different User</a>
                </div>
            </div>

        </div>
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
    function lockscreen(key) {
        var password = $("#Password");
        //   use 1 or second method to validaton
        if (isEmpty(password)) {
            //    alert("complete register");
            $.ajax({
                url: "lockscreen",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    password: password.val(),
                },
                success: function(response) {
                    $("#response").html(response);
                    console.log(response);
                    if (response.indexOf('Success') >= 0) {
                        setInterval(() => {
                            window.location = '../';
                        }, 1000);
                    } else {
                        isEmptys(password);
                    }
                }
            });
        }
    }

    function isEmpty(caller) {
        if (caller.val() == "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please fill in ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        } else {
            caller.css("border", "1px solid green");
            $('body').attr("id", 'green');
            $('#error').html("Success").css("color", "green");
        }
        return true;
    }

    function isEmptys(caller) {
        if (caller.val() != "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please Try Again ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        }
        return true;
    }
    $('body').attr("id", 'white');
    </script>
</body>
</html>