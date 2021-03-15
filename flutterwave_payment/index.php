<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rave payment Gateway</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <form action="http://localhost/irangiro_social_site/flutterwave_payment/pay.php" method="POST">

        <label>Email</label>
        <input type="email" name="email">
        <br>
        <label>Amount</label>
        <input type="number" name="amount">
        <br>
        <input type="submit" name="pay" vlaue="Send Payment">

        </form>
    </body>
</html>