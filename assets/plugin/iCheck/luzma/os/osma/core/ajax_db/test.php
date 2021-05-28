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

    
    if ($_POST['subscription'] == 'buy_coins') {
      # code...
      // 1 coins = 14.28571428571428 Frw;
      // 35 coins = 14.28571428571428 Frw x 35coins =500 frw;
      
      // 1 coins = 100 Frw;
      // 35 coins = 100 Frw x 35coins =3500 frw;
      
      $amount_coins = $price/100;
      
      $users->updateQuery_money('users',array( 
        'amount_coins'=> 'amount_coins + '.$amount_coins,
        'amount_francs'=> 'amount_francs + '.$price ),
        array(
          'user_id'=> $user_id,
      ));

      $users->updateQuery_coins('subscription',array( 
        'subscription'=> $_POST['subscription'],
        'user_id_subscription'=> $user_id,
        'name_subscription'=> $name,
        'email_subscription'=> $email,

        'coins_subscription'=> $month,
        'coins_price_pay'=> $price,
        'coins_date_pay'=> $datetime ),
        array(
          'user_id_subscription'=> $user_id,
      ));
      
      // var_dump($va);
  }

  if ($_POST['subscription'] == 'withdraw_coins') {
      # code...
      
      // 1 coins = 14.28571428571428 Frw;
      // 35 coins = 14.28571428571428 Frw x 35coins =500 frw;
      
      // 1 coins = 100 Frw;
      // 35 coins = 100 Frw x 35coins =3500 frw;
      
      $amount_coins = $price/100;
      
      if ($_POST['withdraw'] == 'withdraw_coins') {
        # code...
        $users->updateQuery_money('users',array( 
          'amount_coins'=> 'amount_coins - '.$amount_coins,
          'amount_francs'=> 'amount_francs - '.$price ),
          array(
            'user_id'=> $user_id,
        ));
      }

      $insert=  $users->insertQuery('withdraw_money',array( 
        'withdraw'=> $_POST['withdraw'],
        'month'=> $month,
        'user_id_withdraw'=> $user_id,
        'name_withdraw'=> $name,
        'email_withdraw'=> $email,
        'status_withdraw'=> 'pending',

        'withdraw_coins'=> $amount_coins,
        'withdraw_price'=> $price,
        'withdraw_date'=> $datetime ),
        array(
          'user_id_withdraw'=> $user_id,
      ));

    if($insert){
        exit('<div class="alert alert-success alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>SUCCESS</strong> </div>');
    }else{
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>Fail input try again !!!</strong>
        </div>');
    }
      
      // var_dump($va);
  }


    $amount_coins = $price/100;
    
    if ($users->coins_Available($user_id,$amount_coins) == false) {

        echo '  <div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>No coins available in your account please deposit coins in your account and try again !!!</strong>
                </div>
                <a href="'.BALANCE.'" class="btn btn-primary btn-lg btn-block mb-2">Recharge Coins</a>
                
                ';

    }else {

        $result= $users->updateQuery_money('users',array( 
          'amount_coins'=> 'amount_coins - '.$amount_coins,
          'amount_francs'=> 'amount_francs - '.$price)
          ,array('user_id'=> $user_id));

        $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
        VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','{$month}','{$price}','{$datetime}')";
        $result = $db->query($query);
    
        // var_dump('ERROR: Could not able to execute'. $result.mysqli_error($db));
        // var_dump($result);

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

        if ($_POST['subscription'] == 'campain') {
            # code...
            $users->updateQuery_coins('subscription',array( 
              'subscription'=> $_POST['subscription'],
              'user_id_subscription'=> $user_id,
              'name_subscription'=> $name,
              'email_subscription'=> $email,
              
              'campain_subscription'=> $month,
              'campain_price_pay'=> $price,
              'campain_date_pay'=> $datetime ),
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
}


if (isset($_POST['send-money'])) {
      # code...
         // 1 coins = 100 Frw;
        // 35 coins = 100 Frw x 35coins =3500 frw;
      $user_id= $_SESSION['key'];
      $datetime= date('Y-m-d H-i-s');
      $username= str_replace('@','',$_POST['username']);
      $price= $_POST['amount'];

      // var_dump($username,$_SESSION['username']);

      if ($_SESSION['username'] != $username && substr($_POST['username'],0,1) == '@' ) {
          # code...

      $amount_coins = $price/100;
      $amount_francs = $price;

      $row = $home->selects('users',array(
        'user_id'=> $username,
        'username'=> $username,
      ), array(
          'username'=> $username,
      ));

      if ($row['username'] === $username ) {

        $users->creates('transaction_coins',array( 
          'username_coins_to'=>  $username ,
          'user_id_coins_to'=> $row['user_id'],
          'username_coins_from'=>  $_SESSION['username'],
          'user_id_coins_from'=> $user_id,
          'amount_coins'=> $amount_coins,
          'amount_francs'=> $amount_francs,
          'comment_coins'=> 'reward coins',
          'datetime'=> $datetime));

          $home->updateQuery_money('users',array(
            'amount_coins'=> 'amount_coins - '.$amount_coins,
            'amount_francs'=> 'amount_francs - '.$price ),
            array(
              'user_id'=> $user_id,
          ));

          $insert = $home->updateQuery_money('users',array(
            'amount_coins'=> 'amount_coins + '.$amount_coins,
            'amount_francs'=> 'amount_francs + '.$price ),
            array(
              'username'=> $username,
          ));

          // var_dump($insert,$amount_coins,$price,$username);

          if($insert){
              exit('<div class="alert alert-success alert-dismissible fade show text-center">
                  <button class="close" data-dismiss="alert" type="button">
                      <span>&times;</span>
                  </button>
                  <strong>SUCCESS</strong> </div>');
          }else{
              exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                  <button class="close" data-dismiss="alert" type="button">
                      <span>&times;</span>
                  </button>
                  <strong>Fail input try again !!!</strong>
              </div>');
          }

      }else{

        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>Fail input try again !!!</strong>
             </div>');
      }

    }else{

      exit('<div class="alert alert-danger alert-dismissible fade show text-center">
              <button class="close" data-dismiss="alert" type="button">
                  <span>&times;</span>
              </button>
              <strong>You can not send back money to you Fail!!!</strong>
           </div>');
    }



}

if (isset($_POST['delete_all_coins'])) {
      # code...
      $user_id= $_SESSION['key'];
      $datetime= date('Y-m-d H-i-s');
      $delete= $users->deleteQuery('transaction_coins',array('user_id_coins_to' => $user_id));

    if($delete){
        exit('<div class="alert alert-success alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>SUCCESS</strong> </div>');
    }else{
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>Fail input try again !!!</strong>
        </div>');
    }
}

if (isset($_POST['delete_all_subscription_statement'])) {
      # code...
      $user_id= $_SESSION['key'];
      $datetime= date('Y-m-d H-i-s');
      $delete= $users->deleteQuery('subscription_statement',array('user_id_subscription' => $user_id));

    if($delete){
        exit('<div class="alert alert-success alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>SUCCESS</strong> </div>');
    }else{
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>Fail input try again !!!</strong>
        </div>');
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

    // `campain_subscription`,
    // `campain_price_pay`,
    // `campain_date_pay`,

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