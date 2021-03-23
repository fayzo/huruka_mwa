<?php
//  if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
//        header('Location: ../../404.html');
//  }

class Posts_home extends Home {
   

    public function tweets($user_id,$limit)
    {
        $mysqli= $this->database;
        // $sql="SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id LEFT JOIN blog B ON B. tweet_blog_by = U. user_id WHERE T. tweetBy = $user_id AND T. retweet_id='0' AND B. blog_post = 'posted' OR T. tweetBy= U. user_id AND T. retweet_by != $user_id AND B. blog_post= 'posted' AND T. tweetBy IN (SELECT receiver FROM follow WHERE sender= $user_id) ORDER BY T. tweet_id DESC LIMIT $limit ";
        // $sql="SELECT * FROM tweets T LEFT JOIN users U ON (T. retweet_by = U. user_id OR T. tweetBy= U. user_id) WHERE T. tweetBy = $user_id AND T. retweet_id='0' OR T. retweet_by != $user_id ORDER BY T. tweet_id DESC LIMIT $limit";
        // $sql="SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. tweetBy = $user_id AND T. retweet_id='0' OR T. tweetBy= U. user_id AND T. retweet_by != $user_id AND T. tweetBy IN (SELECT receiver FROM follow WHERE sender= $user_id) ORDER BY T. tweet_id DESC LIMIT $limit";
        $sql="SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. tweetBy = $user_id AND T. retweet_id='0' OR  T. retweet_by = $user_id AND T. retweet_id !='0' OR T. tweetBy= U. user_id AND T. tweetBy IN (SELECT receiver FROM follow WHERE sender= $user_id) ORDER BY T. tweet_id DESC LIMIT $limit";
        $query= $mysqli->query($sql);
        $tweets=array();
        while ($row= $query->fetch_assoc()) {
            # code...
             $tweets[]= $row;
        }
                       
        foreach ($tweets as $tweet) {
            $likes= $this->likes($user_id,$tweet['tweet_id']);
            $likes0= $this->Like_second($user_id,$tweet['tweet_id']);
            // $retweet= $this->checkRetweet($tweet['tweet_id'],$user_id);
            $retweet= $this->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
            $user= $this->userData($retweet['retweet_by']);
            $comment= $this->comments($tweet['tweet_id']);
            
                 # code... 
            ?>
               
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
                        <span class="description">Shared public - <?php echo $this->timeAgo($retweet['posted_on']); ?></span>
                    </span>
                    <span class="description"><?php echo $this->getTweetLink($retweet['retweet_Msg']); ?></span>
                </div>

                <div class="card retweetcolor t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>">
                  <div class="card-body">
  
                <!-- TEXT -->
                <!-- TEXT -->
                <?php 
                
                // if (!empty($tweet['donation_payment'])) {
                //     $equal = '';
                //     if (!empty($donation_payment) && !empty($tweet['tweet_image']) ) {
                //         $equal.=  '=';
                //     }
                //     $donation_payment= $equal.$users->test_input($tweet['donation_payment']);
                // }else {
                //     $donation_payment='';
                // }
            
                // $expodefile = explode("=",$tweet['tweet_image'].$donation_payment);

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
                    $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);
    
                    $expode = $expodefile;
                    $file_size = $tweet['tweet_image_size'];
                    $file_sizes = explode("=",$file_size);
                    $count = count($expodefile);

                    if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                      <?php  
                      for ($i=0; $i < 1; ++$i) { 
            
                    if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>

                      <div class="row">

                            <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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


                            <div class="col-sm-12 col-md-6">
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
                       </div><!-- row -->

                    <?php } 
                    
                    if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>

                      <div class="row">
                            
                            <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

                            <div class="col-sm-12 col-md-6">
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

                       </div><!-- row -->

                       <?php }
                       
                       if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>

                      <div class="row">
                            
                            <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

                            <div class="col-sm-12 col-md-6">
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

                       </div><!-- row -->

                        <?php }

                        if(in_array(pathinfo($expode[$i])['extension'],$mp4)) { ?>
                        
                            <div class="row">
                                
                            <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

                            <div class="col-sm-12 col-md-6">
                                    <video controls preload="auto" width="100px"  height="auto" >
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                    </video>
                            </div><!-- col -->

                            </div><!-- row -->
                          <?php }

                        if(in_array(pathinfo($expode[$i])['extension'],$mp3)) { ?>

                            <div class="row">

                             <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

                                <div class="col-sm-12 col-md-6">
                                    <audio controls>
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                            <!-- fallback content here -->
                                    </audio>
                                </div><!-- col -->

                            </div><!-- row -->
                          <?php } 

                        if(in_array(pathinfo($expode[$i])['extension'],$coins)) { ?>
                            <div class="row">
                               
                             <div class="col-sm-12 col-md-6">
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
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

                            <div class="col-sm-12 col-md-6">
                                <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                                <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
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
                                                    <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>
                                                    <div id="link_" class="show-read-more">
                                                    <?php 

                                                        if (strlen($tweet['status']) > 200) {
                                                            // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                                        $tweettext = substr($tweet['status'], 0, 200);
                                                        $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                                                        <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
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

            $image= array('jpg','jpeg','png','gif');
            $pdf= array('pdf');
            $coins= array('coins');
            $docx= array('doc','docx','lsx');
            $mp3= array('mp3','ogg');
            $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
            $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);

            // if (!empty($tweet['donation_payment'])) {
            //     if (!empty($donation_payment) && !empty($tweet['tweet_image']) ) {
            //         $equal.=  '=';
            //     }
            //     $donation_payment= $equal.$users->test_input($tweet['donation_payment']);
            // }else {
            //     $donation_payment='';
            // }
            
            // $expode = explode("=",$tweet['tweet_image'].$donation_payment);

            $expodefile = explode("=",$tweet['tweet_image']);
            $fileActualExt= array();
            for ($i=0; $i < count($expode); ++$i) { 
                    $fileActualExt[]= strtolower(substr($expode[$i],strrpos($expode[$i],'.')+1));
            }
            $title= $tweet["photo_Title"];
            $photo_title=  explode("=",$title);
            $file_size = $tweet['tweet_image_size'];
            $file_sizes = explode("=",$file_size);
            $count = count($expode);

            // var_dump($expode,$count);
            // sort() to arrange key in order

            if (array_diff($fileActualExt,$allower_ext) == false) { 

             // foreach ($expodefile as $file_image) {
            //     # code...
            //     $filePathinfo = pathinfo($file_image);

            //     if (in_array($filePathinfo['extension'],$fileActualExt_image)) {
            //         # code...
            //         $filePathinfo_image[]= $filePathinfo['basename'];
            //     }

            // }
            // $matches1= preg_grep('~.(jpeg|jpg|png)$~',$expodefile);
            // var_dump($filePathinfo_image,'=>>>',$new_array_image);

            $new_array_image= array_filter($expode,
            function ($element){
                $path_extension = array('jpg','jpeg','png','gif');
                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });
            
            if(!empty($new_array_image)) {

                $count_image = count($new_array_image);

                if ($count_image === 1) { ?>

                 <div class="row mb-2">
                    <div class="col-12 more">
                        <?php foreach ($new_array_image as $key => $value) { ?>
                        <div class="col-6">
                            <img class="img-fluid mb-2 imagePopup"
                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_image[$key])['basename'];?>"
                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            <div><i><?php echo $photo_title[$key]; ?></i></div>
                        </div>
                        <?php } ?>
                    
                    </div>
                 </div>

                <?php
                 }else if($count_image === 2){?>
                    <div class="row mb-2 more">
                            <?php foreach ($new_array_image as $key => $value) { ?>
                        <div class="col-6">
                            <img class="img-fluid mb-2 imagePopup"
                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_image[$key])['basename'];?>"
                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            <div><i><?php echo $photo_title[$key]; ?></i></div>
                        </div>
                            <?php }?>
                    </div>

                <?php }else if($count_image >= 3){?>
                 <div class="row mb-2 more">
                        <?php $count=0;
                        foreach ($new_array_image as $key => $value) { 
                            if($count === 0 ){ ?>
                            <div class="col-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_image[$key])['basename'];?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                <div><i><?php echo $photo_title[$key]; ?></i></div>
                            </div>
                        <?php } 
                            ++$count;
                            if ($count === 1) {echo '<div class="col-6"><div class="row">';} 
                            if($count <= 4 ){ ?>
                            <div class="col-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_image[$key])['basename'];?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                <!-- <div><i>< ?php echo $photo_title[$key]; ?></i></div> -->
                            </div>
                        <?php } 
                        
                    } echo '</div></div>'; ?>
                       
                </div>
                 <!-- /.row -->
                <div class="row">
                   <div class="col-12">
                       <span class="btn btn-primary btn-sm float-right  t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                    </div>
                </div>
                <!-- /.row -->
                   
                <?php } }

            $new_array_pdf= array_filter($expode,
            function ($element){
                $path_extension = array('pdf');
                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });

            if(!empty($new_array_pdf)) {

                $count_pdf = count($new_array_pdf);

                if ($count_pdf === 1) { ?>

                 <div class="row mb-2">
                    <div class="col-12 more">
                        <?php foreach ($new_array_pdf as $key => $value) { ?>
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_pdf[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($new_array_pdf[$key])['basename'] ;?>
                                        <!-- || Sep2014-report.pdf -->
                                    </a>
                                <span class="mailbox-attachment-size">
                                <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        <?php }?>
                    
                    </div>
                 </div>

                <?php
                 }else if($count_pdf === 2){?>
                    <div class="row mb-2 more">
                            <?php foreach ($new_array_pdf as $key => $value) { ?>
                        <div class="col-6">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_pdf[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($new_array_pdf[$key])['basename'] ;?>
                                        <!-- || Sep2014-report.pdf -->
                                    </a>
                                <span class="mailbox-attachment-size">
                                <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div>
                            <?php }?>
                    </div>

                <?php }else if($count_pdf >= 3){ ?>
                 <div class="row mb-2 more">
                        <?php $count=0;
                        foreach ($new_array_pdf as $key => $value) { 
                            if($count == 0 ){ ?>
                            <div class="col-md-6 col-sm-12">
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                <div class="mailbox-attachment-info main-active">
                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_pdf[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($new_array_pdf[$key])['basename'] ;?>
                                            <!-- || Sep2014-report.pdf -->
                                        </a>
                                    <span class="mailbox-attachment-size">
                                    <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php } 
                            ++$count;
                            if ($count == 1) {echo '<div class="col-md-6 col-sm-12"><div class="row">';} 
                            if($count <= 4 ){ ?>
                            <div class="col-md-6 col-sm-6">
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                <div class="mailbox-attachment-info main-active">
                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_pdf[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($new_array_pdf[$key])['basename'] ;?>
                                            <!-- || Sep2014-report.pdf -->
                                        </a>
                                    <span class="mailbox-attachment-size">
                                    <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php } 
                    } echo '</div></div>'; ?>
                       
                </div>
                 <!-- /.row -->
                <div class="row">
                   <div class="col-12">
                       <span class="btn btn-primary btn-sm float-right  t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                    </div>
                </div>
                <!-- /.row -->
                   
                <?php } }

            $new_array_docx= array_filter($expode,
            function ($element){
                $path_extension =array('doc','docx','lsx');
                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });

            // sort() to arrange key in order

            if(!empty($new_array_docx)) {

                $count_docx = count($new_array_docx);

                if ($count_docx === 1) { ?>

                 <div class="row mb-2">
                    <div class="col-12 more">
                        <?php foreach ($new_array_docx as $key => $value) { ?>
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_docx[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($new_array_docx[$key])['basename'] ;?>
                                        <!-- || Sep2014-report.pdf -->
                                    </a>
                                <span class="mailbox-attachment-size">
                                <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        <?php }?>
                    
                    </div>
                 </div>

                <?php
                 }else if($count_docx === 2){?>
                    <div class="row mb-2 more">
                            <?php foreach ($new_array_docx as $key => $value) { ?>
                        <div class="col-6">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_docx[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($new_array_docx[$key])['basename'] ;?>
                                        <!-- || Sep2014-report.pdf -->
                                    </a>
                                <span class="mailbox-attachment-size">
                                <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div>
                            <?php }?>
                    </div>

                <?php }else if($count_docx >= 3){ ?>
                 <div class="row mb-2 more">
                        <?php $count=0;
                        foreach ($new_array_docx as $key => $value) { 
                            if($count == 0 ){ ?>
                            <div class="col-md-6 col-sm-12">
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                <div class="mailbox-attachment-info main-active">
                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_docx[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($new_array_docx[$key])['basename'] ;?>
                                            <!-- || Sep2014-report.pdf -->
                                        </a>
                                    <span class="mailbox-attachment-size">
                                    <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php } 
                            ++$count;
                            if ($count == 1) {echo '<div class="col-md-6 col-sm-12"><div class="row">';} 
                            if($count <= 4 ){ ?>
                            <div class="col-md-6 col-sm-6">
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                <div class="mailbox-attachment-info main-active">
                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_docx[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($new_array_docx[$key])['basename'] ;?>
                                            <!-- || Sep2014-report.pdf -->
                                        </a>
                                    <span class="mailbox-attachment-size">
                                    <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php } 
                    } echo '</div></div>'; ?>
                       
                </div>
                 <!-- /.row -->
                <div class="row">
                   <div class="col-12">
                       <span class="btn btn-primary btn-sm float-right  t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                    </div>
                </div>
                <!-- /.row -->
                   
                <?php } }

            $new_array_mp4= array_filter($expode,
            function ($element){
                $path_extension = array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');

                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });

            if(!empty($new_array_mp4)) {

                $count_mp4 = count($new_array_mp4);

                if ($count_mp4 === 1) { ?>

                 <div class="row mb-2">
                        <?php foreach ($new_array_mp4 as $key => $value) { ?>
                        <div class="col-12">

                            <video controls preload="auto" width="100px"  height="auto" >
                                <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp4[$key])['basename']; ?>" type="video/<?php echo pathinfo($new_array_mp4[$key])['extension']; ?>"> 
                            </video>
                        </div>
                        <div class="col-12">

                            <div class="mailbox-attachment-info main-active">
                                <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp4[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($new_array_mp4[$key])['basename'] ;?>
                                        <!-- || Sep2014-report.pdf -->
                                    </a>
                                <span class="mailbox-attachment-size">
                                <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div>

                        <?php } ?>
                 </div>

                <?php
                 }else if($count_mp4 === 2){?>
                    <div class="row mb-2 more">
                            <?php foreach ($new_array_mp4 as $key => $value) { ?>
                                <div class="col-12">
                                    <video controls preload="auto" width="100px"  height="auto" >
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp4[$key])['basename']; ?>" type="video/<?php echo pathinfo($new_array_mp4[$key])['extension']; ?>"> 
                                    </video>
                                </div>
                                <div class="col-12">
                                    <div class="mailbox-attachment-info main-active">
                                        <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp4[$key])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                            <?php  echo pathinfo($new_array_mp4[$key])['basename'] ;?>
                                                <!-- || Sep2014-report.pdf -->
                                            </a>
                                        <span class="mailbox-attachment-size">
                                        <?php echo $this->formatSizeUnits($file_sizes[$key]) ;?>
                                            <!-- 1,245 KB -->
                                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>

            <?php  }  }

            $new_array_mp3= array_filter($expode,
            function ($element){
                $path_extension = array('mp3','ogg');

                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });

            if(!empty($new_array_mp3)) {

                $count_mp3 = count($new_array_mp3);

                if ($count_mp3 === 1) { ?>

                 <div class="row mb-2">
                    <div class="col-12 more">
                        <?php foreach ($new_array_mp3 as $key => $value) { ?>
                                    <audio controls>
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp3[$key])['basename']; ?>" type="audio/<?php echo pathinfo($new_array_mp3[$key])['extension']; ?>"> 
                                            <!-- fallback content here -->
                                    </audio>
                        <?php } ?>
                    
                    </div>
                 </div>

                <?php
                 }else if($count_mp4 === 2){?>
                    <div class="row mb-2 more">
                        <div class="col-12 more">

                            <?php foreach ($new_array_mp4 as $key => $value) { ?>
                                    <audio controls>
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($new_array_mp3[$key])['basename']; ?>" type="audio/<?php echo pathinfo($new_array_mp3[$key])['extension']; ?>"> 
                                            <!-- fallback content here -->
                                    </audio>
                            <?php } ?>
                         </div>
                    </div>

            <?php  }  }

            $new_array_coins= array_filter($expode,
            function ($element){
                $path_extension = array('coins');

                list($name,$extension) = explode('.',$element);

                if (in_array($extension,$path_extension)) {
                    # code...
                    return $element;
                }
            });

            if(!empty($new_array_coins)) {

                $count_coins = count($new_array_coins);

                if ($count_coins === 1) { ?>

                 <div class="row mb-2">
                    <div class="col-12 more">
                        <?php foreach ($new_array_coins as $key => $value) { ?>
                                <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                                <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
                        <?php } ?>
                    
                    </div>
                 </div>

                <?php } }
            
                 } ?>

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
                          <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $this->CountsComment($tweet["tweet_id"]); ?>)
                      </button></li>
                    

                     <?php if (isset($_SESSION['key']) && $tweet["retweet_by"] == 0 && $tweet["tweetBy"] == $user_id){ ?>
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
                     <?php }else if (isset($_SESSION['key']) && $tweet["retweet_by"] == $user_id){ ?>
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
                    name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>">
                <div class="input-group-append">
                    <span class="input-group-text btn" style="padding: 0px 10px;" 
                        aria-label="Username" aria-describedby="basic-addon1" <?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id'];?>">
                        <span class="fa fa-arrow-right text-muted" ></span>
                    </span>
                </div>
            </div>

            <div class="card collapse" id="a<?php echo  $tweet["tweet_id"];?>">
                <!-- <div class="input-group">
                    <textarea class="form-control form-control-sm" id="commentHome< ?php echo $tweet['tweet_id'];?>" type="text"
                        style="height: 43px;" name="comment"  placeholder="Reply to  < ?php echo $tweet['username'] ;?>" row="1" ></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                            aria-label="Username" aria-describedby="basic-addon1" < ?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="< ?php echo $tweet['tweet_id'];?>">
                            <span class="fa fa-arrow-right text-muted" ></span>
                        </span>
                    </div>
                </div>  --><!-- input-group -->
                
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
    

            }
} 

$posts_home= new Posts_home();

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
