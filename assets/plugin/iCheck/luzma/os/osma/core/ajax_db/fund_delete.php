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
      <div class="wrap5" id="disabler">
      <div onclick="togglePopup( )"></div>
        <div class="post-popup-body-wrap" style="top: 15%;"  id="popupEnd">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header main-active text-light">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
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
                <div class="card borders-bottoms more" >
                        <img class="card-img-top" width="242px" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/fundraising/<?php echo $row['photo'] ;?>" >
                        <div class="card-body">
                            <div class="p-0 font-weight-bold">Fundraising </div>
                            <hr>
                            <div style="height:115px;">
                                <a href="javascript:void(0);" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" class="card-text h5">
                                     Helps <?php echo $row['lastname'] ;?> 
                                </a>
                                <!-- Kogera umusaruro muguhinga -->
                                <p class="mt-2">
                            <?php if (strlen($row["text"]) > 80) {
                                        echo $row["text"] = substr($row["text"],0,80).'...
                                        <br><span class="mb-0"><a href="javascript:void(0)" id="fund-readmore" data-fund="'.$row['fund_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">read more...</a></span>';
                                        }else{
                                        echo $row["text"];
                                        } ?> 
                                </p>
                                <!-- 117 -->
                                <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->
                            </div>                      
                            <div class="text-muted mb-1"><?php echo $row["categories_fundraising"]; ?>
                                <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                            </div>
                            <div class="card-text">
                            <!-- 40,000 -->
                                <span class="font-weight-bold"><?php echo number_format($row['money_raising']); ?> Frw</span>
                                Raised
                                <span class="float-right"><?php echo $fundraising->donationPercetangeMoneyRaimaing($row['money_raising'],$row['money_to_target']); ?> %</span>
                                <!-- 40 -->
                            </div>
                            <div class="progress clear-float " style="height: 10px;">
                                <?php echo $fundraising->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                            </div>
                            
                            <div class="clear-float">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="text-muted"><?php echo $fundraising->timeAgo($row['created_on2']); ?></span>
                                <span class="text-muted float-right text-right">out of <?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                                <!-- 13 days Left -->
                            </div>
                        </div>
                    </div> <!-- card -->
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