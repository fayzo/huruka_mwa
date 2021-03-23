<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$tweet_id= $_POST['deleteTweetHome'];
    $comment->deleteLikesNotificatPosts($tweet_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$tweet_id= $_POST['showpopupdelete'];
	$deleteTweet_id= $_POST['deleteTweet'];
    $tweet=$home->getPopupTweet($user_id,$tweet_id,$deleteTweet_id);
    ?>
    <div class="retweet-popup">
      <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap"  id="popupEnd">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header">
                    <span class="closeDelete"><button class="close-retweet-popup" onclick="togglePopup()"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center text-muted">Are you sure you want to delete this Posts?</h5>
                </div>
                <div class="card-body">

                    <div class="user-block">
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
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['username'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['posted_on']); ?></span>
                        </span>
                        
                <!-- TEXT -->
                <!-- TEXT -->
                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>

                <div id="link_" class="show-read-more">
                <?php 

                    if (strlen($tweet['status']) > 200) {
                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                    $tweettext = substr($tweet['status'], 0, 200);
                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                    <span class="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                    echo $home->getTweetLink($tweetstatus);
                    }else{
                    echo $home->getTweetLink($tweet['status']);
                    }  
                ?>

                <!-- TEXT -->
                <!-- TEXT -->
                <?php 
                //  if ($tweet['tweet_image'] == true) {

                $expodefile = explode("=",$tweet['tweet_image']);
                $title= $tweet["photo_Title"];
                $photo_title=  explode("=",$title);
                $fileActualExt= array();
                for ($i=0; $i < count($expodefile); ++$i) { 
                    $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
                }


                    $image= array('jpg','jpeg','png','gif');
                    $pdf= array('pdf');
                    $coins= array('coins');
                    $docx= array('doc','docx','lsx');
                    $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');

                    // $pathinfo = pathinfo($expode[$i])['extension'];

                    $fileActualExt_image =array_intersect($fileActualExt,$image);
                    $count_image =count(array_intersect($fileActualExt_image,$image));

                    $fileActualExt_pdf =array_intersect($fileActualExt,$pdf);
                    $count_pdf =count(array_intersect($fileActualExt_pdf,$pdf));
                
                    $fileActualExt_docx =array_intersect($fileActualExt,$docx);
                    $count_docx =count(array_intersect($fileActualExt_docx,$docx));
                    
                    $fileActualExt_coins =array_intersect($fileActualExt,$coins);
                    $count_coins =count(array_intersect($fileActualExt_docx,$coins));

                    $fileActualExt_mp4 =array_intersect($fileActualExt,$mp4);
                    $count_mp4 =count(array_intersect($fileActualExt_docx,$mp4));
                
                    // var_dump($array_image);
                    $allower_ext= array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip','coins','mp4'); // valid extensions
                    // $allower_ext= $mp4;

                    $expode = $expodefile;
                    $file_size = $tweet['tweet_image_size'];
                    $file_sizes = explode("=",$file_size);
                    $count = count($expodefile);
                    
                    if ($count == 1 ) {
                        $count_divide = "md-12 col-sm-12";
                    }else if ($count == 2 ){
                        $count_divide = "md-6 col-sm-12";
                    }else if ($count > 2 ){
                        $count_divide = "md-4 col-sm-12";
                    }


                    // var_dump($expode,$count);
                    
                    if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                        <div class="row">
                    <?php  
                    for ($i=0; $i < count($expode); ++$i) { ?>

                        <?php if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_docx)) { ?>
                            <div class="col-<?php echo $count_divide ;?>  my-2">

                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                    <div class="mailbox-attachment-info main-active">
                                        <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                        <!-- ||Sep2014-report.pdf -->
                                    </a>
                                        <span class="mailbox-attachment-size">
                                            <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                            <!-- 1,245 KB -->
                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                    class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                            </div>
                    <?php }
                    if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_pdf)) { ?>
                            <div class="col-<?php echo $count_divide ;?>  my-2">
                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                    <div class="mailbox-attachment-info main-active">
                                        <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                            <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                            <!-- || Sep2014-report.pdf -->
                                        </a>
                                        <span class="mailbox-attachment-size">
                                        <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                            <!-- 1,245 KB -->
                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                            </div>
                        <?php }
                        if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_image)) { ?>
                            <div class="col-<?php echo $count_divide ;?>  my-2">

                                    <span class="mailbox-attachment-icon has-img"><img 
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                
                                    <div class="mailbox-attachment-info main-active">
                                        <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                    <!-- || Sep2014-report.pdf -->
                                    </a>
                                        <span class="mailbox-attachment-size">
                                        <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                            <!-- 1,245 KB -->
                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                    class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                            </div>
                        <?php }
                        if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_coins)) { ?>
                            <div class="col-<?php echo $count_divide ;?>  my-2">
                                <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                                <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
                            </div>
                        <?php } 

                        if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp4)) { ?>
                            <div class="col-<?php echo $count_divide ;?>  my-2">
                            <div class="row">
                        
                            <div class="col-12">
                                    <video controls preload="auto" width="100px"  height="auto" >
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                    </video>
                                    
                            </div>
                            <div class="col-12">

                                    <div class="mailbox-attachment-info main-active" style="width:100%">
                                        <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                    <!-- || Sep2014-report.pdf -->
                                    </a>
                                        <span class="mailbox-attachment-size">
                                        <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                            <!-- 1,245 KB -->
                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                    class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                            </div>
                            </div>
                            </div>
                        <?php } 
                    
                        } ?> 
                        </div>
                    <?php } ?>

                <?php 
                if (strlen($tweet['status']) > 200) {
                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                    $tweettext = substr($tweet['status'], 0, 200);
                    $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                    echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$home->getTweetLink($tweetstatus).'</span>';
                }  
                ?>
                </div>
                    </div> <!-- user-block -->
                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>