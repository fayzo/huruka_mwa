<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$fund_id= $_POST['deleteTweetHome'];
    $crowfund->deleteLikesCrowfund($fund_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$fund_id= $_POST['showpopupdelete'];
	$fund_user_id= $_POST['deletefund'];
    $row=$crowfund->fund_getPopupTweet($user_id,$fund_id,$fund_user_id);
    $likes= $crowfund->Crowfundraisinglikes($user_id,$row['fund_id']);
    ?>

    <div class="fund-popup">
      <div class="wrap5">
        <div class="post-popup-body-wrap">

            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header main-active">
                    <span class="closeDelete"><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center">Are you sure you want to delete this Posts?</h5>
                </div>
                <div class="card-body">

                <div class="shadow-lg">
                    <div class="user-block border-top">
                     <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                                     <?php if (!empty($row['profile_img'])) {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                                     <?php  }else{ ?>
                                       <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                     <?php } ?>
                               </div>
                            </div>
                        <span class="username">
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $row['firstname']." ".$row['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($row['created_on2']); ?></span>
                        </span>
                        <span class="description"><?php echo $row['text']; ?></span>
                    </div> <!-- user-block -->

                    <div class="card" >
                        <img class="card-img-top" width="242px" id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/crowfund/<?php echo $row['photo'] ;?>" >
                        <div class="card-body">
                            <div class="p-0 font-weight-bold">Funding 

                                <?php if($likes['like_on'] == $row['fund_id']){ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                <?php }else{ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraising-btn more float-right text-sm mr-2"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                <?php } ?>
                            
                            </div>

                            <hr>
                            <a href="javascript:void(0);"  id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" class="card-text h5"><?php echo $row['photo_Title_main'] ;?></a>
                            <!-- Kogera umusaruro muguhinga -->
                            <p class="text-muted"><?php echo $row['text']; ?></p>
                            <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->

                            <div class="text-muted mb-1"><?php echo $row['categories_crowfundraising']; ?></div>
                            <div class="card-text">
                            <!-- 40,000 -->
                                <span class="font-weight-bold"><?php echo number_format($row['money_raising'],2); ?> Frw</span>
                                Raised
                                <div class="float-right"><?php echo $row['percentage']; ?>%</div>
                                <!-- 40 -->
                            </div>
                            <div class="progress clear-float " style="height: 10px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: <?php echo $row['percentage']; ?>%" aria-valuenow="<?php echo $row['percentage']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            
                            <div class="clear-float">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="text-muted"><?php echo $home->timeAgo($row['created_on2']); ?></span>
                                <!-- 13 days Left -->
                            </div>
                        </div>
                    </div> <!-- card -->
                    
                </div><!-- shadow -->

                </div><!-- card-body -->
                <div class="card-footer main-active text-light"><!-- card-footer -->
                <button class="delete-it-crowfund  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>