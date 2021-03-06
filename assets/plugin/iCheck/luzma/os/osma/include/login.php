<?php 
include "../core/init.php";

if (isset($_SESSION['key'])) {
    header('location: '.HOME.'');
    exit();
}

if (isset($_SESSION['key']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    header('location: '.LOCKSCREEN_LOGIN.'');
    exit();
}

if(isset($_POST['key'])){

 if ($_POST['key'] == 'login') {
    
     $datetime= date('Y-m-d H-i-s'); // last_login 
     $email = $users->test_input($_POST['email']);
     $password =  $users->test_input($_POST['password']);

    if (strlen($password) < 3) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password is too short</strong> </div>');
    }else{
     $users->login($email, $password,$datetime);
     }
 } 

 if ($_POST['key'] == 'signup') {
    
     $datetime= date('Y-m-d H-i-s'); // last_login 
     $date_registry= date('Y-m-d'); // date_registry 
     $firstname =  $users->test_input($_POST['firstname']);
     $lastname = $users->test_input($_POST['lastname']);
     $username =  $users->test_input($_POST['username']);
     $gender =  $users->test_input($_POST['gender']);
     $country =  $users->test_input($_POST['country']);
     $date_birth =  $users->test_input($_POST['date']);
     $email =  $users->test_input($_POST['email']);
     $password =  $users->test_input($_POST['password']);
     $verifypassword =  $users->test_input($_POST['verifypassword']);
     $link = array('Jobs','Professional','Fundraising','School','House','icyamunara','Car','GushoraStartUp','Marketplace');

     if(!preg_match("/^[a-zA-Z ]*$/", $firstname)){
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Only letters and white space allowed</strong> </div>');
    }else if(!preg_match("/^[a-zA-Z ]*$/", $lastname)){
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Only letters and white space allowed</strong> </div>');
    }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email invalid format</strong> </div>');
    }else if (strlen($username) > 20) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username must be between 6-10 character</strong> </div>');
    }else if (in_array($username,$link)) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username already in used </strong> </div>');
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
    }else {

        require '../signup_for_thank.php';

        $users->alreadyUseEmail('users',array(
            'username' => $username, 
            'email' => $email, 
        ), array(
            'firstname' => $firstname, 
            'lastname' => $lastname, 
            'gender' => $gender, 
            'username' => $username, 
            'email' => $email, 
            'country' => $country, 
            'password' => $password, 
            'date_birth' => $date_birth,
            'date_registry' => $date_registry, 
            'last_login' => $datetime, 
            'color' => '', 
            'approval' => 'off', 
            'amount_coins'=> '10.00',
            'amount_francs'=> '1000',
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
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL_PUBLIC;?>favicon_io/favicon-32x32.png">
    <link href="<?php echo BASE_URL_LINK ;?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL_LINK ;?>dist/css/login.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/font-awesome/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo BASE_URL_LINK;?>dist/css/AdminLTE.css" rel="stylesheet" >
    <link href="<?php echo BASE_URL_LINK;?>plugin/skins/_all-skins.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/background.css">

    <script src="<?php echo BASE_URL_LINK ;?>js/country_login.js"></script>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
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

    <div class='body-center'>

    <?php if($device_type == 'computer') { ?>
  
    <div class="containers d-none d-md-block" id="container" style="background:none">
        <div class="form-container sign-up-container">
            <form action="post">
                <div id="response"></div>
                <h2 style="text-align: center;">Create Account</h2>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="firstname" placeholder="Firstname" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="lastname" placeholder="Lastname" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <select class="custom-select bg-light" name="gender" id="gender">
                                <option value="" selected>Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="myDiv">
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Date birth</span>
                    </div>
                    <input type="date" class="form-control" name="date" id="date" placeholder="date of birth" />
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">@</span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" name="verifypassword" id="verifypassword" class="form-control"
                                placeholder="verify Password" />
                        </div>
                    </div>

                </div>

                <button id="myBtn-siginup" class="redbutton" onclick="signup('signup')" type="button">Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in-container" style="background:none">
            <form action="post" style="background:none">
                <div id="responses"></div>
                <h1 class="h10">Sign in</h1>
                <div class="social-container">
                irangiro
                </div>
                <input type="text" name="usernameoremail" id="usernameoremail" placeholder="Username or Email " />
                <input type="password" name="passwordlogin" id="passwordlogin" placeholder="Password" />
                <a class="alink" href="<?php echo FORGET_PASSPOWRD ;?>">Forgot your password?</a>
                <button class="blacButton" id="myBtn-sigin" onclick="manage('login')" type="button">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="h10">Welcome Back!</h1>
                    <p class="p0">To keep connected with us please login with your personal info</p>
                    <button class="ghost redbutton" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right" style="background: #42383854 no-repeat 0 0 / cover;">
                    <h1 class="h10">Hello, Friend!</h1>
                    <p class="p0">Enter your personal details and start journey with us</p>
                    <button class="ghost redbutton" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <?php }

    if($device_type == 'phone') { ?>
        <?php include 'login_dispay_sm_phone.php';
    } ?>

    </div><!-- body-center -->
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
    <script src="<?php echo BASE_URL_LINK ;?>js/login.js"></script>
    <script>
    
    var inputLogin = document.getElementById("passwordlogin");
    var inputSignup = document.getElementById("verifypassword");

    inputSignup.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("myBtn-siginup").click();
        }
    });

    // on send text field (textarea) keypress do this
    $('#passwordlogin').keypress(function (e) {
        if (e.keyCode == 13) {
            // on [shift + enter] pressed do this
            if (e.shiftKey) {
                return true;
            }
            // on enter button pressed do this
            document.getElementById("myBtn-sigin").click();
            return false;
        }
    });

    function manage(key) {
        var email = $("#usernameoremail");
        var password = $("#passwordlogin");
        //   use 1 or second method to validaton
        if (isEmpty(email) && isEmpty(password)) {
            //    alert("complete register");
            $.ajax({
                url: "login",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    email: email.val(),
                    password: password.val(),
                },
                success: function(response) {
                    $("#responses").html(response);
                    console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        setInterval(() => {
                            window.location = '../';
                            // window.location.href= '/';
                        }, 1000);
                    } else if (response.indexOf('Fail') >= 0) {
                        setInterval(() => {
                            window.location = 'lockscreen';
                        }, 2000);
                        isEmptys(password);
                    } else {
                       isEmptys(email) || isEmptys(password) 
                    }
                }
            });
        }
    }

    function signup(key) {
        var firstname = $("#firstname");
        var lastname = $("#lastname");
        var gender = $("#gender");
        var country = $("#country");
        var date = $("#date");
        var username = $("#username");
        var email = $("#email");
        var password = $("#password");
        var verifypassword = $("#verifypassword");
        //   use 1 or second method to validaton
        if (isEmpty(firstname) && isEmpty(lastname) && isEmpty(gender) && isEmpty(country) &&
         isEmpty(date) && isEmpty(username) && isEmpty(email) && isEmpty(password) && 
         isEmpty(verifypassword)) {
            //    alert("complete register");
            $.ajax({
                url: "login",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    firstname: firstname.val(),
                    lastname: lastname.val(),
                    gender: gender.val(),
                    date: date.val(),
                    country: country.val(),
                    username: username.val(),
                    email: email.val(),
                    password: password.val(),
                    verifypassword: verifypassword.val(),
                },
                success: function(response) {
                    $("#response").html(response);
                    console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        setInterval(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        isEmptys(firstname) || isEmptys(lastname) || isEmptys(gender) || isEmptys(country) ||
                            isEmptys(date) || isEmptys(username) || isEmptys(email) || isEmptys(password) ||
                            isEmptys(verifypassword)
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