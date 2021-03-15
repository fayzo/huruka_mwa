<?php 
include('core/init.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>irangiro</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_coming_soon/css/bd-coming-soon.css">
</head>

<body class="min-vh-100 d-flex flex-column">
    <main class="my-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6 section-left">
                    <h1 class="page-title">We are launching soon</h1>
                    <div id="timer" class="bd-cd-timer">
                        <div class="time-card">
                            <span class="time-count" id="days"></span>
                            <span class="time-label">DAYS</span>
                        </div>
                        <div class="time-card">
                            <span class="time-count" id="hours"></span>
                            <span class="time-label">HOURS</span>
                        </div>
                        <div class="time-card">
                            <span class="time-count" id="minutes"></span>
                            <span class="time-label">MINUTES</span>
                        </div>
                        <div class="time-card">
                            <span class="time-count" id="seconds"></span>
                            <span class="time-label">SECONDS</span>
                        </div>
                    </div>
                    <form class="form-subscribe" id="newslatter_form" method ="post">
                        <div class="form-group">
                            <label for="email" class="sr-only">email</label>
                            <input type="email" name="newslatter_email_client" id="newslatter_email_client" class="form-control" placeholder="email address">
                        </div>
                        <button type="button" id="newslatter_form_submit" class="btn btn-subscribe">Notify Me</button>
                    </form>
                        <div id="responseNewslatter"></div>
                </div>
                <div class="col-md-6 d-none d-md-flex align-items-center">
                    <img src="assets_coming_soon/images/coming-soon.png" alt="coming soon" class="img-fluid">
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <nav class="footer-social-links">
            <a href="#!" class="social-link"><i class="mdi mdi-facebook-box"></i></a>
            <a href="#!" class="social-link"><i class="mdi mdi-twitter"></i></a>
            <a href="#!" class="social-link"><i class="mdi mdi-google"></i></a>
        </nav>
        <p class="footer-text mb-0">
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a style="color:white" href="https://irangiro.com">Irangiro LTD</a>.</strong> All rights
        </p>
    </footer>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
    <script src="assets_coming_soon/js/bd-timer.js"></script>
</body>

</html>