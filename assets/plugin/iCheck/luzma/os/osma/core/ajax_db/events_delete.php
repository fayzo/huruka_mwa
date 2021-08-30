<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$tweet_id= $_POST['deleteTweetHome'];
    $events->deleteLikesEvents($tweet_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$events_id= $_POST['showpopupdelete'];
	$events_user_id= $_POST['deleteEvents'];
    $tweet=$events->events_getPopupTweet($user_id,$events_id,$events_user_id);

    ?>
    <div class="events-popup">
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
                                    <?php if (!empty($tweet['profile_img'])) {?>
                                    <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $tweet['profile_img'] ;?>" alt="User Image">
                                    <?php  }else{ ?>
                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                    <?php } ?>
                            </div>
                        </div>
                        <span class="username">
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                        </span>
                        <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['created_on3']); ?></span>
                        <span class="description"></span>
                    </div> <!-- user-block -->
        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card flex-md-row mb-4 border-0 h-md-250" style="box-shadow:0 0 0.5ch 0.5ch rgba(35, 35, 32, 0.15);">
                                    <div class='col-md-4 px-0 card-img-left flex-auto' >
                                        <img class="pic-responsive " width="200px" height="250px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/events/<?php echo $tweet['photo'] ;?>" alt="Card image cap">
                                    </div>
                                    <div class="col-md-8 card-body d-flex flex-column align-items-start">
                                    
                                        <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
                                            <a class="text-primary text-left" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $tweet['events_id'] ;?>">
                                            <?php echo $tweet["name_place"]; ?>
                                            </a>
                                        </h4>

                                        <div class="mb-3 text-muted">Created on <?php echo $home->timeAgo($tweet['created_on3']) ;?> By <?php echo $tweet['authors'] ;?> </div>
                                        <p class="mb-auto"> 
                                            <?php 
                                                if (strlen($tweet["additioninformation"]) > 113) {
                                                echo $tweet["additioninformation"] = substr($tweet["additioninformation"],0,113).'... <span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$tweet['events_id'].'" style"font-weight: 500 !important;">Read more >>> </a></span>';
                                                }else{
                                                echo $tweet["additioninformation"];
                                                } ?> 
                                        </p>

                                        <div class="black-bg" style="padding:4px;border-radius:3px">
                                            ------------------------
                                            <div><i class="fa fa-map-marker" aria-hidden="true"></i> Avenue: <?php echo $tweet['location_events']; ?> </div>
                                            ------------------------
                                            <div><i class="fa fa-calendar text-success" aria-hidden="true"></i> Start event: <?php echo date('M j, Y', strtotime($tweet['start_events'])); ?> 
                                                <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $tweet['start_time']; ?> -->
                                            </div>
                                            ------------------------
                                            <div><i class="fa fa-calendar text-danger" aria-hidden="true"></i> End event: <?php echo date('M j, Y', strtotime($tweet['end_events'])); ?> 
                                                <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $tweet['end_time']; ?> -->
                                            </div>
                                            ------------------------
                                            <div><i class="fa fa-clock-o" aria-hidden="true"></i>  Posted on <?php echo $home->timeAgo($tweet['created_on3']); ?> </div>
                                            ------------------------
                                        </div>
                                    </div>
                                </div><!-- card -->
                        </div><!-- col -->
                     </div><!-- row -->
                </div><!-- shadow -->

                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it-events  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>