<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['coins']) && !empty($_POST['coins'])) {

    if (isset($_SESSION['key'])) {
        $user_id= $_SESSION['key'];
    }else{
        $user_id= 1;
    }

  	$profileData= $home->userData($_POST['user_id']);
  	$user= $home->userData($user_id);


    ?>

<div class="promote-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin"  id="popupEnd" >
        	<div class="img-popup-bodys">


            <div class="card">
                <div class="card-header">
                     <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                    <div class="user-block">
                        <!-- <button class="f-btn btn btn-primary btn-sm float-right"><i class="fa fa-user-plus"></i> Follow</button> -->
                        <?php if (!empty($profileData['profile_img'])) { ?>

                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                            <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$profileData['profile_img'] ;?>"
                            alt="user image">
                            </div>
                            </div>

                        <?php }else{ ?>

                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE ;?>"
                            alt="user image">
                            </div>
                            </div>

                        <?php } ?>

                        <span class="description"> Send Reward Coins to </span>
                        <span class="username">
                            <a href="<?php echo BASE_URL_PUBLIC.$profileData['username'] ;?>"><?php echo $profileData['username'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                        </span>
                    </div> <!-- /.user-block -->

                </div> <!-- /.card-headed -->

                <div class="card-body">
                   
                    <div class="row mb-2">
                        <div class="col-12">
                            <?php echo Follow::coins_recharge($profileData['user_id'],$user_id,$user['username'],$profileData['username']); ?>
                        </div>
                    </div>

                </div><!-- comment-End -->
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div><!-- card-End -->

        </div> <!-- Wrp4 -->
        </div> <!-- Wrp4 -->
        </div> <!-- Wrp4 -->
    </div> <!-- show-popup-wrap" -->

    <?php }
?>