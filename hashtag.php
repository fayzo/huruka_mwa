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
    $notific= $notification->getNotificationCount($user_id);
    $notification->notificationsView($user_id);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo '#'.$hashtag.' hashtag on Posts' ; ?></title>
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
                    	$tweets = $trending->getTweetsTrendbyhastag($hashtag);
                    	foreach ($tweets as $tweet) {
                            if (!empty($tweet['tweet_image'])) {
                                # code...
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                // $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                                // var_dump($comment);
                                // var_dump($tweet['tweet_id']);
                                     # code... 
                                    //  echo var_dump($retweet['retweet_Msg']).'<br>';
                                    
                                ?>
                                    <div class="card borders-tops mb-3" id="userComment_<?php echo $tweet["tweet_id"]; ?>"> 
                                    <div class="card-body message-color">
                                   
                                    <div class="post">

                                        <?php 
                                        if($retweet['retweet_id'] == $tweet["tweet_id"] || $tweet["retweet_id"] > 0){ ?>
                                        <span class="t-show-banner">
                                            <div class="t-show-banner-inner">
                                                <span><i class="fa fa-retweet "></i></span><span><?php echo $user['username'].' Shared';?></span>
                                            </div>
                                        </span>
                                        <?php } else{ echo '';}?>

                                        <?php if(!empty($retweet['retweet_Msg']) && $tweet["tweet_id"] == $retweet["retweet_id"] || $tweet["retweet_id"] > 0){ ?> 
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                            <div class="user-blockImg">
                                                <?php if (!empty($user['profile_img'])) {?>
                                                <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="user-image rounded-circle" alt="User Image">
                                                <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="user-image rounded-circle" alt="User Image">
                                                <?php } ?>
                                            </div>
                                            </div>

                                            <span class="username">
                                                <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                                <span class="description">Shared public - <?php echo $Posts_copyDraft->timeAgo($retweet['posted_on']); ?></span>
                                            </span>
                                            <span class="description"><?php echo $Posts_copyDraft->getTweetLink($retweet['retweet_Msg']); ?></span>
                                        </div>

                                        <div class="card retweetcolor t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>">
                                        <div class="card-body">

                                            <?php 
                                                $filename = $tweet['tweet_image'];
                                                $expodefile = explode("=",$tweet['tweet_image']);
                                                $fileActualExt= array();
                                                for ($i=0; $i < count($expodefile); ++$i) { 
                                                    $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                                                }

                                                $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'ocx','lsx', 'ppt','docx','xlsx'); // valid extensions
                                        if (array_diff($fileActualExt,$allower_ext) == false) {
                                                    $expode = explode("=",$tweet['tweet_image']); 
                                                    $count = count($expode); 
                                        $docx= array('jpg','jpeg','peg','png','gif','pdf');
                                        $pdf= array('jpg','jpeg','peg','png','gif');
                                        $image= array('pdf','doc','ocx','lsx'); ?>

                                        <?php if(array_diff($fileActualExt,$image)) { ?>

                                            <div class="row">
                                                <div class="col-6 ">

                                                <?php if ($count === 1) { ?>
                                                        <div class="row mb-1">
                                                            <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                                        <div class="col-12">
                                                            <img class="img-fluid"
                                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                                                                alt="Photo">
                                                        </div>
                                                        </div>

                                                <?php }else if($count == 2 || $count > 2){ ?>
                                                        <div class="row mb-2">
                                                            <?php 
                                                                $expode = explode("=",$tweet['tweet_image']);
                                                                $splice= array_splice($expode,0,2);
                                                                for ($i=0; $i < count($splice); ++$i) { 
                                                                ?>
                                                        <div class="col-6">
                                                            <img class="img-fluid mb-2"
                                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                                alt="Photo">
                                                        </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                                <span class="btn btn-primary btn-sm float-right" >View More photo  <i class="fa fa-picture-o"></i> >>></span>
                                                            </div>
                                                        </div>
                                                        <!-- /.row -->
                                                <?php } ?>
                                                    </div> <!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->
                                            </div><!-- row -->

                                            <?php  }else if(array_diff($fileActualExt,$docx)) { ?>

                                                    
                                                    <div class="row">
                                                <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { ?>

                                                        <div class="col-md-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                                <span class="mailbox-attachment-size">
                                                                    1,245 KB
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                            class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
                                                        </div><!-- col -->

                                                        <?php } ?>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                            <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                            <!-- //Jonathan Burke Jr. -->
                                                                        </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                    <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                </div><!-- row -->

                                        <?php }else if(array_diff($fileActualExt,$pdf)) { ?>

                                                    <div class="row">

                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { ?>

                                                        <div class="col-md-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                                <span class="mailbox-attachment-size">
                                                                    1,245 KB
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
                                                        </div><!-- col -->
                                                    <?php } ?>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                            <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                            <!-- //Jonathan Burke Jr. -->
                                                                        </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                    <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                </div><!-- row -->
                                                <?php } ?>

                                                <?php   }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp4') { ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <video controls preload="auto" width="100%" height="110px">
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/mp4"> 
                                                                <!-- <source src="video/boatride.webm" type="video/webm">  -->
                                                                    <!-- fallback content here -->
                                                            </video>
                                                        </div><!-- col -->
                                                        
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'webm'){ ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <video controls preload="auto" width="100%" height="360">
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/webm"> 
                                                                    <!-- fallback content herehere -->
                                                            </video>      
                                                        </div><!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp3'){ ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <audio controls>
                                                                <source src="50-Cent-Baby-By-Me-ft-Ne-Yo-128K-MP3.mp3" type="audio/mp3">
                                                                    <!-- fallback content here -->
                                                            </audio>
                                                        </div><!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'ogg'){ ?>
                                                        <audio controls>
                                                            <source src="audio/heavymetal.ogg" type="audio/ogg"> 
                                                                <!-- fallback content here -->
                                                        </audio>
                                                <?php }else { ?>
                                                        <div class="row">
                                                        <div class="col-12">

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
                                                                        <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                        <span class="description">Shared publicly - <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </span>
                                                                    <span class="description">
                                                                            <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                            <div id="link_" class="show-read-more">
                                                                            <?php 

                                                                                if (strlen($tweet['status']) > 200) {
                                                                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                                $tweettext = substr($tweet['status'], 0, 200);
                                                                                $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                                <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                                echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                                }else{
                                                                                echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                                }  
                                                                                if (strlen($tweet['status']) > 200) {
                                                                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                                    $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                                    echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                                }  
                                                                            ?>
                                                                            </div>
                                                                        </span>
                                                                </div>

                                                            </div><!-- col -->
                                                        </div><!-- row -->

                                                <?php } ?>

                                        </div><!-- card-body -->
                                        </div><!-- card -->

                                        <?php }else { ?> 

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
                                            <span class="username tooltips">

                                            <?php if($user_id != $tweet['user_id']) { ?> 
                                                    <ul><li>
                                                        <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>" ><?php echo $tweet['username'] ;?></a>
                                                        <!-- <ul><li>< ?php echo Follow::tooltipProfile($tweet['user_id'],$user_id,$tweet['user_id']); ?></li></ul> -->
                                                        </li>
                                                    </ul>
                                                    <?php }else{ ?>
                                                        <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>" ><?php echo $tweet['username'] ;?></a>
                                                    <?php } ?> 

                                            </span>
                                            <span class="description">Shared publicly - <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                        </div>
                                        <!-- /.user-block -->

                                        <!-- TEXT -->
                                        <!-- TEXT -->
                                        <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>

                                        <div id="link_" class="show-read-more">
                                        <?php 

                                            if (strlen($tweet['status']) > 200) {
                                                // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                            $tweettext = substr($tweet['status'], 0, 200);
                                            $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                            echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                            }else{
                                            echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                            }  
                                        ?>

                                        <!-- TEXT -->
                                        <!-- TEXT -->
                                        <?php 
                                        $expodefile = explode("=",$tweet['tweet_image']);
                                        $title= $tweet["photo_Title"];
                                        $photo_title=  explode("=",$title);
                                        $fileActualExt= array();
                                        for ($i=0; $i < count($expodefile); ++$i) { 
                                            $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                                        }
                                        $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','ocx','lsx'); // valid extensions

                                        if (array_diff($fileActualExt,$allower_ext) == false) {
                                            $expode = explode("=",$tweet['tweet_image']);
                                            $count = count($expode); ?>

                                        <?php 
                                        $docx= array('jpg','jpeg','peg','png','gif','pdf');
                                        $pdf= array('jpg','jpeg','peg','png','gif');
                                        $image= array('pdf','doc','ocx','lsx'); ?>

                                        <?php if(array_diff($fileActualExt,$image)) { 

                                        if ($count === 1) { ?>

                                        <div class="row mb-1">
                                                <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                            <div class="col-12 more">
                                                <img class="img-fluid imagePopup"
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                                
                                                    <div><i><?php echo $photo_title[0]; ?></i></div>
                                            
                                            </div>
                                        </div>

                                        <?php
                                        }else if($count === 2){?>
                                            <div class="row mb-2 more">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-6">
                                                    <img class="img-fluid mb-2 imagePopup"
                                                        src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                        alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                    <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                </div>
                                                    <?php }?>
                                            </div>

                                        <?php }else if($count === 3 || $count > 3){?>
                                        <div class="row mb-2 more">
                                                <?php $expode = explode("=",$tweet['tweet_image']);
                                                $splice= array_splice($expode,0,1);
                                                ?>
                                            <div class="col-6">
                                                <img class="img-fluid mb-2 imagePopup"
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                    <div><i><?php echo $photo_title[0]; ?></i></div>

                                            </div>
                                            <!-- /.col -->

                                            <div class="col-6">
                                                <div class="row mb-2 more">
                                                        <?php 
                                                        $expode = explode("=",$tweet['tweet_image']);
                                                        // var_dump($expode);
                                                        $splice= array_splice($expode,1,2);
                                                        // var_dump($splice);
                                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                                    <div class="col-6">
                                                        <img class="img-fluid mb-2 imagePopup"
                                                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                        <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                    </div>
                                                        <?php }?>

                                                </div>
                                                <!-- /.row -->
                                                <div class="row more">
                                                        <?php 
                                                        $expode = explode("=",$tweet['tweet_image']);
                                                        $splice= array_splice($expode,3,2);
                                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                                    <div class="col-6">
                                                        <img class="img-fluid mb-2 imagePopup"
                                                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                                        
                                                        <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                    </div>
                                                        <?php }?>

                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- /.row -->
                                        <div class="row">
                                        <div class="col-12">
                                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                        
                                        <?php } 

                                        }else if(array_diff($fileActualExt,$docx)) { 

                                        //Columns must be a factor of 12 (1,2,3,4,6,12)
                                        $rowCount = 0;
                                        switch ($count) {
                                            case 1:
                                                $numOfCols = 1; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <?php 
                                            break;
                                        case 2:
                                                # code...
                                                $numOfCols = 2; ?>

                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 3:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 4:
                                                # code...
                                                $numOfCols = 2; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break; 
                                            case 5:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            
                                            <?php
                                                break; 
                                            case 6:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo $numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                                </div>
                                            </div>
                                        <!-- /.row -->
                                            <?php
                                                break;
                                        }

                                        }else if(array_diff($fileActualExt,$pdf)) { 

                                        //Columns must be a factor of 12 (1,2,3,4,6,12)
                                        $rowCount = 0;
                                        switch ($count) {
                                            case 1:
                                                $numOfCols = 1; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <?php 
                                            break;
                                        case 2:
                                                # code...
                                                $numOfCols = 2; ?>

                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 3:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 4:
                                                # code...
                                                $numOfCols = 2; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break; 
                                            case 5:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            
                                            <?php
                                                break; 
                                            case 6:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo $numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                                </div>
                                            </div>
                                        <!-- /.row -->
                                            <?php
                                                break;
                                        }

                                        } ?>
                                        
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp4') { ?>

                                        <div class="row mb-2" >
                                        <div class="col-12" >
                                            <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                        <video controls preload="auto" width="100%" height="280px">
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0];?>" type="video/mp4"> 
                                            <!-- <source src="video/boatride.webm" type="video/webm">  -->
                                                <!-- fallback content here -->
                                        </video>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'webm'){ ?>
                                        <div class="row mb-2">
                                        <div class="col-12">
                                        <video controls poster="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" width="auto" height="auto">
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/webm"> 
                                                <!-- fallback content herehere -->
                                        </video>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp3'){ ?>
                                        <div class="row mb-2">
                                        <div class="col-12">
                                        <audio controls>
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/mp3">
                                                <!-- fallback content here -->
                                        </audio>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'ogg'){ ?>
                                        <audio controls>
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/ogg"> 
                                                <!-- fallback content here -->
                                        </audio>
                                        <?php }?>

                                        <?php 
                                        if (strlen($tweet['status']) > 200) {
                                            // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                            $tweettext = substr($tweet['status'], 0, 200);
                                            $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                            echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                        }  
                                        ?>
                                        </div>
                                        <!--   <p id="link_">
                                            < ?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                        </p> -->

                                        <?php }?>

                                        <ul class="mt-2 list-inline" style="list-style-type: none; margin-bottom:10px;">  
                                            <?php if(isset($_SESSION['key']) && $_SESSION['approval'] === 'on'){ ?>
                                            <?php if($tweet['tweet_id'] == $retweet['retweet_id']){ ?>
                                            <li class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="share-btn retweeted text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                            <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet["retweet_counts"];?></span></i>
                                                Share</button></li>
                                            <?php }else{ ?>

                                                <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="share-btn retweet text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>   data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?>
                                                    Share</button></li>

                                            <?php } } ?>
                                                <?php if($likes['like_on'] == $tweet['tweet_id']){ ?>
                                                    <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="unlike-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?> data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                        Like</button></li>

                                                <?php }else{ ?>
                                                    <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="like-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                        Like</button></li>
                                                <?php } ?>
                                            
                                            <span style="float:right">

                                            <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="comments-btn text-sm" data-toggle="collapse"':'class="text-sm" id="login-please" data-login="1"' ;?> data-target="#a<?php echo  $tweet["tweet_id"];?>" >
                                                <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)
                                            </button></li>
                                            

                                            <?php if (isset($_SESSION['key']) && $tweet["tweetBy"] == $user_id){ ?>
                                                <li  class=" list-inline-item">
                                                    <ul class="deleteButt text-sm" style="list-style-type: none; margin:0px;" >
                                                        <li>
                                                        <a href="javascript:void(0)" class="more" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                            <ul style="list-style-type: none; margin:0px;" >
                                                                <li style="list-style-type: none; margin:0px;"> 
                                                                    <label class="deleteTweet" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["tweetBy"];?>" >Delete </label>
                                                            </li>
                                                        </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php }else{ echo '';}?>
                                            </span>
                                        </ul>

                                        <div class="input-group">
                                        <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                                            name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>" >
                                        <div class="input-group-append">
                                            <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                aria-label="Username" aria-describedby="basic-addon1" <?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id'];?>">
                                                <span class="fa fa-arrow-right text-muted" ></span>
                                            </span>
                                        </div>
                                        </div> <!-- input-group -->

                                        <div class="card collapse" id="a<?php echo  $tweet["tweet_id"];?>">
                                        <div class="card-body" style="padding-right:0">
                                            <?php if (!empty($comment)) { ?>
                                            <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                            <span id='responseDeletePostSeconds0'></span>

                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                            <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                            <?php foreach ($comment as $comments) { 
                                                $second_likes= $Posts_copyDraft->Like_second($user_id,$comments['comment_id']);
                                                $dislikes= $Posts_copyDraft->dislike($user_id,$comments['comment_id']);
                                                ?>
                                                    <!-- Conversations are loaded here -->
                                                    <!-- Message. Default to the left -->
                                                        <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                            <div class="direct-chat-info clearfix">
                                                                <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                                <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments['comment_at']); ?></span>
                                                            </div>
                                                            <!-- /.direct-chat-info -->
                                                            <?php if (!empty($comments["profile_img"])) {?>
                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                            <?php  }else{ ?>
                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                            <?php } ?>
                                                            <!-- /.direct-chat-img -->
                                                            <div class="direct-chat-text">
                                                            <?php echo  $Posts_copyDraft->getTweetLink($comments["comment"]) ;?>
                                                        <!-- /.direct-chat-text -->
                                                        <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                                                        
                                                            <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                                                    <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                                            <?php }else{ ?>
                                                                    <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                                            <?php } ?>

                                                            <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                                                <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                                                    unlike</button></li>

                                                            <?php }else{ ?>
                                                                <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                                                        unlike</button></li>
                                                            <?php } ?>

                                                            <span style="float:right">
                                                                                
                                                            <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                                                <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)
                                                            </button></li>
                                                                        
                                                                <?php if ($comments["comment_by"] == $user_id){ ?>
                                                                <li  class=" list-inline-item">
                                                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                            <ul style="list-style-type: none; margin:0px;" >
                                                                                <li style="list-style-type: none; margin:0px;"> 
                                                                                    <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <?php }else{ echo '';}?>
                                                                </span>
                                                            </ul>
                                                        </div>
                                                        
                                                        <div class="card collapse border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                                            <div class="card-header pb-0 px-0">
                                                                <div class="input-group">
                                                                    <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                                                        name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                                            <span class="fa fa-arrow-right text-muted" ></span>
                                                                        </span>
                                                                    </div>
                                                                </div> <!-- input-group -->
                                                            </div>
                                                            <div class="card-body" style="padding-right:0">
                                                                <?php 
                                                                $comment_second= $Posts_copyDraft->comments_second($comments['comment_id']);
                                                                if (!empty($comment_second)) { ?>
                                                                <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                                <span id='responseDeletePostSecond'></span>
                                                                <div class="direct-chat-message direct-chat-messageS large-2" >
                                                                <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                                <?php foreach ($comment_second as $comments0) { ?>
                                                                        <!-- Conversations are loaded here -->
                                                                        <!-- Message. Default to the left -->
                                                                            <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                                <div class="direct-chat-info clearfix">
                                                                                    <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                    <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments0['comment_at_']); ?></span>
                                                                                </div>
                                                                                <!-- /.direct-chat-info -->
                                                                                <?php if (!empty($comments0["profile_img"])) { ?>
                                                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                                <?php  }else{ ?>
                                                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                                <?php } ?>
                                                                                <!-- /.direct-chat-img -->
                                                                                <div class="direct-chat-text">
                                                                                    <?php echo  $Posts_copyDraft->getTweetLink($comments0["comment_"]) ;?>
                                                                                    <!-- /.direct-chat-text -->
                                                                                    <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                                            <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                                            <li  class=" list-inline-item">
                                                                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                                                    <li>
                                                                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                                                        <ul style="list-style-type: none; margin:0px;" >
                                                                                                            <li style="list-style-type: none; margin:0px;"> 
                                                                                                                <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <?php }else{ echo '';}?>
                                                                                            </span>
                                                                                        </ul>
                                                                                </div>
                                                                            </div> <!-- /.direct-chat-messg -->
                                                                    
                                                                    <?php } ?>
                                                                </span>
                                                            </div> <!-- /.direct-chat-message -->
                                                        <?php } ?>

                                                        </div> <!-- /.card-body-->
                                                        </div> <!-- /.card collapse -->
                                                    </div> <!-- /.direct-chat-msg -->
                                            <?php } ?>
                                            </span>
                                            </div> <!-- /.direct-message -->
                                            <?php } ?>
                                        </div> <!-- /.card-body-->
                                        </div> <!-- /.card collapse -->

                                        </div>
                                        <!-- /.post -->
                             </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card-end -->
                    
                      <!-- < ?php }else { ? >
                          <div class="container">
                              <div class="row">

                                  <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header main-active py-2 text-center">
                                            <h4 class="card-title">No photos</h4>
                                        </div>
                                        <img class="card-img-top" src="< ?php echo BASE_URL_LINK.NO_PHOTO ;? >" alt="">
                                    </div>
                                  </div>
                                  
                              </div>
                          </div>  -->
                    <?php }

                     } ?>
                    <!-- < ?php } ?> -->
                    <!-- TWEETS IMAGES -->
                    <?php 
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
                                          <h5 class="user-username-follow"><small><?php echo $home->getTweetLink($account['career']) ;?></small></h5>
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
                    	 foreach ($tweets as $tweet) {
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                // $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                                // var_dump($comment);
                                // var_dump($tweet['tweet_id']);
                                     # code... 
                                    //  echo var_dump($retweet['retweet_Msg']).'<br>';
                                    
                                ?>
                                    <div class="card borders-tops mb-3" id="userComment_<?php echo $tweet["tweet_id"]; ?>"> 
                                    <div class="card-body message-color">
                                   
                                    <div class="post">

                                        <?php 
                                        if($retweet['retweet_id'] == $tweet["tweet_id"] || $tweet["retweet_id"] > 0){ ?>
                                        <span class="t-show-banner">
                                            <div class="t-show-banner-inner">
                                                <span><i class="fa fa-retweet "></i></span><span><?php echo $user['username'].' Shared';?></span>
                                            </div>
                                        </span>
                                        <?php } else{ echo '';}?>

                                        <?php if(!empty($retweet['retweet_Msg']) && $tweet["tweet_id"] == $retweet["retweet_id"] || $tweet["retweet_id"] > 0){ ?> 
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                            <div class="user-blockImg">
                                                <?php if (!empty($user['profile_img'])) {?>
                                                <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="user-image rounded-circle" alt="User Image">
                                                <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="user-image rounded-circle" alt="User Image">
                                                <?php } ?>
                                            </div>
                                            </div>

                                            <span class="username">
                                                <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                                <span class="description">Shared public - <?php echo $Posts_copyDraft->timeAgo($retweet['posted_on']); ?></span>
                                            </span>
                                            <span class="description"><?php echo $Posts_copyDraft->getTweetLink($retweet['retweet_Msg']); ?></span>
                                        </div>

                                        <div class="card retweetcolor t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>">
                                        <div class="card-body">

                                            <?php 
                                                $filename = $tweet['tweet_image'];
                                                $expodefile = explode("=",$tweet['tweet_image']);
                                                $fileActualExt= array();
                                                for ($i=0; $i < count($expodefile); ++$i) { 
                                                    $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                                                }

                                                $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'ocx','lsx', 'ppt','docx','xlsx'); // valid extensions
                                        if (array_diff($fileActualExt,$allower_ext) == false) {
                                                    $expode = explode("=",$tweet['tweet_image']); 
                                                    $count = count($expode); 
                                        $docx= array('jpg','jpeg','peg','png','gif','pdf');
                                        $pdf= array('jpg','jpeg','peg','png','gif');
                                        $image= array('pdf','doc','ocx','lsx'); ?>

                                        <?php if(array_diff($fileActualExt,$image)) { ?>

                                            <div class="row">
                                                <div class="col-6 ">

                                                <?php if ($count === 1) { ?>
                                                        <div class="row mb-1">
                                                            <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                                        <div class="col-12">
                                                            <img class="img-fluid"
                                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                                                                alt="Photo">
                                                        </div>
                                                        </div>

                                                <?php }else if($count == 2 || $count > 2){ ?>
                                                        <div class="row mb-2">
                                                            <?php 
                                                                $expode = explode("=",$tweet['tweet_image']);
                                                                $splice= array_splice($expode,0,2);
                                                                for ($i=0; $i < count($splice); ++$i) { 
                                                                ?>
                                                        <div class="col-6">
                                                            <img class="img-fluid mb-2"
                                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                                alt="Photo">
                                                        </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                                <span class="btn btn-primary btn-sm float-right" >View More photo  <i class="fa fa-picture-o"></i> >>></span>
                                                            </div>
                                                        </div>
                                                        <!-- /.row -->
                                                <?php } ?>
                                                    </div> <!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->
                                            </div><!-- row -->

                                            <?php  }else if(array_diff($fileActualExt,$docx)) { ?>

                                                    
                                                    <div class="row">
                                                <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { ?>

                                                        <div class="col-md-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                                <span class="mailbox-attachment-size">
                                                                    1,245 KB
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                            class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
                                                        </div><!-- col -->

                                                        <?php } ?>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                            <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                            <!-- //Jonathan Burke Jr. -->
                                                                        </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                    <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                </div><!-- row -->

                                        <?php }else if(array_diff($fileActualExt,$pdf)) { ?>

                                                    <div class="row">

                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { ?>

                                                        <div class="col-md-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                                <span class="mailbox-attachment-size">
                                                                    1,245 KB
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
                                                        </div><!-- col -->
                                                    <?php } ?>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                            <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                            <!-- //Jonathan Burke Jr. -->
                                                                        </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                    <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                </div><!-- row -->
                                                <?php } ?>

                                                <?php   }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp4') { ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <video controls preload="auto" width="100%" height="110px">
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/mp4"> 
                                                                <!-- <source src="video/boatride.webm" type="video/webm">  -->
                                                                    <!-- fallback content here -->
                                                            </video>
                                                        </div><!-- col -->
                                                        
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'webm'){ ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <video controls preload="auto" width="640" height="360">
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/webm"> 
                                                                    <!-- fallback content herehere -->
                                                            </video>      
                                                        </div><!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp3'){ ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <audio controls>
                                                                <source src="50-Cent-Baby-By-Me-ft-Ne-Yo-128K-MP3.mp3" type="audio/mp3">
                                                                    <!-- fallback content here -->
                                                            </audio>
                                                        </div><!-- col -->

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                                        <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                    </span>
                                                                        <span class="description">Shared publicly -  <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                </div>
                                                            </div> <!-- col -->

                                                            <div class="col-12" style="clear:both">
                                                                <!-- STATUS -->
                                                                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                <div id="link_" class="show-read-more">
                                                                <?php 

                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                    }  
                                                                ?>
                                                                <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                </div>
                                                            </div><!-- col -->
                                                            
                                                        </div><!-- row -->
                                                    </div><!-- col -->

                                                    </div><!-- row -->
                                                <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'ogg'){ ?>
                                                        <audio controls>
                                                            <source src="audio/heavymetal.ogg" type="audio/ogg"> 
                                                                <!-- fallback content here -->
                                                        </audio>
                                                <?php }else { ?>
                                                        <div class="row">
                                                        <div class="col-12">

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
                                                                        <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                                                        <!-- //Jonathan Burke Jr. -->
                                                                        <span class="description">Shared publicly - <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                                                    </span>
                                                                    <span class="description">
                                                                            <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                            <div id="link_" class="show-read-more">
                                                                            <?php 

                                                                                if (strlen($tweet['status']) > 200) {
                                                                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                                $tweettext = substr($tweet['status'], 0, 200);
                                                                                $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                                <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                                echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                                                                }else{
                                                                                echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                                                                }  
                                                                                if (strlen($tweet['status']) > 200) {
                                                                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                                    $tweettext = substr($tweet['status'], 0, 200);
                                                                                    $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                                    echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                                                                }  
                                                                            ?>
                                                                            </div>
                                                                        </span>
                                                                </div>

                                                            </div><!-- col -->
                                                        </div><!-- row -->

                                                <?php } ?>

                                        </div><!-- card-body -->
                                        </div><!-- card -->

                                        <?php }else { ?> 

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
                                            <span class="username tooltips">

                                            <?php if($user_id != $tweet['user_id']) { ?> 
                                                    <ul><li>
                                                        <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>" ><?php echo $tweet['username'] ;?></a>
                                                        <!-- <ul><li>< ?php echo Follow::tooltipProfile($tweet['user_id'],$user_id,$tweet['user_id']); ?></li></ul> -->
                                                        </li>
                                                    </ul>
                                                    <?php }else{ ?>
                                                        <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>" ><?php echo $tweet['username'] ;?></a>
                                                    <?php } ?> 

                                            </span>
                                            <span class="description">Shared publicly - <?php echo $Posts_copyDraft->timeAgo($tweet['posted_on']); ?></span>
                                        </div>
                                        <!-- /.user-block -->

                                        <!-- TEXT -->
                                        <!-- TEXT -->
                                        <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>

                                        <div id="link_" class="show-read-more">
                                        <?php 

                                            if (strlen($tweet['status']) > 200) {
                                                // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                            $tweettext = substr($tweet['status'], 0, 200);
                                            $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                            echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                            }else{
                                            echo $Posts_copyDraft->getTweetLink($tweet['status']);
                                            }  
                                        ?>

                                        <!-- TEXT -->
                                        <!-- TEXT -->
                                        <?php 
                                        $expodefile = explode("=",$tweet['tweet_image']);
                                        $title= $tweet["photo_Title"];
                                        $photo_title=  explode("=",$title);
                                        $fileActualExt= array();
                                        for ($i=0; $i < count($expodefile); ++$i) { 
                                            $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                                        }
                                        $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','ocx','lsx'); // valid extensions

                                        if (array_diff($fileActualExt,$allower_ext) == false) {
                                            $expode = explode("=",$tweet['tweet_image']);
                                            $count = count($expode); ?>

                                        <?php 
                                        $docx= array('jpg','jpeg','peg','png','gif','pdf');
                                        $pdf= array('jpg','jpeg','peg','png','gif');
                                        $image= array('pdf','doc','ocx','lsx'); ?>

                                        <?php if(array_diff($fileActualExt,$image)) { 

                                        if ($count === 1) { ?>

                                        <div class="row mb-1">
                                                <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                            <div class="col-12 more">
                                                <img class="img-fluid imagePopup"
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                                
                                                    <div><i><?php echo $photo_title[0]; ?></i></div>
                                            
                                            </div>
                                        </div>

                                        <?php
                                        }else if($count === 2){?>
                                            <div class="row mb-2 more">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,0,2);
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-6">
                                                    <img class="img-fluid mb-2 imagePopup"
                                                        src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                        alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                    <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                </div>
                                                    <?php }?>
                                            </div>

                                        <?php }else if($count === 3 || $count > 3){?>
                                        <div class="row mb-2 more">
                                                <?php $expode = explode("=",$tweet['tweet_image']);
                                                $splice= array_splice($expode,0,1);
                                                ?>
                                            <div class="col-6">
                                                <img class="img-fluid mb-2 imagePopup"
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                    <div><i><?php echo $photo_title[0]; ?></i></div>

                                            </div>
                                            <!-- /.col -->

                                            <div class="col-6">
                                                <div class="row mb-2 more">
                                                        <?php 
                                                        $expode = explode("=",$tweet['tweet_image']);
                                                        // var_dump($expode);
                                                        $splice= array_splice($expode,1,2);
                                                        // var_dump($splice);
                                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                                    <div class="col-6">
                                                        <img class="img-fluid mb-2 imagePopup"
                                                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">

                                                        <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                    </div>
                                                        <?php }?>

                                                </div>
                                                <!-- /.row -->
                                                <div class="row more">
                                                        <?php 
                                                        $expode = explode("=",$tweet['tweet_image']);
                                                        $splice= array_splice($expode,3,2);
                                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                                    <div class="col-6">
                                                        <img class="img-fluid mb-2 imagePopup"
                                                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                                        
                                                        <div><i><?php echo $photo_title[$i]; ?></i></div>

                                                    </div>
                                                        <?php }?>

                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- /.row -->
                                        <div class="row">
                                        <div class="col-12">
                                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                        
                                        <?php } 

                                        }else if(array_diff($fileActualExt,$docx)) { 

                                        //Columns must be a factor of 12 (1,2,3,4,6,12)
                                        $rowCount = 0;
                                        switch ($count) {
                                            case 1:
                                                $numOfCols = 1; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <?php 
                                            break;
                                        case 2:
                                                # code...
                                                $numOfCols = 2; ?>

                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 3:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 4:
                                                # code...
                                                $numOfCols = 2; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break; 
                                            case 5:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            
                                            <?php
                                                break; 
                                            case 6:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo $numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                    class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                                </div>
                                            </div>
                                        <!-- /.row -->
                                            <?php
                                                break;
                                        }

                                        }else if(array_diff($fileActualExt,$pdf)) { 

                                        //Columns must be a factor of 12 (1,2,3,4,6,12)
                                        $rowCount = 0;
                                        switch ($count) {
                                            case 1:
                                                $numOfCols = 1; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <?php 
                                            break;
                                        case 2:
                                                # code...
                                                $numOfCols = 2; ?>

                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 3:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break;
                                            case 4:
                                                # code...
                                                $numOfCols = 2; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            }
                                            ?>
                                            </div> <?php
                                                break; 
                                            case 5:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo 12/$numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            
                                            <?php
                                                break; 
                                            case 6:
                                                # code...
                                                $numOfCols = 3; ?>
                                                <div class="row">
                                                    <?php $expode = explode("=",$tweet['tweet_image']);
                                                    // $splice= array_splice($expode,0,2);
                                                    $splice= $expode;
                                                    for ($i=0; $i < count($splice); ++$i) { 
                                                    ?>
                                                <div class="col-md-<?php echo $numOfCols; ?>">
                                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                        <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                                        <span class="mailbox-attachment-size">
                                                            1,245 KB
                                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                        </span>
                                                    </div>
                                                </div><!-- col -->
                                            <?php
                                                $rowCount++;
                                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                            } ?>
                                            </div> 
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                                                </div>
                                            </div>
                                        <!-- /.row -->
                                            <?php
                                                break;
                                        }

                                        } ?>
                                        
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp4') { ?>

                                        <div class="row mb-2" >
                                        <div class="col-12" >
                                            <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                        <video controls poster="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>" width="500px" height="280px">
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0];?>" type="video/mp4"> 
                                            <!-- <source src="video/boatride.webm" type="video/webm">  -->
                                                <!-- fallback content here -->
                                        </video>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'webm'){ ?>
                                        <div class="row mb-2">
                                        <div class="col-12">
                                        <video controls poster="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" width="auto" height="auto">
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/webm"> 
                                                <!-- fallback content herehere -->
                                        </video>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp3'){ ?>
                                        <div class="row mb-2">
                                        <div class="col-12">
                                        <audio controls>
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/mp3">
                                                <!-- fallback content here -->
                                        </audio>
                                        </div>
                                        </div>
                                        <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'ogg'){ ?>
                                        <audio controls>
                                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/ogg"> 
                                                <!-- fallback content here -->
                                        </audio>
                                        <?php }?>

                                        <?php 
                                        if (strlen($tweet['status']) > 200) {
                                            // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                            $tweettext = substr($tweet['status'], 0, 200);
                                            $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                            echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$Posts_copyDraft->getTweetLink($tweetstatus).'</span>';
                                        }  
                                        ?>
                                        </div>
                                        <!--   <p id="link_">
                                            < ?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                        </p> -->

                                        <?php }?>

                                        <ul class="mt-2 list-inline" style="list-style-type: none; margin-bottom:10px;">  
                                            <?php if(isset($_SESSION['key']) && $_SESSION['approval'] === 'on'){ ?>
                                            <?php if($tweet['tweet_id'] == $retweet['retweet_id']){ ?>
                                            <li class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="share-btn retweeted text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                            <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet["retweet_counts"];?></span></i>
                                                Share</button></li>
                                            <?php }else{ ?>

                                                <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="share-btn retweet text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>   data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?>
                                                    Share</button></li>

                                            <?php } } ?>
                                                <?php if($likes['like_on'] == $tweet['tweet_id']){ ?>
                                                    <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="unlike-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?> data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                        Like</button></li>

                                                <?php }else{ ?>
                                                    <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="like-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                    <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                        Like</button></li>
                                                <?php } ?>
                                            
                                            <span style="float:right">

                                            <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="comments-btn text-sm" data-toggle="collapse"':'class="text-sm" id="login-please" data-login="1"' ;?> data-target="#a<?php echo  $tweet["tweet_id"];?>" >
                                                <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)
                                            </button></li>
                                            

                                            <?php if (isset($_SESSION['key']) && $tweet["tweetBy"] == $user_id){ ?>
                                                <li  class=" list-inline-item">
                                                    <ul class="deleteButt text-sm" style="list-style-type: none; margin:0px;" >
                                                        <li>
                                                        <a href="javascript:void(0)" class="more" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                            <ul style="list-style-type: none; margin:0px;" >
                                                                <li style="list-style-type: none; margin:0px;"> 
                                                                    <label class="deleteTweet" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["tweetBy"];?>" >Delete </label>
                                                            </li>
                                                        </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php }else{ echo '';}?>
                                            </span>
                                        </ul>

                                        <div class="input-group">
                                        <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                                            name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>" >
                                        <div class="input-group-append">
                                            <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                aria-label="Username" aria-describedby="basic-addon1" <?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id'];?>">
                                                <span class="fa fa-arrow-right text-muted" ></span>
                                            </span>
                                        </div>
                                        </div> <!-- input-group -->

                                        <div class="card collapse" id="a<?php echo  $tweet["tweet_id"];?>">
                                        <div class="card-body" style="padding-right:0">
                                            <?php if (!empty($comment)) { ?>
                                            <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                            <span id='responseDeletePostSeconds0'></span>

                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                            <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                            <?php foreach ($comment as $comments) { 
                                                $second_likes= $Posts_copyDraft->Like_second($user_id,$comments['comment_id']);
                                                $dislikes= $Posts_copyDraft->dislike($user_id,$comments['comment_id']);
                                                ?>
                                                    <!-- Conversations are loaded here -->
                                                    <!-- Message. Default to the left -->
                                                        <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                            <div class="direct-chat-info clearfix">
                                                                <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                                <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments['comment_at']); ?></span>
                                                            </div>
                                                            <!-- /.direct-chat-info -->
                                                            <?php if (!empty($comments["profile_img"])) {?>
                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                            <?php  }else{ ?>
                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                            <?php } ?>
                                                            <!-- /.direct-chat-img -->
                                                            <div class="direct-chat-text">
                                                            <?php echo  $Posts_copyDraft->getTweetLink($comments["comment"]) ;?>
                                                        <!-- /.direct-chat-text -->
                                                        <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                                                        
                                                            <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                                                    <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                                            <?php }else{ ?>
                                                                    <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                                            <?php } ?>

                                                            <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                                                <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                                                    unlike</button></li>

                                                            <?php }else{ ?>
                                                                <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                    <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                                                        unlike</button></li>
                                                            <?php } ?>

                                                            <span style="float:right">
                                                                                
                                                            <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                                                <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)
                                                            </button></li>
                                                                        
                                                                <?php if ($comments["comment_by"] == $user_id){ ?>
                                                                <li  class=" list-inline-item">
                                                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                            <ul style="list-style-type: none; margin:0px;" >
                                                                                <li style="list-style-type: none; margin:0px;"> 
                                                                                    <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <?php }else{ echo '';}?>
                                                                </span>
                                                            </ul>
                                                        </div>
                                                        
                                                        <div class="card collapse border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                                            <div class="card-header pb-0 px-0">
                                                                <div class="input-group">
                                                                    <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                                                        name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                                            <span class="fa fa-arrow-right text-muted" ></span>
                                                                        </span>
                                                                    </div>
                                                                </div> <!-- input-group -->
                                                            </div>
                                                            <div class="card-body" style="padding-right:0">
                                                                <?php 
                                                                $comment_second= $Posts_copyDraft->comments_second($comments['comment_id']);
                                                                if (!empty($comment_second)) { ?>
                                                                <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                                <span id='responseDeletePostSecond'></span>
                                                                <div class="direct-chat-message direct-chat-messageS large-2" >
                                                                <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                                <?php foreach ($comment_second as $comments0) { ?>
                                                                        <!-- Conversations are loaded here -->
                                                                        <!-- Message. Default to the left -->
                                                                            <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                                <div class="direct-chat-info clearfix">
                                                                                    <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                    <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments0['comment_at_']); ?></span>
                                                                                </div>
                                                                                <!-- /.direct-chat-info -->
                                                                                <?php if (!empty($comments0["profile_img"])) { ?>
                                                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                                <?php  }else{ ?>
                                                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                                <?php } ?>
                                                                                <!-- /.direct-chat-img -->
                                                                                <div class="direct-chat-text">
                                                                                    <?php echo  $Posts_copyDraft->getTweetLink($comments0["comment_"]) ;?>
                                                                                    <!-- /.direct-chat-text -->
                                                                                    <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                                            <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                                            <li  class=" list-inline-item">
                                                                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                                                    <li>
                                                                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                                                        <ul style="list-style-type: none; margin:0px;" >
                                                                                                            <li style="list-style-type: none; margin:0px;"> 
                                                                                                                <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <?php }else{ echo '';}?>
                                                                                            </span>
                                                                                        </ul>
                                                                                </div>
                                                                            </div> <!-- /.direct-chat-messg -->
                                                                    
                                                                    <?php } ?>
                                                                </span>
                                                            </div> <!-- /.direct-chat-message -->
                                                        <?php } ?>

                                                        </div> <!-- /.card-body-->
                                                        </div> <!-- /.card collapse -->
                                                    </div> <!-- /.direct-chat-msg -->
                                            <?php } ?>
                                            </span>
                                            </div> <!-- /.direct-message -->
                                            <?php } ?>
                                        </div> <!-- /.card-body-->
                                        </div> <!-- /.card collapse -->

                                        </div>
                                        <!-- /.post -->
                             </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card-end -->
                            <?php } ?>

				<?php endif; ?>
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
