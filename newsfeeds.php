
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' News-Feeds'; ?></title>

<?php if($home->isClosed($user['user_id']) != true) {
    header('location: '.BASE_URL_PUBLIC.$user['username'].'.profile_close_account');
    // header('location: '.PROFILE_CLOSE_ACCOUNT.'');
} ?>

<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
      <section class="content ">

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">
            <div class="sticky-top">
                
                <div class="card mb-3">
                    <div class="ads_mini_wallet main-active m-0">
                        <p>News-Feeds</p>
                        <div class="h1">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            News</div>
                    </div>
                    <div class="card-body">
                        
                       <ul class="ads-nav list-unstyled">
                           <li>
                               <a href="javascript:void(0)" class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,8H4A2,2 0 0,0 2,10V14A2,2 0 0,0 4,16H5V20A1,1 0 0,0 6,21H8A1,1 0 0,0 9,20V16H12L17,20V4L12,8M21.5,12C21.5,13.71 20.54,15.26 19,16V8C20.53,8.75 21.5,10.3 21.5,12Z"></path></svg>
                               Subscribe <br>
                               From May 21 To May 04</a>
                           </li>
                           <li><hr></li>
                           <li>
                               <a href="<?php echo PROMOTE_ADS; ?>" class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,8H4A2,2 0 0,0 2,10V14A2,2 0 0,0 4,16H5V20A1,1 0 0,0 6,21H8A1,1 0 0,0 9,20V16H12L17,20V4L12,8M21.5,12C21.5,13.71 20.54,15.26 19,16V8C20.53,8.75 21.5,10.3 21.5,12Z"></path></svg> News-Feeds</a>
                           </li>
                           <li><hr></li>
                           <li>
                               <a href="<?php echo BALANCE; ?>" class="active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21,18V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V6H12C10.89,6 10,6.9 10,8V16A2,2 0 0,0 12,18M12,16H22V8H12M16,13.5A1.5,1.5 0 0,1 14.5,12A1.5,1.5 0 0,1 16,10.5A1.5,1.5 0 0,1 17.5,12A1.5,1.5 0 0,1 16,13.5Z"></path></svg> Wallet &amp; Credits</a>
                           </li>
                           <li><hr></li>
                           <li>
                               <a href="javascript:void(0)"  
                               <?php echo (isset($_SESSION['key']))?
                               (!empty($subscription['newsfeed_subscription']) && $users->subscription_deadline($subscription['newsfeed_date_pay'],$subscription['newsfeed_subscription']) == true )?
                               'class="promote_forms " ' :
                               'class="promote-post" data-promote="payment" ':
                               'id="login-please" data-login="1"'
                               ;?>> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg> Add New News</a>
                           </li>
                       </ul>

                    </div>
                </div>
           
          <?php if (isset($_SESSION['key'])){
                //   echo $home->userProfile($user_id);
                  echo $trending->trends();

            } ?>
            
        </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-4">
            <div <?php echo 
                (isset($_SESSION['key']))?
                (!empty($subscription['newsfeed_subscription']) && $users->subscription_deadline($subscription['newsfeed_date_pay'],$subscription['newsfeed_subscription']) == true )?
                'class="newsfeeds_forms main-active dot-container more mb-3" ':
                'class="newsfeed-post main-active dot-container more mb-3" data-promote="payment" ':
                'id="login-please" data-login="1"';
                // var_dump($users->subscription_deadline($subscription['newsfeed_date_pay'],$subscription['newsfeed_subscription']));
                ?> >
                <img src="<?php echo BASE_URL_LINK ;?>image/img/promote1.png" width="30px" witalt="User Image">
                <a href="javascript:void(0)"> >> CLICK HERE TO START << </a>
                <img src="<?php echo BASE_URL_LINK ;?>image/img/promote1.png" width="30px" witalt="User Image">
                <!-- <i class="fas fa-bullhorn" aria-hidden="true"></i> -->
                <h6>Boost Your News-Feeds Post Here   !!!</br> 
               Get more people to see and engage with your posts</h6>
            </div>

            <div class="row mb-4" > 
                <?php echo $newsfeeds->NewsFeedsposts($user_id,15); ?>
            </div>
            
        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <div class="sticky-top">
                <?php 
                    echo $newsfeeds->newsfeedsmall(); 
                    
                    // echo $home->options(); 
                ?>
            </div>
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
