<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['deleteTweetSchool']) && !empty($_POST['deleteTweetSchool'])) {
    $user_id= $_SESSION['key'];
	$school_id= $_POST['deleteTweetSchool'];
    $school->deleteLikesSchool($school_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$school_id= $_POST['showpopupdelete'];
	$school_user_id= $_POST['delete_user_id'];
    $school=$school->school_getPopupTweet($user_id,$school_id,$school_user_id);
    ?>
    <div class="car-popup">
      <div class="wrap5">
        <div class="post-popup-body-wrap" style="top: 15%;">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header">
                    <span class="closeDelete"><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center text-muted">Are you sure you want to delete this Posts?</h5>
                </div>
                <div class="card-body">

                <div class="shadow-lg">
                    <div class="user-block border-bottom">
                     <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                                     <?php if (!empty($school['profile_img'])) {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $school['profile_img'] ;?>" alt="User Image">
                                     <?php  }else{ ?>
                                       <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                     <?php } ?>
                               </div>
                            </div>
                        <span class="username">
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $school['firstname']." ".$school['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($school['created_on_']); ?></span>
                        </span>
                        <span class="description"></span>
                    </div> <!-- user-block -->

                    <div class="card flex-md-row shadow-sm h-md-100 border-0 mb-3">
                        <div class="col-md-4 px-0 card-img-left more" id="school-readmore" data-school="<?php echo $school['school_id'] ;?>">
                            <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC ;?>uploads/school/<?php echo $school['photo_']; ?>" alt="Card image cap">
                        </div><!-- col -->
                        <div class="col-md-8 card-body pt-0">
                            <h5 class="text-primary mb-3">
                            <a class="text-primary;" style="text-transform: capitalize;" href="javascript:void(0)"  id="school-readmore" data-school="<?php echo $school['school_id'] ;?>"><?php echo $school['title_'] ;?></a>
                            </h5>
                            <!-- <div class="text-muted">Created on < ?php echo $this->timeAgo($school['created_on_']) ;?> By < ?php echo $school['author_'] ;?> </div> -->
                            <p class="card-text mt-2 mb-1">
                                <?php if (strlen($school["text_"]) > 98) {
                                            echo $school["text_"] = substr($school["text_"],0,98).'...
                                            <span class="mb-0"><a href="javascript:void(0)" id="school-readmore" data-school="'.$school['school_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                            }else{
                                            echo $school["text_"];
                                            } ?>    
                            </p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                      
                </div><!-- shadow -->

                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it-car  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- recar-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- recar-popup -->

<?php
}
?>