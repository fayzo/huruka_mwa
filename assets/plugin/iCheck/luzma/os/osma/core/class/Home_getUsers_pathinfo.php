<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }


class GetUsers extends Home
{
    
    public function getUserTweet($user_id,$user_idSession)
    {
        $mysqli= $this->database;
        $stmt = $mysqli->stmt_init();
        $query= "SELECT * FROM tweets LEFT JOIN users ON tweetBy = user_id WHERE tweetBy = $user_id AND retweet_id = 0 OR retweet_by= $user_id ORDER BY tweet_id DESC";
        // $query="SELECT * FROM tweets LEFT JOIN users ON tweetBy= user_id WHERE tweetBy = $user_id AND retweet_id='0' OR  retweet_by= $user_id AND tweetBy IN (SELECT receiver FROM follow WHERE sender= $user_id) ORDER BY tweet_id DESC ";
        $sql = $mysqli->query($query);
        $all_tweet=array();
        while ($row = $sql->fetch_array()) {
            $data[] = $row;
            /* TABLE OF tweety */
        }
        if(!empty($data)){
                             foreach ($data as $tweet) {
                                $likes= $this->likes($user_id,$tweet['tweet_id']);
                                // $retweet= $this->checkRetweet($tweet['tweet_id'],$user_id);
                                $retweet= $this->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                $user= $this->userData($tweet['retweet_by']);
                                $comment= $this->comments($tweet['tweet_id']);
                                     # code... 
                                    //  echo var_dump($retweet['retweet_Msg']).'<br>';
                                ?>
                                <!-- <div class="card mb-3"> -->
                                    <!-- <div class="card-body"> -->
                                   
                                <div class="post ">
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
                                               <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                               <?php  }else{ ?>
                                                 <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                               <?php } ?>
                                         </div>
                                         </div>
                                        <span class="username">
                                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILEBASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                            <span class="description">Shared public - <?php echo $this->timeAgo($retweet['posted_on']); ?></span>
                                        </span>
                                        <span class="description"><?php echo $this->getTweetLink($retweet['retweet_Msg']); ?></span>
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
                                            $mp3= array('mp3','m4a','ogg');
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
                                            $count_coins =count(array_intersect($fileActualExt_coins,$coins));

                                            $fileActualExt_mp4 =array_intersect($fileActualExt,$mp4);
                                            $count_mp4 =count(array_intersect($fileActualExt_mp4,$mp4));

                                            $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                            $count_mp3 =count(array_intersect($fileActualExt_mp3,$mp3));
                                        
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
                                                            <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                    <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                        <span class="description">Shared publicly -  <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                                                    <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                    echo $this->getTweetLink($tweetstatus);
                                                                    }else{
                                                                    echo $this->getTweetLink($tweet['status']);
                                                                    }  
                                                                    if (strlen($tweet['status']) > 200) {
                                                                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
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
                                                                       <span class="description">Shared publicly - <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
                                                                   </span>
                                                                   <span class="description">
                                                                    <!-- STATUS -->
                                                                    <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                                    <div id="link_" class="show-read-more">
                                                                    <?php 

                                                                        if (strlen($tweet['status']) > 200) {
                                                                            // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                                        $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                                        <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                                        echo $this->getTweetLink($tweetstatus);
                                                                        }else{
                                                                        echo $this->getTweetLink($tweet['status']);
                                                                        }  
                                                                        if (strlen($tweet['status']) > 200) {
                                                                            // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                                            $tweettext = substr($tweet['status'], 0, 200);
                                                                            $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                                                                            echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
                                                                        }  
                                                                    ?>
                                                                    <span class="btn btn-primary btn-sm float-right" >View More >>></span>
                                                                    </div>
                                                                   
                                                                   </span>
                                                               </div>

                                                        </div><!-- col -->
                                                    </div><!-- row -->

                                            <?php } ?>

                                      </div><!-- card-body -->
                                    </div><!-- card -->


                                <?php } else { ?> 

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
                                            <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description">Shared publicly - <?php echo $this->timeAgo($tweet['posted_on']); ?></span>
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
                                        echo $this->getTweetLink($tweetstatus);
                                        }else{
                                        echo $this->getTweetLink($tweet['status']);
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
                                        $mp3= array('mp3','m4a','ogg');
                                        $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');

                                        // $pathinfo = pathinfo($expode[$i])['extension'];

                                        $fileActualExt_image =array_intersect($fileActualExt,$image);
                                        $count_image =count(array_intersect($fileActualExt_image,$image));

                                        $fileActualExt_pdf =array_intersect($fileActualExt,$pdf);
                                        $count_pdf =count(array_intersect($fileActualExt_pdf,$pdf));
                                    
                                        $fileActualExt_docx =array_intersect($fileActualExt,$docx);
                                        $count_docx =count(array_intersect($fileActualExt_docx,$docx));
                                        
                                        $fileActualExt_coins =array_intersect($fileActualExt,$coins);
                                        $count_coins =count(array_intersect($fileActualExt_coins,$coins));

                                        $fileActualExt_mp4 =array_intersect($fileActualExt,$mp4);
                                        $count_mp4 =count(array_intersect($fileActualExt_mp4,$mp4));

                                        $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                                        $count_mp3 =count(array_intersect($fileActualExt_mp3,$mp3));
                                    
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
                                                                <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                            <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                            <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                                            <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
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
                                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
                                    }  
                                ?>
                                </div>
                             <!--   <p id="link_">
                                < ?php echo $this->getTweetLink($tweet['status']) ;?>
                            </p> -->
                            
                                    
                              <?php }?>

                              <ul class="mt-2 list-inline" style="list-style-type: none; margin-bottom:10px;"> 
                                        <?php if(isset($_SESSION['key']) && $_SESSION['approval'] === 'on'){ ?>

                                        <?php if($tweet['tweet_id'] == $retweet['retweet_id'] || $user_id == $retweet['retweet_by']){ ?>
                                         <li class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="share-btn retweeted text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                         <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet["retweet_counts"];?></span></i>
                                            Share</button></li>
                                        <?php }else{ ?>

                                               <li  class=" list-inline-item"> <button  <?php echo (isset($_SESSION['key']))?'class="share-btn retweet text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?>
                                                   Share</button></li>

                                         <?php } } ?>

                                            <?php if($likes['like_on'] == $tweet['tweet_id']){ ?>
                                                <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="unlike-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?> data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                    Like</button></li>

                                            <?php }else{ ?>
                                                  <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="like-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?> data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                   <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                       Like</button></li>
                                            <?php } ?>
                                         
                                         <span style="float:right">
                                    
                                          <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="comments-btn text-sm" data-toggle="collapse"':'class="text-sm" id="login-please" data-login="1"' ;?> data-target="#a<?php echo  $tweet["tweet_id"];?>" >
                                              <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $this->CountsComment($tweet["tweet_id"]); ?>)
                                          </button></li>
                                        

                                         <?php if (isset($_SESSION['key']) && $tweet["retweet_by"] == 0 && $tweet["tweetBy"] == $user_idSession){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                       <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px;" >
											                <li style="list-style-type: none; margin:0px;"> 
                        					                    <label class="deleteTweet" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["tweetBy"];?>" >Delete </label>
                                                           </li>
                                                       </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php }else if (isset($_SESSION['key']) && $tweet["retweet_by"] == $user_idSession){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt text-sm" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                    <a href="javascript:void(0)" class="more" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                                <label class="delete_retweet_by" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["retweet_by"];?>" >Delete </label>
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
                                        <h5><i>Comments (<?php echo $this->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                        <span id='responseDeletePostSeconds0'></span>

                                         <div class="direct-chat-message direct-chat-messageS large-2" >
                                         <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                           <?php foreach ($comment as $comments) { 
                                               $second_likes= $this->Like_second($user_id,$comments['comment_id']);
                                               $dislikes= $this->dislike($user_id,$comments['comment_id']);
                                               ?>
                                                <!-- Conversations are loaded here -->
                                                  <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                            <span class="direct-chat-timestamp float-right"><?php echo $this->timeAgo($comments['comment_at']); ?></span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                         <?php if (!empty($comments["profile_img"])) {?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                         <?php  }else{ ?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                         <?php } ?>
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                         <?php echo  $this->getTweetLink($comments["comment"]) ;?>
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
                                                            <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $this->CountsComment_second($comments["comment_id"]); ?>)
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
                                                             $comment_second= $this->comments_second($comments['comment_id']);
                                                            if (!empty($comment_second)) { ?>
                                                            <h5><i>Comments (<?php echo $this->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                            <span id='responseDeletePostSecond'></span>
                                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                                            <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                            <?php foreach ($comment_second as $comments0) { ?>
                                                                    <!-- Conversations are loaded here -->
                                                                    <!-- Message. Default to the left -->
                                                                        <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                            <div class="direct-chat-info clearfix">
                                                                                <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                <span class="direct-chat-timestamp float-right"><?php echo $this->timeAgo($comments0['comment_at_']); ?></span>
                                                                            </div>
                                                                            <!-- /.direct-chat-info -->
                                                                            <?php if (!empty($comments0["profile_img"])) { ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                            <?php  }else{ ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                            <?php } ?>
                                                                            <!-- /.direct-chat-img -->
                                                                            <div class="direct-chat-text">
                                                                                <?php echo  $this->getTweetLink($comments0["comment_"]) ;?>
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
                                <?php }
       }else{ ?>
                     <div class="post">
                         <div class="user-block">
                             <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                                  <?php if (!empty($tweet['profile_img'])) {?>
                                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                  <?php  }else{ ?>
                                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/irangiro.png" ;?>" alt="User Image">
                                  <?php } ?>
                            </div>
                            </div>
                             <span class="username">
                                 <a href="<?php echo PROFILE ;?>">Irangiro</a>
                             </span>
                             <span class="description">Public Figure | Content Creator</span>
                         </div>
                         <!-- /.user-block -->
                         <div class="row mb-3">
                             <div class="col-12">
                                 <div class="row">
                                     <div class="col-12">
                                         <img class="img-fluid"
                                             src="<?php echo BASE_URL_LINK."image/users_cover_profile/coming-soon.png" ;?>" alt="Photo">
                                     </div>
                                     <!-- /.col -->
                                 </div>
                                 <!-- /.row -->
                             </div>
                             <!-- /.col -->
                         </div>
                         <!-- /.row -->

                        <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i>
                                Share</a>
                            <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i>
                                Like</a>
                            <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                    <i class="fa fa-comments-o mr-1"></i> Comments ()
                                </a>
                            </span>
                        </p>

                        <div class="input-group">
                            <input class="form-control form-control-sm" type="text"
                                placeholder="Type a comment">
                            <div class="input-group-append">
                                <span class="input-group-text btn" onclick="#" aria-label="Username"
                                    aria-describedby="basic-addon1"><i
                                        class="fa fa-arrow-right text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.post -->
        <?php }

    }


}

$GetUsers = New GetUsers();
/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>