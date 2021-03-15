<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['key'])) {
    if($_POST['key'] == 'individual'|| $_POST['key'] == 'SME') {
  $conn = $db;
  $job_user = $conn->real_escape_string($_POST['key']);
  $username = $conn->real_escape_string($_POST['username']);
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);
  $datetime= date('Y-m-d H-i-s');

  $users->jobsPosterlogin($job_user,$username,$email,$password,$datetime);

  } 
} 

if (isset($_POST['post_as']) && !empty($_POST['post_as'])) {
    // $user_id= $_SESSION['key'];
     ?>
<div class="jobs-popup">
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin"  id="popupEnd" >
        	<div class="img-popup-bodys">

          <div class="card borders-bottoms">
              <div class="card-header text-center">
                  <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                  <h5><i>Are you as ?</i> </h5>
              </div>
              <div class="card-body">
                <div class="row">

                      <div class="col-6">
                          <div class="card borders-tops text-center shadow-lg more  loginTerms">
                            <div>
                              <!-- <i class="fa fa-building-o" style="width:200px;" aria-hidden="true"></i> -->
                            <img class="img-fluid mt-3 rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/business_.png" width="200px" heght="200px">
                            </div>
                            <div class="card-body">
                              <a href="javascript:void(0);" class="h4  loginTerms">SME</a>
                              <p class="card-text">Public or Private organization, SME</p>
                            </div>
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="card borders-tops text-center shadow-lg more loginTerms0">
                            <div><img class="img-fluid mt-3 rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/empty-profile.png" width="200px" heght="200px"></div>
                            <div class="card-body">
                              <a href="javascript:void(0);" class="h4 loginTerms0">An Individual</a>
                              <p class="card-text">As individual </p>
                            </div>
                          </div>
                      </div>
                    
                  </div> <!-- row -->
              </div> <!-- card-body -->
              <div class="card-footer text-center">
                      <p class="mb-1"><?php echo $users->copyright(2018); ?></p>
                </div>
            </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php }

if (isset($_POST['loginTerms']) && !empty($_POST['loginTerms'])) {
	  $user= $home->userData($_SESSION['key']);
  ?>

  <div class="jobs-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin" id="popupEnd" style="max-width: 439px;">
        	<div class="img-popup-body">

        <div class="card">
        <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

          <div class="card-body">

          <form class="form-signin">
            <h4 class="h4 mb-3  text-center font-weight-normal">Please sign in As SME <br> Public / Private Organization</h4>
            <div class="form-group">
              <label for="inputEmail" class="sr-only">Username</label>
              <input type="text" id="Username" class="form-control mb-3" placeholder="Username" >
            </div>

              <label for="inputEmail" class="sr-only">Email address</label>
              <input class="form-control mb-3"
               placeholder="<?php 
                    if (strlen($user["email"]) > 5) {
                      echo substr($user["email"],0,5).'****@******.com';
                    }else{
                      echo $user["email"];
                    } ?> " readonly>
              <input type="hidden" id="inputEmail" class="form-control mb-3"
                value="<?php echo $user["email"];?> ">

              <label for="inputPassword" class="sr-only">Password</label>
              <input type="text" id="inputPassword" class="form-control mb-3" placeholder="Password" >

            <button class="btn btn-lg btn-primary btn-block mb-3" onclick="jobsLogin('SME');" type="button">Sign in</button>
            <!-- or <button class="btn btn-lg btn-primary btn-sm mb-1" id="helper-family" type="button">Sign up</button>  -->
            <div class=" text-center h4" id='response'></div>
            <p class="mt-5 mb-3  text-center  text-muted"><?php echo $users->copyright(2018); ?></p>
          </form>

           </div>
           </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->


<?php }

if (isset($_POST['loginTerms0']) && !empty($_POST['loginTerms0'])) {
    $user= $home->userData($_SESSION['key']);
  ?>
  <div class="jobs-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>

        <div class="img-popup-wrapLogin" id="popupEnd" style="max-width: 439px;">
        	<div class="img-popup-body">

        <div class="card">
          <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

          <div class="card-body">

          <form class="form-signin">
            <h3 class="h3 mb-3 text-center font-weight-normal">Please sign in As Individual</h3>
            <div class="form-group">
              <label for="inputEmail" class="sr-only">Username</label>
              <input type="text" id="Username" class="form-control mb-3" placeholder="Username" >
            </div>

              <label for="inputEmail" class="sr-only">Email address</label>
               <input class="form-control mb-3"
               placeholder="<?php 
                    if (strlen($user["email"]) > 5) {
                      echo substr($user["email"],0,5).'****@******.com';
                    }else{
                      echo $user["email"];
                    } ?> " readonly>

              <input type="hidden" id="inputEmail" class="form-control mb-3"
                value="<?php echo $user["email"];?> ">

              <label for="inputPassword" class="sr-only">Password</label>
              <input type="text" id="inputPassword" class="form-control mb-3" placeholder="Password" >

            <button class="btn btn-lg btn-primary btn-block mb-3" onclick="jobsLogin('individual');" type="button">Sign in</button> 
            <!--or <button class="btn btn-lg btn-primary btn-sm mb-1" id="job-helper" type="button">Sign up</button>  -->
            <div class=" text-center h4" id='response'></div>
            <p class="mt-5 mb-3  text-center  text-muted"><?php echo $users->copyright(2018); ?></p>
          </form>

           </div>
           </div>

        
           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php }

if (isset($_POST['post_jobs']) && !empty($_POST['post_jobs'])) {
    $user_id= $_SESSION['key'];
     ?>

<div class="jobs-popup">
    <div class="wrap6">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap">
        	<div class="img-popup-body">
           
                <div class="card">
                  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                      <h1 class="display-4">Pricing</h1>
                      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
                  </div>

                <div class="card-body">

                    <div class="card-deck mb-3 text-center">
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Free</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>10 users included</li>
                            <li>2 GB of storage</li>
                            <li>Email support</li>
                            <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary payment-job" data-user="<?php echo $user_id; ?>">Sign up for free</button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Pro</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>20 users included</li>
                            <li>10 GB of storage</li>
                            <li>Priority email support</li>
                            <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-user="<?php echo $user_id; ?>">Get started</button>
                        </div>
                        </div>
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Enterprise</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary payment-job" data-user="<?php echo $user_id; ?>">Contact us</button>
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
if (isset($_POST['payment_jobs_jobs']) && !empty($_POST['payment_jobs_jobs'])) {
    $user_id= $_POST['user'];
     ?>

<div class="jobs-popup">
    <div class="wrap6">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap">
        	<div class="img-popup-body">


            
            <div class="card">
              <div class="py-5 text-center">
                  <img class="d-block mx-auto mb-4" src="{{ site.baseurl }}/docs/{{ site.docs_version }}/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                  <h2>Checkout form</h2>
                  <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
              </div>
                <div class="card-body">

                
<div class="container">


  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <div class="card mb-4 shadow-lg text-center">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Enterprise</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                <li>30 users included</li>
                <li>15 GB of storage</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="Username" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="credit">Credit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="debit">Debit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="paypal">PayPal</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">
              Security code required
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
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