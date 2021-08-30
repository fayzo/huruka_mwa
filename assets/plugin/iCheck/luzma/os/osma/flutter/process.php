<?php 
include('../core/init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Transaction</title>
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
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/skins/_all-skins.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/main.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/background.css">

</head>
<body class="hold-transition fixed sidebar-collapse skin-blue ">
<div class="wrapper">

    <header class="main-header">
        <a href="<?php echo HOME; ?>" class="logo" style="width:100%;float:none">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
            <img src="<?php echo BASE_URL_LINK.'image/img/irangiro-irg.png'; ?>">
            <b>irangiro </b></span>
            <!-- <b>irangiro </b>IRG</span> -->
         </a>
    </header>

    <div class="content-wrapper">
        <div class="content-wrapper chair ">
<?php

    if(isset($_GET['status']))
    {
        //* check payment status
        if($_GET['status'] == 'cancelled')
        {
            // echo 'YOu cancel the payment';
            echo "<script>window.close();</script>";
            // header('Location: '.HOME.'');
        }
        elseif($_GET['status'] == 'successful')
        {
            $txid = $_GET['transaction_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK-7f609337676e8f929afa61d988c1838c-X"
                ),
              ));
              
              $response = curl_exec($curl);
              
              curl_close($curl);
              
              $res = json_decode($response);
            //   var_dump($res);

              if($res->status == 'success')
              {
                $amountPaid = $res->data->charged_amount;
                $amountToPay = $res->data->meta->price;
                if($amountPaid >= $amountToPay)
                {
                    echo '<div class="container">
                            <div class="row">
                                <div class="col-md-3 d-none d-md-block">
                                    
                                </div>
                                <div class="col-md-6 ">
                                
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <i id="change-check" class="fa fa-check-circle-o" style="font-size:200px;color: green;" aria-hidden="true"></i>
                                            <p id="html-check">SUCCESS Payment </p>
                                        </div>
                                    </div>
                               ';

                        //  var_dump($res);

                        $name= $res->data->customer->name;
                        $email= $res->data->customer->email;
                        $subscription = $_SESSION['description'];
                        // $subscription = $res->data->customizations->description;
                        // $title = $res->data->customizations->title;
                        $price = $res->data->meta->price;
                        $amount_coins = $price/100;
                        
                        // $subscription = 'buy_coins';
                        if (isset($_SESSION['key'])) {
                            # code...
                            $user_id= $_SESSION['key'];
                        }else{
                            $user_id = 1;
                        }
                        
                        $datetime= date('Y-m-d H-i-s');
                        $month= 'day';

                        $donate =  $price;
                        $number =  $res->data->customer->phone_number;
                        $sentby_user_id =  $user_id;
                        $donate_counts = 1;
                        
                        if ($subscription == 'buy_coins') {
                          
                            # code...
                            $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
                            VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','day','{$price}','{$datetime}')";
                            $result = $db->query($query);

                            $users->updateQuery_money('users',array( 
                            'amount_coins'=> 'amount_coins + '.$amount_coins,
                            'amount_francs'=> 'amount_francs + '.$price ),
                            array(
                                'user_id'=> $user_id,
                            ));
                    
                            $users->updateQuery_coins('subscription',array( 
                            'subscription'=> $subscription,
                            'user_id_subscription'=> $user_id,
                            'name_subscription'=> $name,
                            'email_subscription'=> $email,
                    
                            'coins_subscription'=> $month,
                            'coins_price_pay'=> $price,
                            'coins_date_pay'=> $datetime ),
                            array(
                                'user_id_subscription'=> $user_id,
                            ));

                            session_unset($subscription);

                        }

                        if ($subscription == 'crowfund_donation') {
                            # code...

                            $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
                            VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','month','{$donate}','{$datetime}')";
                            $result = $db->query($query);
            
                                //   $fundraising->fundraising_donateUpdate($donate,$fund_id);
                                
                            $amount_coins= $donate/100 ;

                            $sent_to_user_id =  $_SESSION['sent_to_user_id'];
                            $fund_id =  $_SESSION['fund_id'];
                            $comment =  $_SESSION['comment'];
            
                            $result= $users->updateQuery_money('users',array( 
                                'amount_coins'=> 'amount_coins - '.$amount_coins,
                                'amount_francs'=> 'amount_francs - '.$donate)
                                ,array('user_id'=> $user_id));
            
            
                            //  $fundraising->fundraising_donateUpdate($donate,$fund_id);
                            $users->updateQuery_money('crowfundraising',array( 
                                'donate_counts'=> 'donate_counts + '.$donate_counts,
                                'money_raising'=> 'money_raising + '.$donate)
                                ,array('fund_id'=> $fund_id));
            
                            $users->updateQuery_money('transfer_crowfundraising',array( 
                                'donate_counts'=> 'donate_counts + '.$donate_counts,
                                'money_raising'=> 'money_raising + '.$donate)
                                ,array(
                                'fund_id_transfer' => $fund_id,
                                'user_id_transfer'=>  $sentby_user_id
                                ));
            
            
                            $users->Postsjobscreates('crowfund_donation',
                            array(
            
                                'name_fund' => $name, 
                                'email_fund' => $email, 
                                'price_donate' => $donate, 
                                'number_sent' => $number, 
                                'fund_subscription' => $subscription, 
                                'created_on3' => $datetime,
                                'sent_to_user_id' => $sent_to_user_id,
                                'sentby_user_id' => $sentby_user_id,
                                'fund_id0' => $fund_id,
                                'comment' => $comment,
                            ));


                            session_unset($sent_to_user_id);
                            session_unset($fund_id);
                            session_unset($comment);
                
                        }

                        if ($subscription == 'fund_donation') {

                            $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
                            VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','month','{$donate}','{$datetime}')";
                            $result = $db->query($query);
                
                                //   $fundraising->fundraising_donateUpdate($donate,$fund_id);
                                
                            $amount_coins= $donate/100 ;
                            $sent_to_user_id =  $_SESSION['sent_to_user_id'];
                            $fund_id =  $_SESSION['fund_id'];
                            $comment =  $_SESSION['comment'];

                            $result= $users->updateQuery_money('users',array( 
                                'amount_coins'=> 'amount_coins - '.$amount_coins,
                                'amount_francs'=> 'amount_francs - '.$donate)
                                ,array('user_id'=> $user_id));
                
                            # code...
                            $users->updateQuery_money('fundraising',array( 
                                'donate_counts'=> 'donate_counts + '.$donate_counts,
                                'money_raising'=> 'money_raising + '.$donate)
                                ,array('fund_id'=> $fund_id));
                
                            $users->updateQuery_money('transfer_fundraising',array( 
                                'donate_counts'=> 'donate_counts + '.$donate_counts,
                                'money_raising'=> 'money_raising + '.$donate)
                                ,array(
                                'fund_id_transfer' => $fund_id,
                                'user_id_transfer'=>  $sent_to_user_id
                                ));
                
                            $users->Postsjobscreates('fundraising_donation',
                            array(
                
                                    'name_fund' => $name, 
                                    'email_fund' => $email, 
                                    'price_donate' => $donate, 
                                    'number_sent' => $number, 
                                    'fund_subscription' => $subscription, 
                                    'created_on3' => $datetime,
                                    'sent_to_user_id' => $sent_to_user_id,
                                    'sentby_user_id' => $sentby_user_id,
                                    'fund_id0' => $fund_id,
                                    'comment' => $comment,
                            ));


                            
                            session_unset($sent_to_user_id);
                            session_unset($fund_id);
                            session_unset($comment);
                            session_unset($subscription);
                        }
                          
                echo ' </div>
                        <div class="col-md-3 d-none d-md-block">
                            
                        </div>
                    </div>
                </div>';

                    //* Continue to give item to the user

                    // echo "<script> setTimeout(() => {
                    //     window.close();
                    // }, 5000);</script>";
                }
                else
                {
                    echo '<div class="container">
                                <div class="row">
                                    <div class="col-md-3 d-none d-md-block">
                                        
                                    </div>
                                    <div class="col-md-6 ">
                                    
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <i id="change-check" class="fa fa-check-circle-o" style="font-size:200px;color: green;" aria-hidden="true"></i>
                                                <p id="html-check">Fraud transaction detected</p>
                                            </div>
                                        </div>
                            
                                    </div>
                                    <div class="col-md-3 d-none d-md-block">
                                        
                                    </div>
                                    
                                </div>
                            </div>';

                            session_unset($sent_to_user_id);
                            session_unset($fund_id);
                            session_unset($comment);
                            session_unset($subscription);
                }
              }
              
            }
            else
            {
                echo '<div class="container">
                          <div class="row">
                              <div class="col-md-3 d-none d-md-block">
                                  
                              </div>
                              <div class="col-md-6 ">
                              
                                  <div class="card">
                                      <div class="card-body text-center">
                                          <i id="change-check" class="fa fa-times" style="font-size:200px;color:red";" aria-hidden="true"></i>
                                          <p id="html-check">We can not process your payment</p>
                                      </div>
                                  </div>
                      
                              </div>
                              <div class="col-md-3 d-none d-md-block">
                                  
                              </div>
                              
                          </div>
                      </div>';

                      session_unset($sent_to_user_id);
                      session_unset($fund_id);
                      session_unset($comment);
                      session_unset($subscription);
            }
    }
?>

        </div>
    </div>
 <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.01
      </div>
      <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://irangiro.com">irangiro</a>.</strong> All rights
      reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
    
</div>
<!-- ./wrapper -->

  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.form.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>

<script>
</script>
</body>
</html>
