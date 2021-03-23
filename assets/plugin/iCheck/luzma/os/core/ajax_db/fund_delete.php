<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$fund_id= $_POST['deleteTweetHome'];
    $fundraising->deleteLikesfund($fund_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$fund_id= $_POST['showpopupdelete'];
	$fund_user_id= $_POST['deletefund'];
    $row=$fundraising->fund_getPopupTweet($user_id,$fund_id,$fund_user_id);
    $likes= $fundraising->fundraisinglikes($user_id,$row['fund_id']);
    ?>

    <div class="fund-popup">
      <div class="wrap5">
        <div class="post-popup-body-wrap" style="top: 15%;">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header main-active text-light">
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

                  
                <div class="fund" >
                    <div class="card" style="border-bottom-left-radius: 0px !important;border-bottom-right-radius: 0px !important;">
                        <img class="card-img-top" height="244px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/fundraising/<?php echo $row['photo'] ;?>" >
                        <div style="position: absolute; top: 0px; right: 0;padding: 1rem;">
                            <span class="btn btn-light"><span style="font-size: 14px" class="material-icons p-0 m-0"> trending_up</span> trending</span>
                        </div>
                        <div style="position: absolute;bottom: 0px; right: 0;left:0px;background-color: #cfd3d6a1">
                            
                                <?php if($likes['like_on'] == $row['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraising-btn more float-right text-sm  mt-1 mr-1 text-dark"'; }else{ echo 'id="login-please" class="more float-right  mt-1 mr-1 text-dark" data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                <?php }else{ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraising-btn more float-right text-sm  mt-1 mr-1 text-dark"'; }else{ echo 'id="login-please" class="more float-right mt-1 mr-1 text-dark"  data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                <?php } ?>

                               <h5 class="card-title text-dark m-1 pb-1 pl-2">Helps <?php echo $row['lastname'] ;?> </h5>
                              <div class="progress " style="height: 6px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                        </div>
                    </div>
                    <div class="card" style="border-top-left-radius: 0px !important;border-top-right-radius: 0px !important;">
                            <div class="card-body pl-1 pb-1">
                              <span class="h5">500 Frw raised </span>
                              <span class="text-muted"> Out of 5000 Frw</span>
                              <p><?php echo $row['text'] ;?></p>
                              <div class="float-right">
                              <button type="button" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" class="btn btn-primary" >+ Read more</button></div>
                            </div>
                    </div>
                </div>
                    
                </div><!-- shadow -->

                </div><!-- card-body -->
                <div class="card-footer main-active"><!-- card-footer -->
                <button class="delete-it-fund  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>