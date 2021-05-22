<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['name_detail']) && !empty($_POST['name_detail'])) {
    $user_id= $_SESSION['key'];
    $user= $home->userData($_SESSION['key']);

     ?>


<div class="promote-popup">

    <div class="wrap6" id="disabler">
      <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-body">
           
            <div class="card">
                  <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                      <h1 class="display-4">Pricing</h1>
                      <p class="lead">Choose your affordable price.</p>
                  </div>

                <div class="card-body">

                    <div class="card-deck mb-3 text-center">
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Individual</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$10 <small class="text-muted">/ day</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                              <li>1 Post</li>
                              <li>Email support</li>
                              <li>Help center access</li>
                            </ul>
                            <!-- <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-promo="individual" data-user="< ?php echo $user_id; ?>">Get started </button> -->
                            <?php $details= '\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$user['user_id'].',\''.$_POST['name_detail'].'\'' ;?>
                            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="coins_recharge(12000,'weeks',<?php echo $details ;?>)" >Get started </button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Pro</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$30 <small class="text-muted">/ week</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>6 Post</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul>
                            <!-- <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-promo="pro" data-user="< ?php echo $user_id; ?>">Get started</button> -->
                            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="coins_recharge(35000,'months',<?php echo $details ;?>)" >Get started</button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Enterprise</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$60 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Unlimited Post</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul>
                            <!-- <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-promo="enterprise" data-user="< ?php echo $user_id; ?>">Get started</button> -->
                            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="coins_recharge(65000,'months',<?php echo $details ;?>)" >Get started</button>
                        </div>
                        </div>
                    </div>
                    
                    <div id="recharge-coins" class="mt-1"></div>
                </div>
                <div class="card-footer text-center">
                      <p class="mb-1"><?php echo $users->copyright(2018); ?></p>
                </div>
            </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php } 