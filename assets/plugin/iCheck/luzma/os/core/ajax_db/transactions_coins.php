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

        $amount_coins = $amount_coins_[0];
        $amount_francs = $amount_coins_[1];

        $comment_coins = $_POST['comment_coins'];
        $datetime= date('Y-m-d H-i-s');

            $users->creates('transaction_coins',array( 
            'username_coins_to'=>  $username_coins_to,
            'username_coins_from'=>  $username_coins_from,
            'user_id_coins_to'=> $user_id_coins_to,
            'user_id_coins_from'=> $user_id_coins_from,
            'amount_coins'=> $amount_coins,
            'amount_francs'=> $amount_francs,
            'comment_coins'=> $comment_coins,
            'datetime'=> $datetime));

            $users->updateQuery_money('users',array( 
                'amount_coins'=> 'amount_coins + '.$amount_coins,
                'amount_francs'=> 'amount_francs + '.$amount_francs)
                ,array('user_id'=> $user_id_coins_to));

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


?>
