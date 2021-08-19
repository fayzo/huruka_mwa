<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if (isset($_POST['user_id'])) {
    # code...
    $amount_coins_ = explode("=>",$_POST['amount_coins']);
    
    if ($users->coins_Available($_POST['user_id'],$amount_coins_[0]) == false) {

        echo '  <div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>No coins available in your account please deposit coins in your account and try again !!!</strong>
                </div>
                <a href="'.BALANCE.'" class="btn btn-primary btn-lg btn-block mb-2">Recharge Coins</a>
                
                ';

    }else {

        // $user_id= $_SESSION['key'];
        $username_coins_from = $_POST['username_coins_from'];
        $username_coins_to = $_POST['username_coins_to'];

        $user_id_coins_to = $_POST['user_id_coins_to'];
        $user_id_coins_from = $_POST['user_id_coins_from'];
        
        $amount_coins_ = explode("=>",$_POST['amount_coins']);
        // var_dump($amount_coins_,$amount_coins_[0]);
        
        $amount_coins = $amount_coins_[0];
        $amount_francs = $amount_coins_[1];

        $comment_coins = $_POST['comment_coins'];
        $datetime= date('Y-m-d H-i-s');
        $donate_counts= 1;

           
        if (!empty($_POST['tweet_id'])) {
            # code...
            $tweet_id= $_POST['tweet_id'];
        } else {
            $tweet_id= '';
            # code...
        }

        // $tweet_id= $_POST['tweet_id'];
        // $coins= $_POST['coins'];

            $users->creates('transaction_coins',array( 
            'username_coins_to'=>  $username_coins_to,
            'username_coins_from'=>  $username_coins_from,
            'user_id_coins_to'=> $user_id_coins_to,
            'user_id_coins_from'=> $user_id_coins_from,
            'amount_coins'=> $amount_coins,
            'amount_francs'=> $amount_francs,
            'comment_coins'=> $comment_coins,
            'datetime'=> $datetime));


            if (!empty($_POST['coins'])) {
                # code...
                $users->updateQuery_money('tweets',array( 
                    'donate_counts'=> 'donate_counts + '.$donate_counts,
                    'money_raising'=> 'money_raising + '.$amount_francs)
                    ,array('tweet_id'=> $tweet_id));
    
                $users->updateQuery_money('tweets',array( 
                    'donate_counts'=> 'donate_counts + '.$donate_counts,
                    'money_raising'=> 'money_raising + '.$amount_francs)
                    ,array('retweet_id'=> $tweet_id));

                $users->updateQuery_money('transfer_tweet',array( 
                    'donate_counts'=> 'donate_counts + '.$donate_counts,
                    'money_raising'=> 'money_raising + '.$amount_francs)
                    ,array(
                    'tweet_id_transfer' => $tweet_id,
                    'user_id_transfer'=>  $user_id_coins_to
                ));
            }

            if ($user_id_coins_to != $_SESSION['key']) {
                # code...
                $users->updateQuery_money('users',array( 
                    'amount_coins'=> 'amount_coins + '.$amount_coins,
                    'amount_francs'=> 'amount_francs + '.$amount_francs)
                    ,array('user_id'=> $user_id_coins_to));
            }

            $result= $users->updateQuery_money('users',array( 
                'amount_coins'=> 'amount_coins - '.$amount_coins,
                'amount_francs'=> 'amount_francs - '.$amount_francs)
                ,array('user_id'=> $user_id_coins_from));


            if($result){
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

}

if (isset($_POST['type_of_payment'])) {
    # code...
    $user_id = $_SESSION['key'];
    $type_of_payment = $_POST['type_of_payment'];

    if($type_of_payment == 'Bank') {

        $bank_name = $_POST['bank_name'];
        $bank_account = $_POST['bank_account'];
        $swift_number = $_POST['swift_number'];

        $update = $users->updateQuery('users',array( 
            'type_of_payment' => $type_of_payment,
            'bank_name' => $bank_name,
            'bank_account' => $bank_account,
            'swift_number' => $swift_number,
        ), array( 
            'user_id'=> $user_id
        ));

        if($update){
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

    if($type_of_payment == 'Mtn&Airtel') {
        
        $sim_account = $_POST['sim_account'];
        $sim_number = $_POST['sim_number'];

        $update = $users->updateQuery('users',array( 
            'type_of_payment' => $type_of_payment,
            'sim_account' => $sim_account,
            'sim_number' => $sim_number
        ), array( 
            'user_id'=> $user_id
        ));
        // var_dump($update);

        if($update){
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
}

if (isset($_POST['withdraw_id'])) {
    # code...
    $withdraw_id = $_POST['withdraw_id'];

    if ($_POST['status_type'] == 'update') {
        # code...
        $update = $users->updateQuery('withdraw_money',array( 
            'status_withdraw ' => 'Complete'
        ), array( 
            'withdraw_id'=> $withdraw_id
        ));
        // var_dump($update);
    }

    if ($_POST['status_type'] == 'block') {
        # code...
        $update = $users->updateQuery('withdraw_money',array( 
            'status_withdraw ' => 'block'
        ), array( 
            'withdraw_id'=> $withdraw_id
        ));
        // var_dump($update);
    }
    
    if ($_POST['status_type'] == 'remove') {
        # code...
        $update = $users->deleteQuery('withdraw_money',array( 
            'withdraw_id'=> $withdraw_id ));
        // var_dump($update);
    }
    

    if($update){
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
?>
