<?php 
include('../core/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Forgot Password</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL_PUBLIC;?>favicon_io/favicon-32x32.png">
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="< ?php echo BASE_URL_LINK;?>plugin/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/ui.totop.css" >

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/font-awesome/css/font-awesome.min.css">
</head>
<body>

            <div class="container">
                <div class="row">
                    <div class="col-md-3 d-none d-md-block">
                        
                    </div>
                    <div class="col-md-6 ">

                        <div class="alert alert-success alert-dismissible fade show text-center">
                        <button class="close" id="logout-please" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>CHECK YOUR EMAIL ACCOUNT </strong> </div>

                        <button type="button" name="logout" id="logout-please" class="btn btn-primary btn-md btn-block">BACK To Irangiro</button>

                        <div class="card">
                            <div class="card-body text-center">
                                <i id="change-check" class="fa fa-check-circle-o" style="font-size:200px;color: green;" aria-hidden="true"></i>
                                <p id="html-check">SUCCESS</p>
                            </div>
                        </div>
            
                    </div>
                    <div class="col-md-3 d-none d-md-block">
                        
                    </div>
                    
                </div>
            </div>

  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.form.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {

  $(document).on('click', '#logout-please', function () {
        $.ajax({
            url: 'logout',
            method: 'POST',
            dataType: 'text',
           
            success: function (response) {
                // location.reload();
                window.location.href= 'login';
                // console.log(response);
            }
        });
    });
});
</script>
</body>
</html>
