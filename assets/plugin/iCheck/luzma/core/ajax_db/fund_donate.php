<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){

 if ($_POST['key'] == 'donation') {
    
     $datetime= date('Y-m-d H-i-s'); // last_login 
     $date_registry= date('Y-m-d'); // date_registry 
     $firstname =  $users->test_input($_POST['firstname']);
     $lastname = $users->test_input($_POST['lastname']);
     $donate =  $users->test_input(number_format($_POST['donate'],2));
     $number =  $users->test_input($_POST['number']);
     $Sendby_firstname =  $users->test_input($_POST['Sendby_firstname']);
     $Sendby_lastname =  $users->test_input($_POST['Sendby_lastname']);
     $sent_to_user_id =  $users->test_input($_POST['sent_to_user_id']);
     $sentby_user_id =  $users->test_input($_POST['sentby_user_id']);
     $fund_id =  $users->test_input($_POST['fund_id']);
     $comment =  $users->test_input($_POST['comment']);

     if(!preg_match("/^[a-zA-Z ]*$/", $Sendby_firstname)){
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Only letters and white space allowed</strong> </div>');
    }else if(!preg_match("/^[a-zA-Z ]*$/", $Sendby_lastname)){
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Only letters and white space allowed</strong> </div>');
    }else {

      $fundraising->fundraising_donateUpdate($donate,$fund_id);

      $users->Postsjobscreates('fundraising_donation',
      array(
            'firstname' => $firstname, 
            'lastname' => $lastname, 
            'money_donate' => $donate, 
            'number_to_send' => $number, 
            'Sendby_firstname' => $Sendby_firstname, 
            'Sendby_lastname' => $Sendby_lastname, 
            'date_donate' => $date_registry, 
            'created_on3' => $datetime,
            'sent_to_user_id' => $sent_to_user_id,
            'sentby_user_id' => $sentby_user_id,
            'fund_id0' => $fund_id,
            'comment' => $comment,
      ));

     } 
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
           <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-body">


                <div class="container-fuild">

                    <div class="card">
                        <div class="card-header text-center">
                            <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                            <h4 class="card-title">Donate to Mr(s)</h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-row mt-2">
                                    <div class="col">
                                        <label for="firstname">Firstname :</label>
                                        <input type="hidden" name="sent_to_user_id" id="sent_to_user_id"
                                            value="<?php echo $user_id;?>" style="display:none" />
                                         <input type="hidden" name="sentby_user_id" id="sentby_user_id"
                                            value="<?php echo $sentby_user_id;?>" style="display:none" />
                                         <input type="hidden" name="fund_id" id="fund_id"
                                            value="<?php echo $fund_id;?>" style="display:none" />
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="firstname" id="firstname"
                                                aria-describedby="helpId" value="<?php echo $user['firstname']; ?>" placeholder="Firstname">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="lastname">Lastname :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="lastname" id="lastname"
                                                aria-describedby="helpId" value="<?php echo $user['lastname']; ?>"  placeholder="Lastname">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mt-2">
                                    <div class="col-md-6 col-sm-12">
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

                                    <div class="col-md-6 col-sm-12">
                                        <label for="lastname">Send Mobile money to This number :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-money"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="number" id="number"
                                                aria-describedby="helpId" value="MTN:*182*1*1*0782822402*amount#" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        <div class="h4">Money Gram </div>
                                        <div>Send to : Crowfundraising ltd</div>
                                        <div>pin code : RKLD04JK</div>
                                        <div>Country : Rwanda</div>
                                    </div>
                                    <div class="col">
                                        <div class=" h4">WEST UNION </div>
                                        <div>Send to : Crowfundraising ltd</div>
                                        <div>pin code : RKLD04JK</div>
                                        <div>Country : Rwanda</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="h4 mt-3">Send By </div>
                                <div class="form-row mt-2 mb-2">

                                    <div class="col">
                                        <label for="firstname">Firstname :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="Sendby_firstname" id="sendby_firstname"
                                                aria-describedby="helpId" value="<?php echo $user0['firstname']; ?>" placeholder="Firstname">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="lastname">Lastname :</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="Sendby_lastname" id="sendby_lastname"
                                                aria-describedby="helpId" value="<?php echo $user0['lastname']; ?>"  placeholder="Lastname">
                                        </div>
                                    </div>
                                </div>
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

                                    <button type="button" onclick="donateCrowfund('donation');" class="btn main-active btn-block"><b>Submit</b></button>
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
        var firstname = $("#firstname");
        var lastname = $("#lastname");
        var donate = $("#donate");
        var number = $("#number");
        var Sendby_firstname = $("#sendby_firstname");
        var Sendby_lastname = $("#sendby_lastname");
        var sent_to_user_id = $("#sent_to_user_id");
        var sentby_user_id = $("#sentby_user_id");
        var fund_id = $("#fund_id");
        var comment = $("#Comment");
        //   use 1 or second method to validaton

        if (isEmpty(firstname) && isEmpty(lastname) && isEmpty(donate) && isEmpty(number) &&
         isEmpty(Sendby_firstname) && isEmpty(Sendby_lastname) && isEmpty(comment)) {
            //    alert("complete register");
            $.ajax({
                url: "core/ajax_db/fund_donate.php",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    firstname: firstname.val(),
                    lastname: lastname.val(),
                    donate: donate.val(),
                    number: number.val(),
                    Sendby_firstname: Sendby_firstname.val(),
                    Sendby_lastname: Sendby_lastname.val(),
                    sent_to_user_id: sent_to_user_id.val(),
                    sentby_user_id: sentby_user_id.val(),
                    fund_id: fund_id.val(),
                    comment: comment.val(),
                },
                success: function(response) {
                           console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        $("#response").html(response);
                        setInterval(() => {
                            // window.location = 'include/login.php';
                        }, 2000);
                        //  setInterval(() => {
                        //     location.reload();
                        // }, 2000);
                    }else if (response.indexOf('Fail') >= 0) {
                        $("#response").html(response);
                    }else{
                        isEmptys(Sendby_firstname) || isEmptys(Sendby_lastname)
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
