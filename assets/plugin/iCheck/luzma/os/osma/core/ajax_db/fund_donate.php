<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){

 if ($_POST['key'] == 'fund_donation') {
    
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

    //   $fundraising->fundraising_donateUpdate($donate,$fund_id);

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

  }
}

if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
    $fund_id = $_REQUEST['fund_id'];
    $user_id = $_REQUEST['user_id'];
    $user = $home->userData($user_id);
    $sentby_user_id = $_SESSION['key'];
    $user0 = $home->userData($sentby_user_id);
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
                            <h4 class="card-title">Donate to Mr(s) <?php echo $user['lastname']; ?></h4>
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
                                    <div class="mb-2" id="respone-success"></div>
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
        //   use 1 or second method to validaton

        if (isEmpty(donate) && isEmpty(comment)) {
            //    alert("complete register");
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
                    user_id: sentby_user_id.val(),

                    sent_to_user_id: sent_to_user_id.val(),
                    sentby_user_id: sentby_user_id.val(),

                    fund_id: fund_id.val(),
                    comment: comment.val(),
                },
                success: function(response) {
                        console.log(response);
                        $(".donate-popup").hide();
                    if (response.indexOf('SUCCESS') >= 0) {
                        $("#response").html(response);
                        // setInterval(() => {
                        //     // window.location = 'include/login.php';
                        // }, 2000);
                        $.ajax({
                            // url: 'flutter/pay',
                            url: 'core/ajax_db/test',
                            method: 'POST',
                            dataType : "text",
                            // contentType: "application/json",
                            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                            data: {
                                pay: 'pay',
                                subscription: key,
                                description: key,
                                month: 'day',
                                amount: donate.val(),
                                name: Sendby_firstname.val() +' '+ Sendby_lastname.val(),
                                email: email.val(),
                                user_id: sentby_user_id.val(),
                            },
                            success: function (response) {
                                // var  objJSON = JSON.parse(response);
                                // console.log(objJSON.status,objJSON.data.link);
                                // if (objJSON.status == "success") {
                                $(".promote-popup").hide();

                                if (response.indexOf('SUCCESS') >= 0) {
                                    // window.open(objJSON.data.link, '_blank');
                                    // window.location.href = objJSON.data.link;
                                    // window.location = objJSON.data.link;
                                    // location.reload();
                                    $("#checkOUT").modal('show');
                                    $("#checkOUT").delay(2000).fadeOut(450);
                                    setTimeout(() => {
                                        $("#checkOUT").modal('hide');
                                    }, 1500);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                    console.log(response);
                                    
                                } else{

                                    $("#checkOUT").modal('show');
                                    $('#change-check').removeClass('fa fa-check-circle-o')
                                    .addClass('fa fa-times').css({"color":"red","font-size":"200px"});
                                    $('#html-check').html('We can not process your payment').css({"text-align":"center"});
                                    $("#checkOUT").delay(2000).fadeOut(450);
                                    setTimeout(() => {
                                        $("#checkOUT").modal('hide');
                                    }, 1500);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                }
                            }
                        });
                        //  setInterval(() => {
                        //     location.reload();
                        // }, 2000);
                    }else if (response.indexOf('Fail') >= 0) {
                        $("#response").html(response);
                    }else{
                        isEmptys(donate) || isEmptys(comment)
                    }
                }
            });
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
