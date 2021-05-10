<?php 
include('../init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['subscription'])) {

    $user_id= $_SESSION['key'];
    $datetime= date('Y-m-d H-i-s');

    $name= $_POST['name'];
    $email= $_POST['email'];

    $month= $_POST['month'];
    $price = $_POST['amount'];
    $subscription = $_POST['subscription'];

    $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
    VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','{$month}','{$price}','{$datetime}')";
    $result = $db->query($query);
    
    var_dump('ERROR: Could not able to execute'. $result.mysqli_error($db));
    var_dump($result);

    if ($_POST['subscription'] == 'job') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'job_subscription'=> $month,
          'job_price_pay'=> $price,
          'job_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
        
        // var_dump($va);
    }

    if ($_POST['subscription'] == 'fund_donation') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'fund_donation_subscription'=> $month,
          'fund_donation_price_pay'=> $price,
          'fund_donation_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'crowfund_donation') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'crowfund_donation_subscription'=> $month,
          'crowfund_donation_price_pay'=> $price,
          'crowfund_donation_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'newsfeed') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'newsfeed_subscription'=> $month,
          'newsfeed_price_pay'=> $price,
          'newsfeed_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'marketing') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'marketing_subscription'=> $month,
          'marketing_price_pay'=> $price,
          'marketing_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'house') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'house_subscription'=> $month,
          'house_price_pay'=> $price,
          'house_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'school') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'school_subscription'=> $month,
          'school_price_pay'=> $price,
          'school_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'icyamunara') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'icyamunara_subscription'=> $month,
          'icyamunara_price_pay'=> $price,
          'icyamunara_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'car') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,

          'car_subscription'=> $month,
          'car_price_pay'=> $price,
          'car_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));

    }

    if ($_POST['subscription'] == 'marketplace') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'marketplace_subscription'=> $month,
          'marketplace_price_pay'=> $price,
          'marketplace_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'events') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'events_subscription'=> $month,
          'events_price_pay'=> $price,
          'events_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'crowfunding') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'crowfund_subscription'=> $month,
          'crowfund_price_pay'=> $price,
          'crowfund_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'fundraising') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'fundraising_subscription'=> $month,
          'fundraising_price_pay'=> $price,
          'fundraising_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'irangiro') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],

          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'irangiro_subscription'=> $month,
          'irangiro_price_pay'=> $price,
          'irangiro_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

    if ($_POST['subscription'] == 'delete_account') {
        # code...
        $users->updateQuery_coins('subscription',array( 
          'subscription'=> $_POST['subscription'],
          'user_id_subscription'=> $user_id,
          'name_subscription'=> $name,
          'email_subscription'=> $email,
          
          'delete_subscription'=> $month,
          'delete_price_pay'=> $price,
          'delete_date_pay'=> $datetime ),
          array(
            'user_id_subscription'=> $user_id,
        ));
    }

}

    // `subscription_id`,
    // `user_id_subscription`,

    // `job_subscription`, 
    // `job_price_pay`,
    // `job_date_pay`,

    // `newsfeed_subscription`,
    // `newsfeed_price_pay`,
    // `newsfeed_date_pay`,

    // `marketing_subscription`,
    // `marketing_price_pay`,
    // `marketing_date_pay`,

    // `house_subscription`,
    // `house_price_pay`, 
    // `house_date_pay`,

    // `school_subscription`,
    // `school_price_pay`,
    // `school_date_pay`,

    // `icyamunara_subscription`,
    // `icyamunara_price_pay`,
    // `icyamunara_date_pay`,

    // `car_subscription`,
    // `car_price_pay`,
    // `car_date_pay`,

    // `marketplace_subscription`,
    // `marketplace_price_pay`,
    // `marketplace_date_pay`



?>