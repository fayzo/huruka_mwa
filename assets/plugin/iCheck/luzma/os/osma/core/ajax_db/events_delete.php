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
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['created_on3']); ?></span>
                        </span>
                        <span class="description"></span>
                    </div> <!-- user-block -->
        
                        <div class="row">
                        <div class="col-md-12">
                        <div class="card flex-md-row mb-4 border-0 h-md-250" >
                        <img class="card-img-left flex-auto d-none d-lg-block" width="200px" height="250px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/Events/<?php echo $tweet['photo'] ;?>" alt="Card image cap">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
                            <a class="text-primary" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $tweet['events_id'] ;?>"> <?php echo  $tweet['title']; ?></a>
                            </h4>
                            <div class="mb-1 text-muted">Created on <?php echo $home->timeAgo($tweet['created_on3']) ;?> By <?php echo $tweet['authors'] ;?> </div>
                            <p class="mb-auto"> 
                            <?php 
                                if (strlen($tweet["additioninformation"]) > 200) {
                                    echo $tweet["additioninformation"] = substr($tweet["additioninformation"],0,200).'...<br><span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$tweet['events_id'].'" class="text-muted" style"font-weight: 500 !important;">Continue reading...</a></span>';
                                }else{
                                    echo $tweet["additioninformation"];
                                } ?> 
                            </p>
                                <ul class="list-inline mb-0" style="list-style-type: none;">  

                                    <?php if($tweet['events_id'] == $tweet['retweet_events_id']){ ?>
                                            <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweeted0 text-sm mr-2" data-events"'.$tweet['events_id'].'"  data-user="'.$tweet['user_id3'].'"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?>  >
                                            <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $user['retweet_counts'] ;?> </span></i></button></li>
                                    <?php }else{ ?>
                                            <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweet0 text-sm mr-2" data-events"'.$tweet['events_id'].'"  data-user="'.$tweet['user_id3'].'"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?>  >
                                            <?php if($tweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$tweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$tweet["retweet_counts"].'</span></i>';} ?>
                                    <?php } ?>

                                    <?php if($tweet['like_on'] == $tweet['events_id']){ ?>
                                        <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-events="<?php echo $tweet['events_id']; ?>" data-user="<?php echo $tweet['user_id']; ?>">
                                        <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?> </span></i></button></li>
                                    <?php }else{ ?>
                                        <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-events="<?php echo $tweet['events_id']; ?>" data-user="<?php echo $tweet['user_id']; ?>">
                                        <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></span></i></button></li>
                                    <?php } ?>

                                        <span class='text-right float-right'>
                                    
                                            <li  class="list-inline-item"><button class="comments-btn text-sm" data-toggle="collapse">
                                                <i class="fa fa-comments-o mr-1"></i> (5)
                                            </button></li>

                                        <?php if($_SESSION['key'] == $tweet['user_id3']){ ?>

                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                                <label class="deleteTweet" >Delete </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                            </span>
                                    </ul>
                        </div>
                        </div>
                    </div>
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