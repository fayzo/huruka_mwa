<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['promote_post']) && !empty($_POST['promote_post'])) {
    $user_id= $_SESSION['key'];
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
                            <h4 class="my-0 font-weight-normal">Basic</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title">$10 <small class="text-muted">/ mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                              <li>1 Post last 2 week</li>
                              <li>Reach 5,000 people</li>
                              <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-user="<?php echo $user_id; ?>">Get started </button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Silver</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title">$35 <small class="text-muted">/ mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>1 Post last 5 week</li>
                                <li>Reach 10,000 people</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-user="<?php echo $user_id; ?>">Get started</button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Gold</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title">$100 <small class="text-muted">/ mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>1 Post last 4 Months</li>
                                <li>Reach 50,000 people</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-user="<?php echo $user_id; ?>">Get started</button>
                        </div>
                        </div>
                    </div>


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