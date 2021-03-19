<?php include "header_navbar_footer/header_if_login.php"?>
<title>Notifications</title>
<?php include "header_navbar_footer/header.php"?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h1><i>Notification</i></h1>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'"> User Profile</a></i></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            <div class="col-md-3 mb-3 d-none d-md-block">
                <div class="mb-2">
                    <?php echo $home->userProfile($user_id); ?>
                </div>
                <?php echo $trending->trends(); ?>
                <!-- Profile Image -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <div class="cards">
                    <div class="card-header borders-tops text-center p-2 message-color">
                        <h3><i> Notification</i></h3>
                    </div><!-- /.card-header -->
                    <div class="card-body mb-2">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                    
                            <li class="time-label">
                                <span class="bg-danger text-light">
                                Your Timeline
                                    <!-- 10 Feb. 2014 -->
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                        <?php 
                              $notif= $notification->notifications($user_id);
                              // var_dump($notif);
                              foreach ($notif as $data): 
                                      if ($data['type'] == 'message'):
                        ?>
                            <li>
                                <i class="fa fa-envelope bg-primary text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                  <div class="card-body">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                        email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'follow'):
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-info text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                  <div class="card-body">
                                     <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['follow_on']) ;?></span>
                                    <div class="user-block">
                                        <div class="user-blockImgBorder">
                                            <div class="user-blockImg">
                                                 <?php if (!empty($data['profile_img'])) {?>
                                                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                  <?php  }else{ ?>
                                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                  <?php } ?>
                                            </div>
                                        </div> 
                                       <span class="username">
                                            <a
                                                href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"> <div >Followed you on <!-- accepted your friend request --> </div></span>
                                    </div><!-- /.user-block -->
                                   
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'likes'):
                                $tweet= $data;
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                // $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-heart bg-danger text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Likes your Post <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                   
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
                                    <!--   <p id="link_">
                                        < ?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                    </p> -->

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

                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'retweet'):
                                $tweet=$data;
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                // $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-retweet bg-success text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Shares your Post <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                    </div><!-- /.card-header -->

                             <div class="card-body">
                             
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
                            <!--   <p id="link_">
                                < ?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                            </p> -->

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
                                </div>
                            </li>

                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'mention'):
                                    $tweet= $data;
                                    $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                    $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                    // $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
                                    $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                    $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-at bg-purple text-dark "></i>
                                <!-- <i class="fa fa-at bg-warning text-light">@</i> -->
                              <div class="timeline-item card shadow-sm" style="background:white;">
                                <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Mention Your name <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                    
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
                                    <!--   <p id="link_">
                                        < ?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                    </p> -->

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
                               
                            </li>
                            <!-- END timeline item -->
                        <?php  endif; 
      
                              if ($data['type'] == 'tweets_photo'):
                          ?>
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-success text-light">
                                    3 Jan. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera text-light" style="background-color:#6f42c1"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o text-light"></i> 2 days
                                        ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                    </h3>

                                    <div class="timeline-body">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <?php    endif; 
                             endforeach; ?>
                            <li >
                                <i class="fa fa-clock-o bg-info text-light"></i>
                            </li>
                        </ul>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
           
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