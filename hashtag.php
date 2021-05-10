<?php 
include "core/init.php";

if ($users->loggedin() == false) {
    header('location: '.LOGIN.'');
}

if (isset($_GET['hashtag']) && !empty($_GET['hashtag'])) {
    $user_id= $_SESSION['key'];
    $hashtag= $users->test_input($_GET['hashtag']);
   
    $jobs= $job->jobsData($_SESSION['key']);
    $fundraisingV= $fundraising->fundraisingData($_SESSION['key']);
    $crowfundV= $crowfund->crowfundraisingData($_SESSION['key']);
    $houseV= $house->houseData($_SESSION['key']);
    $carV= $car->carData($_SESSION['key']);
    $icyamunaraV= $icyamunara->icyamunaraData($_SESSION['key']);

    $user= $home->userData($user_id);
    $notific= $notification->getNotificationCount($user_id,$_SESSION['email']);
    $notification->notificationsView($user_id);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo '#'.$hashtag.' hashtag on Posts' ; ?></title>
    
    <?php if($home->isClosed($user['user_id']) != true) {
        header('location: '.BASE_URL_PUBLIC.$user['username'].'.profile_close_account');
        // header('location: '.PROFILE_CLOSE_ACCOUNT.'');
    } ?>

<?php include "header_navbar_footer/header.php"?>

    <!-- Main content -->
    <section class="content-header">
        <div class="row">
            <div class="col-6 ">
                <span  class="float-left h1"><?php echo 'Hashtag' ; ?></span>
                <span  class="float-right h1"><i><?php echo '#'.$hashtag ; ?></i></span>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><i><a href="<?php echo BASE_URL_PUBLIC.$hashtag.'.latest.hashtag' ;?>">Latest</a></i></li>
                    <li class="breadcrumb-item "><i><a href="<?php echo BASE_URL_PUBLIC.$hashtag.'.users.hashtag' ;?>">Accounts</a></i></li>
                    <li class="breadcrumb-item "><i><a href="<?php echo BASE_URL_PUBLIC.$hashtag.'.photos.hashtag' ;?>">Photos</a></i></li>
                </ol>
            </div>
        </div>
    </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

            <div class="col-md-3 mb-3 d-none d-md-block">
                <?php echo $home->userProfile($user_id); ?>

                <?php echo $trending->trends(); ?>

            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <?php 
                    if (strpos($_SERVER['REQUEST_URI'],'.photos')): 
                    	?>
                    <!-- TWEETS IMAGES  -->
                    	 <?php 
                    	$tweets = $trending->getTweetsTrendbyhastag_not_empty($hashtag);
                    	echo $Hashtag_GetUsers->hasshtag($user_id,$tweets);
                    	
                    elseif (strpos($_SERVER['REQUEST_URI'],'.users')):?>
                    <!--TWEETS ACCOUTS-->
                             <div class="row">
                            <?php 
                            $accounts= $trending->getUsersHashtag($hashtag);
                            foreach ($accounts as $account) { ?>
                             <div class="col-md-4 mb-3">
                                  <!-- Widget: user widget style 1 -->
                                  <div class="card card-follow user-follow">
                                      <!-- Add the bg color to the header using any of the bg-* classes -->
                                       <?php if (!empty($account['cover_img'])) { ?>
                                        <div class="user-header-follow text-white" style="background: url('<?php echo BASE_URL_LINK."image/users_cover_profile/".$account['cover_img'] ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                                        <?php }else{ ?>
                                          <div class="user-header-follow text-white" style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                                       <?php  } ?>
              
                                      </div>
                                      <div class="user-image-follow">
                                        <?php if(!empty($account['profile_img'])){ ?>
                                          <img class="rounded-circle elevation-2"
                                              src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$account['profile_img'] ;?>" >
                                        <?php }else{ ?>
                                             <img class="rounded-circle elevation-2" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  />
                                          <?php } ?>
                                      </div>
                                      <div class="card-footer">
                                          <h5 class="user-username-follow"><a href="<?php echo BASE_URL_PUBLIC.$account['username'] ;?>"><?php echo $account['username'] ;?></a></h5>
                                          <h5 class="user-username-follow"><small><?php echo (!empty($account['career']))? $home->getTweetLink($account['career']):'Member' ;?></small></h5>
                                          <span><?php echo $follow->followBtn($account['user_id'],$user_id,$user_id) ;?></span>
                                      </div>
                                      <!-- /.footer -->
                                  </div>
                                  <!-- /. card widget-user -->
                              </div>
                              <!-- col --> 
                            <?php } ?>
                         </div>
                    <!-- TWEETS ACCOUNTS -->
                    <?php 
                    else :	?>
                    	<?php 
                    	$tweets = $trending->getTweetsTrendbyhastag($hashtag);
                    	echo $Hashtag_GetUsers->hasshtag($user_id,$tweets);
                    	
				    endif; ?>
            </div>
            <!-- /.col-md-6 -->

            <div class="col-md-3 d-none d-md-block">
                <?php echo $follow->whoTofollow($user_id,$user_id) ;?>

                <div class="sticky-top" style="top: 52px;">
                    <?php echo $home->options(); ?>
                 </div>
            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?php include "header_navbar_footer/footer.php"?>
