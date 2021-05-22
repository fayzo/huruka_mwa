
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' Transaction Coins'; ?></title>

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

                <div class="card">
                    <div class="ads_mini_wallet main-active m-0">
                        <p>Current balance</p>
                        <div style="font-size:17px"> 
                            <i class="fas fa-coins text-warning"></i>
                            <?php echo number_format($user['amount_coins']); ?> Coins 
                        </div>
                        <div class="h1">
                            <?php echo number_format($user['amount_francs']); ?> Frw
                        </div>
                        <!-- $0.00 -->
                    </div>
                    <div class="card-body">
                        <div class="ads-cont-wrapper">
                            <div class="empty_state">
                                <img class="empty_state_img" src="<?php echo BASE_URL_LINK?>image/img/affs.svg"> 
                                 COINS 
                                 <!-- Looks like you don't have any transaction yet!	 -->
                            </div>
                        </div>

                    </div>
                </div>
           
        </div>
        </div>

        <div class="col-sm-12 col-md-6 mb-4">
                <?php 

                $user_id= $_SESSION['key'];
                // $tweet_id= $_POST['showMessage'];
                $mysqli= $db;
                $query= $mysqli->query("SELECT * FROM  users U Left JOIN transaction_coins C  ON C. user_id_coins_from = U. user_id WHERE C. user_id_coins_to = $user_id ORDER BY C. coins_id Desc LIMIT 10");
                ?>

            <div class="cards">
                <div class="card-header borders-tops text-center p-2 message-color bg-light">
                    <h3><i> Coins sent to you</i></h3>
                </div><!-- /.card-header -->
                <div class="card-body mb-2">
                
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
            
                    <li class="time-label">
                        <span class="bg-danger text-light">
                        Your Timeline
                            <!-- 10 Feb. 2014 -->
                        </span>

                        <button type="button" class="float-right btn btn-primary delete-all-coins" data-user="<?php echo $_SESSION['key'] ;?>"> Clear All Data</button>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                    <div class="response"></div>
                    </li>
                
                    <?php while($data= $query->fetch_array()) { ?>
                    
                    <li>
                        <i class="fa fa-user bg-info text-light"></i>

                        <div class="timeline-item card shadow-sm" style="background:white;">
                            <div class="card-body">
                                <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['datetime']) ;?></span>
                            <div class="user-block">
                                <div class="user-blockImgBorder">
                                    <div class="user-blockImg">
                                            <?php if (!empty($data['profile_img'])) {?>
                                            <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                            <?php  }else{ ?>
                                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                            <?php } ?>
                                    </div>
                                </div> 
                                <span class="username">
                                    <a
                                        href="<?php echo BASE_URL_PUBLIC.$data['username'] ;?>"><?php echo $data['username'] ;?></a>
                                        <?php echo $home->bot_light($data['bot'],$data['followers']) ;?>
                                    
                                    <!-- //Jonathan Burke Jr. -->
                                </span>
                                <span class="description"> <div> <i class="fas fa-coins"></i> <?php echo number_format($data['amount_coins']); ?> coins sent to you on <!-- accepted your friend request --> </div></span>
                            </div><!-- /.user-block -->
                            
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <?php } ?>

                    <li >
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </li>
                </ul>

            </div>
            </div>
            
        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <div class="sticky-top">
                <?php echo $home->options(); ?>
            </div>
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
