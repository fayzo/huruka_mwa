
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' Your Balance'; ?></title>

<!-- < ?php if($home->isClosed($user['user_id']) != true) {
    header('location: '.BASE_URL_PUBLIC.$user['username'].'.profile_close_account');
    // header('location: '.PROFILE_CLOSE_ACCOUNT.'');
} ?> -->

<?php include "header_navbar_footer/header.php"?>

<section class="content-header">
        <div class="row">
            <div class="col-4">
                <h5><i> Balance</i></h5>
            </div>
            <div class="col-8">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                    <li class="breadcrumb-item active"><i>
                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button>
                    </i></li>
                </ol>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">

      <div class="row">

        <div class="col-md-3 mb-3 d-none d-md-block">
            
            <div class="sticky-top">

                <div class="card">
                    <div class="ads_mini_wallet main-active m-0">
                        <p>Current balance</p>
                        <div style="font-size:17px"> 
                        <i class="fas fa-coins text-warning"></i>
                        <?php echo number_format($user['amount_coins'],2); ?> Coins </div>
                        <div class="h1">
                        <?php echo number_format($user['amount_francs']); ?> Frw</div>
                        <!-- $0.00 -->
                    </div>
                    <div class="card-body">
                        <div class="ads-cont-wrapper">
                            <div class="empty_state">
                                <img class="empty_state_img" src="<?php echo BASE_URL_LINK?>image/img/affs.svg"> 
                                 Deposit & Withdraw 
                                 <!-- Looks like you don't have any transaction yet!	 -->
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
        <div class="col-md-6 mb-4">

        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <!-- <a class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  href="< ?php echo HOME ?>">close</a> -->
                 <ul class="nav nav-tabs bg-light" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active"  data-toggle="pill" href="#Wallet" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21,18V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V6H12C10.89,6 10,6.9 10,8V16A2,2 0 0,0 12,18M12,16H22V8H12M16,13.5A1.5,1.5 0 0,1 14.5,12A1.5,1.5 0 0,1 16,10.5A1.5,1.5 0 0,1 17.5,12A1.5,1.5 0 0,1 16,13.5Z"></path></svg>
                         Wallet<!-- &amp; Credits -->
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#Coins" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                        <i class="fas fa-coins"></i>  Coins
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#withdraw" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15,14V11H18V9L22,12.5L18,16V14H15M14,7.7V9H2V7.7L8,4L14,7.7M7,10H9V15H7V10M3,10H5V15H3V10M13,10V12.5L11,14.3V10H13M9.1,16L8.5,16.5L10.2,18H2V16H9.1M17,15V18H14V20L10,16.5L14,13V15H17Z"></path></svg>
                         Withdraw
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">

                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="Wallet" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                   
                        <div class="card mb-3">
                            <div class="card-body">

                                <p class="bold">Current balance
                                <i class="fas fa-coins text-warning"></i>
                                <?php echo number_format($user['amount_coins'],2); ?> Coins </p>

                                <div class="my_wallet wow_mini_wallets">
                                    <div>
                                        <h5 style="font-size:30px"><?php echo number_format($user['amount_francs']); ?> Frw </h5>
                                        <!-- $0.00 -->
                                    </div>
                                    <div class="wow_mini_wallets_btns">
                                        <button data-toggle="modal" data-target="#send_money_modal" class="btn btn-default btn-mat">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path></svg> Send money					</button>
                                        <button class="btn main-active btn-mat btn-mat-raised" onclick="$('.wow_add_money_hid_form').slideToggle();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 0V3H0V5H3V8H5V5H8V3H5V0H3M9 3V6H6V9H3V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.11 21 19V18H12C10.9 18 10 17.11 10 16V8C10 6.9 10.89 6 12 6H21V5C21 3.9 20.11 3 19 3H9M12 8V16H22V8H12M16 10.5C16.83 10.5 17.5 11.17 17.5 12C17.5 12.83 16.83 13.5 16 13.5C15.17 13.5 14.5 12.83 14.5 12C14.5 11.17 15.17 10.5 16 10.5Z"></path></svg> Add Funds					</button>
                                    </div>
                                </div>

                                <div class="wow_add_money_hid_form text-center">
                                    <form class="form" id="replenish-user-account">
                                        <!-- <p class="bold">Replenish my balance</p> -->
                                        <p class="bold">Deposit in my Account </p>
                                        <div class="add-amount"><!-- $ -->
                                            <h5>Frw<input type="number" placeholder="0" min="1" max="100000" name="amount" id="amount"></h5>
                                        </div>
                                        <?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$user['user_id'].',\'buy_coins\'' ;?>
                                        <button type="button" class="btn main-active btn-mat btn-mat-raised"  onclick="coins($('#amount').val(),<?php echo $details ;?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M0.41,13.41L6,19L7.41,17.58L1.83,12M22.24,5.58L11.66,16.17L7.5,12L6.07,13.41L11.66,19L23.66,7M18,7L16.59,5.58L10.24,11.93L11.66,13.34L18,7Z"></path></svg> Continue					</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header main-active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M13.5,8H12V13L16.28,15.54L17,14.33L13.5,12.25V8M13,3A9,9 0 0,0 4,12H1L4.96,16.03L9,12H6A7,7 0 0,1 13,5A7,7 0 0,1 20,12A7,7 0 0,1 13,19C11.07,19 9.32,18.21 8.06,16.94L6.64,18.36C8.27,20 10.5,21 13,21A9,9 0 0,0 22,12A9,9 0 0,0 13,3"></path></svg>
                                Payment History
                            </div>
                            <div class="card-body">
                                <button type="button" class="float-right btn btn-outline-primary delete-all-subscription-statement"  data-user="<?php echo $_SESSION['key'] ;?>"> Clear All Data</button>
                                <p class="bold">Transactions</p>
                                <div class="response"></div>
                                <?php 

                                $sql= "SELECT * FROM subscription_statement WHERE user_id_subscription = $user_id ORDER BY date_subscription_ DESC ";
                                $query= $db->query($sql);
                                if ($query->num_rows > 0) {  ?>

                                <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
                                <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                                        <thead class="main-active thead-inverse">
                                            <tr>
                                                <th>No</th>
                                                <th>Description</th>
                                                <!-- <th>Name</th>
                                                <th>email</th> -->
                                                <th>Month</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                <?php
                                    $i=1;
                                    while($row= $query->fetch_array()) { 
                                            $subect = $row['subscription'];
                                            $replace = " ";
                                            $searching = "_";
                                            $subscription = str_replace($searching,$replace, $subect);
                                        ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><?php echo $subscription;?></td>
                                                    <!-- <td>< ?php echo $row['name_subscription_']?></td>
                                                    <td>< ?php echo $row['email_subscription_']?></td> -->
                                                    <td><?php echo $row['month_subscription_'] ;?></td>
                                                    <td><?php echo number_format($row['price_subscription_']) ;?></td>
                                                    <td><?php echo $users->timeAgo($row['date_subscription_']) ;?></td>
                                                </tr>
                                <?php } ?>

                                    </tbody>
                                </table>

                                <?php }else { ?>

                                <div class="tabbable">
                                    <div class="ads-cont-wrapper">
                                    <div class="empty_state">
                                    <img class="empty_state_img" src="<?php echo BASE_URL_LINK?>image/img/no_transaction.svg"> 
                                    Looks like you don't have any transaction yet!		
                                    </div>
                                    </div>				
                                </div>

                                <?php } ?>
                                
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="Coins" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                        <div class="form-group">
                            <label>Your Coins Balance is: </label> <i class="fa fa-money text-success"></i>
                            <i class="fas fa-coins text-warning"></i>  <?php echo number_format($user['amount_coins']); ?> coins
                        </div>

                        <label for="inputEmail" >Click any coins you wish to deposit in your account <i class="fa fa-check-circle text-success"></i></label>
                        <table class="table table-hover table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>N0</th>
                                    <th width="70%">Coins</th>
                                    <th width="30%"></th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td> <i class="fas fa-coins text-warning"></i> 5 coins</td>
                                        <td></td>
                                        <td>
                                        <?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$user['user_id'].',\'buy_coins\'' ;?>
                                            <button type="button" onclick="coins(500,<?php echo $details ;?>)" class="btn btn-sm btn-danger">500 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><i class="fas fa-coins text-warning"></i> 10 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(1000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">1,000 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><i class="fas fa-coins text-warning"></i> 50 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(5000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">5,000 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><i class="fas fa-coins text-warning"></i> 150 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(15000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">15,000 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><i class="fas fa-coins text-warning"></i> 250 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(25000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">25,000 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><i class="fas fa-coins text-warning"></i> 500 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(50000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">50,000 Frw</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><i class="fas fa-coins text-warning"></i> 1500 coins</td>
                                        <td></td>
                                        <td>
                                            <button type="button" onclick="coins(150000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">150,000 Frw</button>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>

                    </div><!-- /.card -->
                    <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <div class="card">
                            <!-- <div class="card-header main-active p-1">
                                <h4 class="h4 text-center font-weight-normal">Balance</h4>
                            </div> -->
                            <div class="card-body">

                            <div class="settings_page">

                                <div class="avatar_set">

                                    <div class="avatar-holder"  style="background: url('<?php echo (!empty($user['cover_img'])? BASE_URL_LINK."image/users_cover_profile/".$user['cover_img'] : BASE_URL_LINK.NO_COVER_IMAGE_URL) ;?>')no-repeat center center;background-size:cover;">
                                        <?php if (!empty($user['profile_img'])) {?>
                                            <img class="rounded-circle avatar" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'];?>" alt="User Avatar">
                                        <?php  }else{ ?>
                                            <img class="rounded-circle avatar" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Avatar">
                                        <?php } ?>
                                        <div class="infoz">
                                            <h5 title="shema"><a href="<?php echo BASE_URL_PUBLIC.$user['username']; ?>" ><?php echo $user['username']; ?></a></h5>
                                            <p>Current balance  <?php echo number_format($user['amount_francs']); ?> Frw</p>
                                        </div>
                                    </div>


                                    <div class="alert alert-danger text-center" style="background:#fcf8e3;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                        Your balance is  <?php echo number_format($user['amount_francs']); ?> Frw, <br> Minimum withdrawal request is 5,000 Frw	
                                        <!-- Your balance is $0, minimum withdrawal request is $50	 -->
                                    </div>


                                </div>
                                
                                <form class="setting-general-form form-horizontal" id="withdraw-money-form" method="post">
                                    <div class="setting-general-alert setting-update-alert"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="wow_form_fields">
                                                <label for="paypal_email">Email</label>  
                                                <input id="paypal_email" name="paypal_email" type="text" class="form-control input-md" value="<?php echo $_SESSION['email']; ?>" autocomplete="off">
                                                <span class="help-block checking"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wow_form_fields">
                                                <label for="amount">Amount</label>  
                                                <input name="amount" id="amount-withdraw-money" type="text" class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" name="month" value="day">
                                        <input type="hidden" name="subscription" value="withdraw_coins">
                                        <input type="hidden" name="withdraw" value="withdraw_coins">
                                        <input type="hidden" id="amount_available_" name="amount_available_" value="<?php echo $user['amount_francs'];?>">
                                        <input type="hidden" name="name" value="<?php echo $user['firstname'].' '.$user['lastname'];?>">
                                        <input type="hidden" name="email" value="<?php echo $user['email'];?>">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['key'];?>">
                                        <!-- < ?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$user['user_id'].',\'withdraw_coins\'' ;?> -->
                                        <!-- onclick="withdraw_coins($('#amount_request').val(),< ?php echo $details ;?>)" -->
                                        <button type="button" class="btn main-active btn-mat btn-mat-raised submit-form-withdraw-money" >
                                        Request withdrawal</button>
                                        <!-- <button type="submit" class="btn btn-main btn-mat btn-mat-raised add_wow_loader">Request withdrawal</button> -->
                                    </div>
                                </form> 
                            </div>

                            <div class="card mt-2 mb-3">
                                <div class="card-header">
                                    Account to Receive payment
                                </div>
                                <div class="card-body">

                                <?php if (!empty($user['type_of_payment'])){ 
                                    if ($user['type_of_payment'] == 'Bank') { ?>
                                <label style="text-decoration: underline;color: green;">Bank Details</label>
                                <div>Bank Name : <?php echo $user['type_of_payment']; ?></div> 
                                <div>Bank Account : <?php echo $user['bank_account']; ?></div> 
                                <div>Swift Number : <?php echo $user['swift_number']; ?></div> 

                                <?php }else { ?>
                                <label style="text-decoration: underline;color: green;">Phone Details</label>
                                <div>SIM : <?php echo $user['sim_account']; ?></div>
                                <div>Number : <?php echo $user['sim_number']; ?></div>
                                <?php } } ?>

                                    <form method="post" id="account-payment-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="wow_form_fields">
                                                <label for="amount">Select Type Of Payment</label>  
                                                <select class="form-control"  onchange="showPayment();" name="type_of_payment" id="type_of_payment">
                                                    <option>Select one</option>
                                                    <option value="Mtn&Airtel">Mtn Or Airtel</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                            <div id="payment_choice"></div>
                                            <div class="response-account-payment"></div>
                                            <div class="text-center">
                                                <button type="button" class="btn main-active btn-mat btn-mat-raised submit-account-payment-form" >
                                                Update Account</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>

                                </div>
                                <div class="card-footer text-muted">
                                </div>
                            </div>


                            <?php 
                                 $sql= "SELECT * FROM withdraw_money W 
                                 LEFT JOIN users U ON W. user_id_withdraw = U. user_id
                                WHERE W. user_id_withdraw = $user_id AND W. status_withdraw != 'block' 
                                ORDER BY W. withdraw_date DESC ";
                                $query= $db->query($sql);
                                if ($query->num_rows > 0) {  ?>
                                <div class="card-header border">
                                    Request to be Paid
                                </div>

                                <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
                                <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                                        <thead class="main-active thead-inverse">
                                            <tr>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Payment Details</th>
                                                <!-- <th>Name</th>
                                                <th>email</th> -->
                                                <th>status</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                <?php
                                    $i=1;
                                    while($row= $query->fetch_array()) { 
                                        // var_dump($row); 
                                    ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><?php echo $row['withdraw'];?></td>
                                                    <?php if ($row['type_of_payment'] == 'Bank') { ?>
                                                        <td><?php echo 'Bank Name ='.$row['bank_name'];?></br>
                                                        <?php echo 'Bank Account ='. $row['bank_account'];?></br>
                                                        <?php echo 'Swift Number ='.$row['swift_number'];?></td>
                                                    <?php }else { ?>
                                                        <td><?php echo 'SIM ='.$row['sim_account'];?></br>
                                                        <?php echo 'Number ='. $row['sim_number'];?></td>
                                                    <?php } ?>
                                                    <!-- <td>< ?php echo $row['name_subscription_']?></td>
                                                    <td>< ?php echo $row['email_subscription_']?></td> -->
                                                    <?php echo ($row['status_withdraw'] == 'pending')?'
                                                    <td class="text-danger">'.$row['status_withdraw'].'</td>
                                                    ':'
                                                    <td class="text-success">'.$row['status_withdraw'].'</td>
                                                    '?>
                                                    <td><?php echo number_format($row['withdraw_price'])?></td>
                                                    <td><?php echo $users->timeAgo($row['withdraw_date'])?></td>
                                                </tr>
                                <?php } ?>

                                    </tbody>
                                </table>

                                <?php } ?> 

                            </div>
                                <!-- /.card_body -->
                            <div class="card-footer text-muted">
                            </div> <!-- /.card_footer -->
                        </div><!-- /.card -->

                        <?php 

                        $sql0= "SELECT * FROM fundraising WHERE user_id2 = $user_id ORDER BY created_on2 DESC ";
                        $query= $db->query($sql0);
                        if ($query->num_rows > 0) {  ?>
    
                        <div class="card mt-3">
                            <div class="card-header py-0">
                            <p class="bold">Your Fundraising Donation</p>
                            </div>
                            <div class="card-body">
                                
                               
                            <?php   
                            $i=1;
                            while($tweet= $query->fetch_array()) { 
                                        // var_dump($row); 
                                    ?>

                                <div class="col-12 mb-2 bg-light shadow-sm pb-3 ">
                                     <p class="text-center"><?php echo '------------------------ ('.$i++.') --------------------------';?></p>
                                    
                                    <div class="text-muted mb-1">Fundraising Donation
                                        <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                                    </div>
                                    <div class="card-text">
                                    <!-- 40,000 -->
                                        <span class="font-weight-bold"><?php echo number_format($tweet['money_raising']); ?> Frw</span>
                                        Raised by <?php echo $tweet['donate_counts']; ?> people in <?php echo $home->timeAgo($tweet['created_on2']);?> 
                                        <span class="float-right"><?php echo $home->donationPercetangeMoneyRaimaing($tweet['money_raising'],$tweet['money_to_target']); ?> %</span>
                                        <!-- 40 -->
                                    </div>
                                    <div class="progress clear-float " style="height: 10px;">
                                        <?php echo $home->Users_donationMoneyRaising($tweet['money_raising'],$tweet['money_to_target']); ?>
                                    </div>
                                    
                                    <div class="clear-float">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span class="text-muted"><?php echo $home->timeAgo($tweet['created_on2']); ?></span>
                                        <span class="text-muted float-right text-right">out of <?php echo number_format($tweet['money_to_target']).' Frw'; ?></span>
                                        <!-- 13 days Left -->
                                    </div>

                                    <span class="response_coins"></span>
                                    <?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$tweet['fund_id'].','.$user['user_id'].',\'fundraising withdraw\'' ;?>
                                    <input type="button" onclick="withdraw_money(<?php echo $tweet['money_raising'].','.$details ;?>)" value="Request withdrawal This Donation"  class="btn btn-primary btn-md btn-block mt-2" >
                                </div><!-- col -->
                                <hr>

                                    <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php 

                        $sql0= "SELECT * FROM tweets WHERE tweetBy = $user_id and coins !='' and retweet_id = 0 OR 
                        tweetBy = $user_id and coins !='' and retweet_id not in (SELECT tweet_id FROM tweets WHERE tweetBy = $user_id)
                        ORDER BY posted_on DESC ";
                        $query= $db->query($sql0);
                        if ($query->num_rows > 0) { ?>

                        <div class="card mt-3">
                            <div class="card-header py-0">
                            <p class="bold">Your irangiro Tweet Donation</p>
                            </div>
                            <div class="card-body">
                                
                             
                                  
                                  <?php  
                                    $i=1;
                                  while($tweet= $query->fetch_array()) { 
                                        // var_dump($row); 
                                    ?>

                                <div class="col-12 mb-2 bg-light shadow-sm pb-3 ">
                                     <p class="text-center"><?php echo '------------------------ ('.$i++.') --------------------------';?></p>
                                    
                                    <div class="text-muted mb-1">Tweet Donation
                                        <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                                    </div>
                                    <div class="card-text">
                                    <!-- 40,000 -->
                                        <span class="font-weight-bold"><?php echo number_format($tweet['money_raising']); ?> Frw</span>
                                        Raised by <?php echo $tweet['donate_counts']; ?> people in <?php echo $home->timeAgo($tweet['posted_on']);?> 
                                        <span class="float-right"><?php echo $home->donationPercetangeMoneyRaimaing($tweet['money_raising'],$tweet['money_to_target']); ?> %</span>
                                        <!-- 40 -->
                                    </div>
                                    <div class="progress clear-float " style="height: 10px;">
                                        <?php echo $home->Users_donationMoneyRaising($tweet['money_raising'],$tweet['money_to_target']); ?>
                                    </div>
                                    
                                    <div class="clear-float">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span class="text-muted"><?php echo $home->timeAgo($tweet['posted_on']); ?></span>
                                        <span class="text-muted float-right text-right">out of <?php echo number_format($tweet['money_to_target']).' Frw'; ?></span>
                                        <!-- 13 days Left -->
                                    </div>

                                    <span class="response_coins"></span>
                                    <?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$tweet['tweet_id'].','.$user['user_id'].',\'tweet withdraw\'' ;?>
                                    <input type="button" onclick="withdraw_money(<?php echo $tweet['money_raising'].','.$details ;?>)" value="Request withdrawal This Donation"  class="btn btn-primary btn-md btn-block mt-2" >
                                </div><!-- col -->
                                <hr>

                                    <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                    </div><!-- /.tab-pane -->

                </div><!-- /.tap -->
              </div> <!-- /.card-BODY -->
            </div> <!-- /.card -->
            
        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <!-- < ?php $follow->whoTofollow($user['user_id'],$user['user_id'])?> -->

            <div class="sticky-top">
                <?php echo $home->options(); ?>
            </div>
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->

        <div class="modal fade wow_mat_pops in" id="send_money_modal" >
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="wow_pops_head">
                        <svg height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" xmlns="http://www.w3.org/2000/svg"><path d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729 c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="currentColor" opacity="0.6"></path> <path d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729 c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="currentColor" opacity="0.6"></path> <path d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428 c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="currentColor"></path></svg>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"></path></svg></button>
                        <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path></svg> Send money to friends</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="send-money-form" autocomplete="off">
                        
                            <div id="send-money-form-alert">
                                <div class="alert alert-warnings" style="background:#fcf8e3;">
                                    Your current wallet balance is: <?php echo number_format($user['amount_francs']); ?> Frw
                                    <!-- , please top up your wallet to continue. <br> -->
                                    <!-- <a style="color:black;" href="http://localhost/facebook//wallet/">Top up</a> -->
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="wow_form_fields">
                                        <label for="search">To who you want to send?</label>
                                        <input id="status-send-money" type="text" name="username" class="status" placeholder="Search by username Type @">
                                        <div class="hash-box"><ul></ul></div>
                                        <div class="dropdown">
                                            <ul class="dropdown-menu money-recipients-list"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            
                            <div class="wow_snd_money_form text-center">
                                <p class="bold">Amount</p>
                                <div class="add-amount">
                                    <h5>Frw<input type="number" placeholder="0" min="1" max="100000" name="amount" id="amount-send-money"></h5>
                                    <!-- <h5>Frw<input type="number" placeholder="0.00" min="1.00" max="1000" name="amount" id="amount"></h5> -->
                                </div>
                            </div>
                            
                            <p id="response-send-money"></p>
                            <div class="text-center">
                                <button type="button" id="submit-form-send-money" class="btn btn-main btn-mat btn-mat-raised add_wow_loader" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M0.41,13.41L6,19L7.41,17.58L1.83,12M22.24,5.58L11.66,16.17L7.5,12L6.07,13.41L11.66,19L23.66,7M18,7L16.59,5.58L10.24,11.93L11.66,13.34L18,7Z"></path></svg> Continue						</button>
                            </div>
                            <input type="hidden" id="send-money" name="send-money" value="<?php echo $_SESSION['key']; ?>">
                            <input type="hidden" id="recipient_user_id" name="user_id" value="<?php echo $_SESSION['key']; ?>">
                            <input type="hidden" id="amount_available" name="amount_available" value="<?php echo $user['amount_francs']; ?>">
                        </form>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade wow_mat_pops in" id="pay-go-pro" >
            <div class="modal-dialog payment_box">
            <div class="modal-content">
                <div class="wow_pops_head">
                    <svg height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" xmlns="http://www.w3.org/2000/svg"><path d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729 c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="currentColor" opacity="0.6"></path> <path d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729 c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="currentColor" opacity="0.6"></path> <path d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428 c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="currentColor"></path></svg>
                    <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"></path></svg> Choose a payment method</h4>
                </div>
                <div class="modal-body">
                    <!-- PayPal -->
                                    
                    <!-- Alipay -->
                    <button class="bank_payment btn" onclick="Wo_CheckOutCard(1, 'Star package', 300, 'bank_payment');">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="47.001px" height="47.001px" viewBox="0 0 47.001 47.001" xml:space="preserve"><path fill="currentColor" d="M44.845,42.718H2.136C0.956,42.718,0,43.674,0,44.855c0,1.179,0.956,2.135,2.136,2.135h42.708c1.18,0,2.136-0.956,2.136-2.135C46.979,43.674,46.023,42.718,44.845,42.718z"></path><path fill="currentColor" d="M4.805,37.165c-1.18,0-2.136,0.956-2.136,2.136s0.956,2.137,2.136,2.137h37.37c1.18,0,2.136-0.957,2.136-2.137s-0.956-2.136-2.136-2.136h-0.533V17.945h0.533c0.591,0,1.067-0.478,1.067-1.067s-0.478-1.067-1.067-1.067H4.805c-0.59,0-1.067,0.478-1.067,1.067s0.478,1.067,1.067,1.067h0.534v19.219H4.805z M37.37,17.945v19.219h-6.406V17.945H37.37zM26.692,17.945v19.219h-6.406V17.945H26.692z M9.609,17.945h6.406v19.219H9.609V17.945z"></path><path fill="currentColor" d="M2.136,13.891h42.708c0.007,0,0.015,0,0.021,0c1.181,0,2.136-0.956,2.136-2.136c0-0.938-0.604-1.733-1.443-2.021l-21.19-9.535c-0.557-0.25-1.194-0.25-1.752,0L1.26,9.808c-0.919,0.414-1.424,1.412-1.212,2.396C0.259,13.188,1.129,13.891,2.136,13.891z"></path></svg>
                        Bank transfer					
                    </button>
                </div>
            </div>
            </div>
        </div>



      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
