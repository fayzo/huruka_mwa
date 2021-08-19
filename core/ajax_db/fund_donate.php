<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){

 if ($_POST['key'] == 'fund_donation') {

    // $user_id= $_SESSION['key'];
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else{
        $user_id = 1;
    }
    
     $datetime= date('Y-m-d H-i-s'); // last_login 
     $date_registry= date('Y-m-d'); // date_registry 
     $name = $users->test_input($_POST['name']);
     $email = $users->test_input($_POST['email']);
     $subscription = $users->test_input($_POST['subscription']);

    //  $donate =  $users->test_input(number_format($_POST['donate'],2));
     $donate =  $users->test_input($_POST['amount']);
     $number =  $users->test_input($_POST['number']);
     $sent_to_user_id =  $users->test_input($_POST['sent_to_user_id']);
     $sentby_user_id =  $users->test_input($_POST['sentby_user_id']);
     $fund_id =  $users->test_input($_POST['fund_id']);
     $comment =  $users->test_input($_POST['comment']);
     $donate_counts = 1;

    $amount_coins = $donate/100;

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

        if (!empty($_POST['visa']) && $_POST['visa'] == 'coins') {

            $query = "INSERT INTO subscription_statement (`subscription`,`user_id_subscription`, `name_subscription_`, `email_subscription_`, `month_subscription_`, `price_subscription_`, `date_subscription_`) 
            VALUES ('{$subscription}','{$user_id}','{$name}','{$email}','month','{$donate}','{$datetime}')";
            $result = $db->query($query);

                //   $fundraising->fundraising_donateUpdate($donate,$fund_id);
                
            $amount_coins= $donate/100 ;

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

        }else {
            echo '  <div class="alert alert-danger alert-dismissible fade show text-center">
                        <button class="close" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>Choose Any Type Of Payment you want To Donate !!!</strong>
                    </div>  ';
        }


        }
    }
}

if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else{
        $user_id = 1;
    }

    $fund_id = $_REQUEST['fund_id'];
    $user_id = $_REQUEST['user_id'];
    $user = $home->userData($user_id);
    $sentby_user_id = $user_id;
    $user0 = $home->userData($sentby_user_id);
    $fund = $crowfund->fundFecthReadmore($fund_id,$user_id);

?>
<div class="donate-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
           <div class="img-popup-wrap"  id="popupEnd" style="max-width: 500px;">
        	<div class="img-popup-body">


                <div class="container-fuild">

                    <div class="card">
                        <div class="card-header text-center">
                            <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                            <h4 class="card-title">Donate to Mr(s) <?php echo $user['username']; ?></h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-row mt-2">
                                    <div class="col">
                                        <!-- <label for="firstname">Firstname :</label> -->
                                        <input type="hidden" name="sent_to_user_id" id="sent_to_user_id"
                                            value="<?php echo $user_id;?>" style="display:none" />
                                         <input type="hidden" name="sentby_user_id" id="sentby_user_id"
                                            value="<?php echo $sentby_user_id;?>" style="display:none" />
                                         <input type="hidden" name="fund_id" id="fund_id"
                                            value="<?php echo $fund_id;?>" style="display:none" />
                                         <input type="hidden" name="email" id="email"
                                            value="<?php echo $user0['email'];?>" style="display:none" />
                                    </div>
                                </div>

                                <span><?php echo number_format($fund['money_raising']).' Frw Raised out of<span class="float-right text-right"> '.number_format($fund['money_to_target']).' Frw <span class="text-success">Goal </span></span>'; ?>  </span>
                                <div class="progress " style="height: 10px;">
                                    <?php echo $users->Users_donationMoneyRaising($fund['money_raising'],$fund['money_to_target']); ?>
                                    <!-- <div class="progress-bar  bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> -->
                                </div>
                                <p>Raised by <?php echo $fund['donate_counts']; ?> people in <?php echo $users->timeAgo($fund['created_on2']);?> <span class="float-right text-right"><?php echo $users->donationPercetangeMoneyRaimaing($fund['money_raising'],$fund['money_to_target']); ?> /100 %</span></p>
                                <hr>
                                
                                <div class="text-center mb-3"> <span class="mb-2"> Choose Type Of Payment you want To Donate </span><br>
                                <hr>
                                        <span style="font-size:13px;margin-top:10px">
                                        <i class="fas fa-coins text-warning"></i> You have
                                        <?php echo number_format($user0['amount_coins']); ?> coins ~ 
                                        <?php echo number_format($user0['amount_francs']); ?> Frw
                                    </span>
                                </div>
                                <hr>
                                <script>
                                    $('input[type="checkbox"]').on('change', function() {
                                        $('input[type="checkbox"]').not(this).prop('checked', false).attr('id','').attr('name','');
                                        $(this).prop('checked', true).attr('id','visa').attr('name','visa');
                                    });
                                </script>
                                <div class="row mb-3 text-center">

                                <?php if (isset($_SESSION['key'])) { ?>
                                    <div class="col-4">
                                    <label class="form-check-label">
                                        <input class="form-check-input ml-1" type="checkbox" name="visa" id="visa" value="coins"> 
                                        <!-- <i class="fas fa-coins" style="font-size:100px;"></i> -->
                                        <span class="fa" style="margin-top: 10px;font-weight: 800;background: #333333;color: white;font-family: sans-serif;border-radius: 10px;padding: 20px 10px;font-size: 30px;">Coins</span>
                                        <!-- <i class="fas fa-donate" style="font-size:100px;"></i> -->
                                    </label>
                                    </div>
                                <?php } ?>
                                
                                    <div class="col-4">
                                    <label class="form-check-label">
                                        <input class="form-check-input ml-1" type="checkbox" name="visa" id="visa" value="visa"> 
                                        <!-- <i class="fab fa-cc-visa" style="font-size:100px;"></i> -->
                                        <span class="fa" style="margin-top: 10px;font-weight: 800;background: #333333;color: white;font-family: sans-serif;border-radius: 10px;padding: 20px 10px;font-size: 30px;">Visa</span>
                                        <!-- <i class="fab fa-cc-mastercard" style="font-size:100px;"></i> -->
                                    </label>
                                    </div>
                                    <div class="col-4">
                                    <label class="form-check-label">
                                        <input class="form-check-input ml-1" type="checkbox" name="visa" id="visa" value="visa"> 
                                        <span class="fa" style="margin-top: 10px;font-weight: 800;background: #333333;color: white;font-family: sans-serif;border-radius: 10px;padding: 20px 10px;font-size: 30px;">MTN</span>
                                        <!-- <i class="fab fa-cc-mastercard" style="font-size:100px;"></i> -->
                                    </label>
                                    </div>
                                </div>
                                        
                                <div class="form-row mt-2">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="donate">How much you will donate :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">Frw
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" name="donate" id="donate"
                                                aria-describedby="helpId"   placeholder="donate ">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mt-2 mb-2">

                                    <div class="col">
                                            <input type="hidden" class="form-control" name="Sendby_firstname" id="sendby_firstname"
                                                aria-describedby="helpId" value="<?php echo $user0['firstname']; ?>" placeholder="Firstname">
                                    </div>
                                    <div class="col">
                                            <input type="hidden" class="form-control" name="Sendby_lastname" id="sendby_lastname"
                                                aria-describedby="helpId" value="<?php echo $user0['lastname']; ?>"  placeholder="Lastname">
                                    </div>
                                </div>

                                <!-- <div class="h4 mt-3">Send By </div> -->
                                 <div class="form-row mt-2 mb-2">
                                    <div class="col">
                                        <label for="lastname">Comment :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-pencil"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="Comment" id="Comment" maxlength="200"
                                                aria-describedby="helpId" value=""  placeholder="Write something as motivate or anything ">
                                        </div>
                                    </div>
                                </div>
                                    <div id="response"></div>

                                    <button type="button" onclick="donateCrowfund('fund_donation');" class="btn main-active btn-block"><b>Submit</b></button>
                                    <div class="mb-2 response  mt-1" id="recharge-coins"></div>
                            </form>
                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- container-body -->
                
             </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<script>

 function donateCrowfund(key) {
        var donate = $("#donate");
        var email = $("#email");
        var Sendby_firstname = $("#sendby_firstname");
        var Sendby_lastname = $("#sendby_lastname");
        var sent_to_user_id = $("#sent_to_user_id");
        var sentby_user_id = $("#sentby_user_id");
        var fund_id = $("#fund_id");
        var comment = $("#Comment");
        // var visa = $("#visa").is(":checked");
        // var visa = $("#visa").prop("checked");
        var visa = $("input[name='visa']:checked");

        //   use 1 or second method to validaton

        if (isEmpty(donate) && isEmpty(comment)) {
            //    alert("complete register");

            if (visa.val() == 'coins') {

            $.ajax({
                url: "core/ajax_db/fund_donate.php",
                // url: 'core/ajax_db/test',
                method: "POST",
                dataType: "text",
                data: {
                    pay: 'pay',
                    key: key,
                    subscription: key,
                    description: key,
                    month: 'day',
                    number: '',
                    amount: donate.val(),
                    name: Sendby_firstname.val() +' '+ Sendby_lastname.val(),
                    email: email.val(),
                    // user_id: sentby_user_id.val(),

                    sent_to_user_id: sent_to_user_id.val(),
                    sentby_user_id: sentby_user_id.val(),

                    fund_id: fund_id.val(),
                    comment: comment.val(),
                    visa: visa.val(),
                },
                success: function(response) {
                        console.log(response);
                        // if (objJSON.status == "success") {

                            if (response.indexOf('SUCCESS') >= 0) {
                            // $('#recharge-coins').html(objJSON.status);
                        // $(".response_coins").html(objJSON.status).css({"color":"red"});
                        

                            $('#recharge-coins').html(response);
                            $(".response_coins").html(response).css({"color":"red"});;

                            setTimeout(() => {
                                $(".donate-popup").hide();
                                $(".promote-popup").hide();
                                $("#checkOUT").modal('show');
                                $("#checkOUT").delay(2000).fadeOut(450);

                                 // window.open(objJSON.data.link, '_blank');
                                  // window.location = objJSON.data.link;
                            }, 2000);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);
                            setTimeout(() => {
                                location.reload();
                            }, 4000);
                            console.log(response);
                            
                        } else{
                            // $('#recharge-coins').html(objJSON.status);

                            isEmptys(visa)  || isEmptys(donate) || isEmptys(comment);

                            $('#recharge-coins').html(response);

                            $("#checkOUT").modal('show').css({"z-index":"20000"});
                            $('#change-check').removeClass('fa fa-check-circle-o')
                            .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                            $('#html-check').html('We can not process your payment is to low !!!').css({"text-align":"center"});
                            $("#checkOUT").delay(2000).fadeOut(450);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);

                        }
                    }
            });

            }else if (visa.val() == 'visa') {


            $.ajax({
                // url: "core/ajax_db/fund_donate.php",
                url: 'flutter/pay',
                method: "POST",
                dataType: "text",
                data: {
                    pay: 'pay',
                    key: key,
                    subscription: key,
                    description: key,
                    month: 'day',
                    number: '',
                    amount: donate.val(),
                    name: Sendby_firstname.val() +' '+ Sendby_lastname.val(),
                    email: email.val(),
                    // user_id: sentby_user_id.val(),

                    sent_to_user_id: sent_to_user_id.val(),
                    sentby_user_id: sentby_user_id.val(),

                    fund_id: fund_id.val(),
                    comment: comment.val(),
                    visa: visa.val(),
                },
                success: function(response) {
                    var objJSON = JSON.parse(response);
                    // console.log(objJSON.status,objJSON.data.link);
                    // console.log(response);

                      if (objJSON.status == "success") {
                        // if (response.indexOf('SUCCESS') >= 0) {

                            $('#recharge-coins').html('<div class="alert alert-success alert-dismissible fade show text-center">'+
                            '<button class="close" data-dismiss="alert" type="button">'+
                            '<span>&times;</span>'+
                            '</button>'+
                            '<strong>SUCCESS REDIRECT TO ANOTHER PAGE</strong> </div>');

                            $(".response_coins").html(objJSON.status).css({"color":"red"});
                        

                            // $('#recharge-coins').html(response);
                            // $(".response_coins").html(response).css({"color":"red"});

                            setTimeout(() => {
                                // $(".donate-popup").hide();
                                // $(".promote-popup").hide();
                                // $("#checkOUT").modal('show');
                                // $("#checkOUT").delay(2000).fadeOut(450);

                                   window.open(objJSON.data.link, '_blank');
                                  // window.location = objJSON.data.link;
                            }, 1000);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);
                            setTimeout(() => {
                                location.reload();
                            }, 8000);
                            // console.log(response);
                            
                        } else{
                            // $('#recharge-coins').html(response);
                            // $('#recharge-coins').html(objJSON.status);
                            
                            $('#recharge-coins').html('<div class="alert alert-success alert-dismissible fade show text-center">'+
                            '<button class="close" data-dismiss="alert" type="button">'+
                            '<span>&times;</span>'+
                            '</button>'+
                            '<strong>FAIL TO REDIRECT TRY AGAIN</strong> </div>');

                            isEmptys(visa)  || isEmptys(donate) || isEmptys(comment);

                            $("#checkOUT").modal('show').css({"z-index":"20000"});
                            $('#change-check').removeClass('fa fa-check-circle-o')
                            .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                            $('#html-check').html('We can not process your payment is to low !!!').css({"text-align":"center"});
                            $("#checkOUT").delay(2000).fadeOut(450);
                            setTimeout(() => {
                                $("#checkOUT").modal('hide');
                            }, 3500);

                        }
                    }
            });
            
            }else{
                
                $('#recharge-coins').html(
                '<div class="alert alert-danger alert-dismissible fade show text-center">'+
                    '<button class="close" data-dismiss="alert" type="button"><span>&times;</span></button>'+
                    '<strong>Choose Any Type Of Payment you want To Donate !!!</strong>'+
                '</div>');
            }
        }
    }

    
    function thankFordonation() { 
          $.ajax({
            url: "core/ajax_db/crowfund_thankFordonation.php",
            method: "POST",
            dataType: "text",
            data: {
                login_id: '1',
            },
            success: function(response) {
                    $(".popupTweet").html(response);
                    $(".close-imagePopup").click(function () {
                        $(".login-popup").hide();
                    });
                }
        });
    }
</script>

<?php } 
