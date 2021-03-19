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
                                                $mp3= array('mp3','ogg');
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

                                                $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                                $count_mp3 =count(array_intersect($fileActualExt_docx,$mp3));
                                            
                                                // var_dump($array_image);
                                                $allower_ext= array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip','coins','mp4'); // valid extensions
                                                // $allower_ext= $mp4;

                                                $expode = $expodefile;
                                                $file_size = $tweet['tweet_image_size'];
                                                $file_sizes = explode("=",$file_size);
                                                $count = count($expodefile);

                                                if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                                <?php  
                                                for ($i=0; $i < 1; ++$i) { 
                                        
                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_image)) { ?>

                                                <div class="row">
                                                        <div class="col-6 ">
                                                            <span class="mailbox-attachment-icon has-img"><img 
                                                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                        
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                            <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                            <!-- || Sep2014-report.pdf -->
                                                            </a>
                                                                <span class="mailbox-attachment-size">
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                    <!-- 1,245 KB -->
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                            class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
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

                                                <?php } 
                                                
                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_pdf)) { ?>

                                                <div class="row">
                                                        <div class="col-6 ">
                                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                                <div class="mailbox-attachment-info main-active">
                                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                                        <!-- || Sep2014-report.pdf -->
                                                                    </a>
                                                                    <span class="mailbox-attachment-size">
                                                                    <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                        <!-- 1,245 KB -->
                                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                                    </span>
                                                                </div>
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

                                                <?php }
                                                
                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_docx)) { ?>

                                                <div class="row">
                                                        <div class="col-6 ">
                                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                                <div class="mailbox-attachment-info main-active">
                                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                                    <!-- ||Sep2014-report.pdf -->
                                                                </a>
                                                                    <span class="mailbox-attachment-size">
                                                                        <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                        <!-- 1,245 KB -->
                                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                                class="fa fa-cloud-download"></i></a>
                                                                    </span>
                                                                </div>
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

                                                    <?php }

                                                    if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp4)) { ?>
                                                    
                                                        <div class="row">
                                                            <div class="col-6 ">
                                                                <video controls preload="auto" width="100px"  height="auto" >
                                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
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
                                                    <?php }

                                                    if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp3)) { ?>

                                                        <div class="row">
                                                            <div class="col-6 ">
                                                                <audio controls>
                                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
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
                                                    <?php } 

                                                    if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_coins)) { ?>
                                                        <div class="row">
                                                            <div class="col-6 ">
                                                                    <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                                                                    <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
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
                                                    <?php }  ?>
                                                <?php } }else { ?>
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
                                            <span class="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                            echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                            }else{
                                            echo $Posts_copyDraft->getTweetLink($tweet['status']);
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
                                            $mp3= array('mp3','ogg');
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

                                            $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                            $count_mp3 =count(array_intersect($fileActualExt_docx,$mp3));
                                        
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
                                                                    <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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

                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp3)) { ?>
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <audio controls>
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                                    <!-- fallback content here -->
                                                            </audio>
                                                        </div>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
                                            $mp3= array('mp3','ogg');
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

                                            $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                            $count_mp3 =count(array_intersect($fileActualExt_docx,$mp3));
                                        
                                            // var_dump($array_image);
                                            $allower_ext= array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip','coins','mp4'); // valid extensions
                                            // $allower_ext= $mp4;

                                            $expode = $expodefile;
                                            $file_size = $tweet['tweet_image_size'];
                                            $file_sizes = explode("=",$file_size);
                                            $count = count($expodefile);

                                            if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                            <?php  
                                            for ($i=0; $i < 1; ++$i) { 
                                    
                                            if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_image)) { ?>

                                            <div class="row">
                                                    <div class="col-6 ">
                                                        <span class="mailbox-attachment-icon has-img"><img 
                                                        src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                    
                                                        <div class="mailbox-attachment-info main-active">
                                                            <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                        <!-- || Sep2014-report.pdf -->
                                                        </a>
                                                            <span class="mailbox-attachment-size">
                                                            <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                <!-- 1,245 KB -->
                                                                <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                        class="fa fa-cloud-download"></i></a>
                                                            </span>
                                                        </div>
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

                                            <?php } 
                                            
                                            if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_pdf)) { ?>

                                            <div class="row">
                                                    <div class="col-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                                    <!-- || Sep2014-report.pdf -->
                                                                </a>
                                                                <span class="mailbox-attachment-size">
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                    <!-- 1,245 KB -->
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
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

                                            <?php }
                                            
                                            if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_docx)) { ?>

                                            <div class="row">
                                                    <div class="col-6 ">
                                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                            <div class="mailbox-attachment-info main-active">
                                                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                                <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                                <!-- ||Sep2014-report.pdf -->
                                                            </a>
                                                                <span class="mailbox-attachment-size">
                                                                    <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
                                                                    <!-- 1,245 KB -->
                                                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                            class="fa fa-cloud-download"></i></a>
                                                                </span>
                                                            </div>
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

                                                <?php }

                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp4)) { ?>
                                                
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <video controls preload="auto" width="100px"  height="auto" >
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
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
                                                <?php }

                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp3)) { ?>

                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <audio controls>
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
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
                                                <?php } 

                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_coins)) { ?>
                                                    <div class="row">
                                                        <div class="col-6 ">
                                                                <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                                                                <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
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
                                                <?php }  ?>

                                                <?php } }else { ?>
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
                                            <span class="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                            echo $Posts_copyDraft->getTweetLink($tweetstatus);
                                            }else{
                                            echo $Posts_copyDraft->getTweetLink($tweet['status']);
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
                                            $mp3= array('mp3','ogg');
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

                                            $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                            $count_mp3 =count(array_intersect($fileActualExt_docx,$mp3));
                                        
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
                                                                    <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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

                                                if(in_array(pathinfo($expode[$i])['extension'],$fileActualExt_mp3)) { ?>
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <audio controls>
                                                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                                    <!-- fallback content here -->
                                                            </audio>
                                                        </div>
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
                                                                <?php echo $Posts_copyDraft->formatSizeUnits($file_sizes[$i]) ;?>
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
