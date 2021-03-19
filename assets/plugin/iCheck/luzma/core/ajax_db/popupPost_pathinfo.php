<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['showpoptweet']) && !empty($_POST['showpoptweet'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else{
        $user_id= 1;
    }
    $tweet_id= $_POST['showpoptweet'];
    $getid="";
    $tweet= $home->getPopupTweet($user_id,$tweet_id,$getid);
    $tweet_likes= $home->likes($user_id,$tweet_id);
    $Retweet= $home->checkRetweet($tweet_id, $user_id);
  	$user= $home->userData($tweet_id);
	$comment_= $comment->comments($tweet_id);
    ?>

<div class="tweet-show-popup-wrap">
    <!-- <input type="checkbox" id="tweet-show-popup-wrap"> -->
      <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin"  id="popupEnd">
        	<div class="img-popup-bodys">

            <div class="card">
                <div class="card-header">
                     <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                    <div class="user-block">
                        <!-- <button class="f-btn btn btn-primary btn-sm float-right"><i class="fa fa-user-plus"></i> Follow</button> -->
                        <div class="float-right"><?php echo $follow->followBtn($tweet['user_id'],$user_id,$tweet['user_id']) ;?></div>
                        <?php if (!empty($tweet['profile_img'])) { ?>
                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                            <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                            alt="user image">
                            </div>
                            </div>
                        <?php }else{ ?>
                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE ;?>"
                            alt="user image">
                            </div>
                            </div>
                        <?php } ?>
                        <span class="username">
                            <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                        </span>
                        <span class="description">Shared publicly - <?php echo $home->timeAgo($tweet['posted_on']); ?></span>
                    </div> <!-- /.user-block -->

                </div> <!-- /.card-headed -->

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

<?php 
                    if (strlen($tweet['status']) > 200) {
                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                        $tweettext = substr($tweet['status'], 0, 200);
                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$home->getTweetLink($tweetstatus).'</span>';
                    }  
                    ?>
                    </div>

                    <!-- TEXT -->
                    <!-- TEXT -->
                    <?php 
                    //  if ($tweet['tweet_image'] == true) {
                    if (!empty($tweet['donation_payment'])) {
                        if (!empty($donation_payment) && !empty($tweet['tweet_image']) ) {
                            $equal.=  '=';
                        }
                        $donation_payment= $equal.$tweet['donation_payment'];
                    }else {
                        $donation_payment='';
                    }
                    $expodefile = explode("=",$tweet['tweet_image'].$donation_payment);
                    // $expodefile = explode("=",$tweet['tweet_image']);
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

                   
                </div> <!-- card-body -->
                <div class="card-footer text-muted text-center">
                    <!-- card-footer -->

                    <ul class="list-inline">
                        <?php 
           if ($users->loggedin() === true) {
        echo '
            <li class="list-inline-item mx-4 ">
							<div class="d-inline-block ">
								<div>Shared </div> 
									 '.(($tweet['tweet_id'] == $Retweet["retweet_id"])? 
									 '<button class="share-btn retweeted" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" >
									    <i class="fa fa-share green " aria-hidden="true"></i><span class="retweetcounter" > '.$Retweet["retweet_counts"].'</span></button>'
									    :'<button class="retweet" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" >
									    <i class="fa fa-share" aria-hidden="true"></i><span class="retweetcounter" >'.(($Retweet["retweet_counts"] > 0)? " ".$Retweet["retweet_counts"] :'' ).'</span>
									 </button>').'
							</div>
						</li>
						
            <li class="list-inline-item mx-4">
								<div class="d-inline-block ">
									 <div>LIKES</div> 
										'.(($tweet_likes["like_on"] == $tweet["tweet_id"])? 
										'<button class="unlike-btn" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'">
										   <i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likescounter" > '.$tweet["likes_counts"].'</span></button> ' 
										   : '<button class="like-btn" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'">
									     <i class="fa fa-thumbs-o-up " aria-hidden="true"></i><span class="likescounter" >'.(($tweet["likes_counts"] > 0)? " ".$tweet["likes_counts"]:'' ).'</span>
										</button> ').'
							</div>
						</li>

            <li class="list-inline-item mx-4">
								<div class="d-inline-block ">
							   	<div>	Viewers </div> 2,030
						  	</div>
						</li>
            <li class="list-inline-item mx-4">
							<div class="d-inline-block ">
							   	<div>Posted on</div>'.$home->timeAgo($tweet['posted_on']).' 
						  	</div>
							 </li>
				 '.(($tweet["tweetBy"] === $user_id)?'
						<li class="list-inline-item mx-4">
							<div class="d-inline-block ">
									 <div>Delete</div> 
												<label class="deleteTweet more" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" ><i class="fa fa-trash" aria-hidden="true"></i></label>
						  	</div>
						</li> ' :'').'
									 ';
						 }else {?>
                        <li class="list-inline-item mx-4 ">
                            <div class="d-inline-block ">
                                <div>Shared </div>
                                <?php echo $tweet["retweet_counts"] ;?>
                            </div>
                        </li>

                        <li class="list-inline-item mx-4 ">
                            <div class="d-inline-block ">
                                <div>LIKES</div>
                                <?php echo $tweet["likes_counts"] ;?>
                            </div>
                        </li>

                        <li class="list-inline-item mx-4">
                            <div class="d-inline-block ">
                                <div>Posted on</div> <?php echo $home->timeAgo($tweet['posted_on']);?>
                            </div>
                        </li>

                        <?php } ?>
                    </ul>

                </div><!-- card-footer -->

                <?php if ($users->loggedin() === true) {?>

                <div class="card" style="background-color:rgba(92, 132, 61, 0.2)">
                    <div class="card-body">
                        <div class="user-block">
                            <?php if (!empty($tweet['profile_img'])) {?>
                             <div class="user-blockImgBorder">
                              <div class="user-blockImg">
                                <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                                alt="user image">
                              </div>
                              </div>
                            <?php }else {?>
                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                              <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"
                              alt="user image">
                            </div>
                            </div>
                            <?php }?>

                            <div class="username mt-3 mr-0" style="display: flex;">
                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="commentField" type="text"
                                        name="comment" data-tweet="<?php echo $tweet['tweet_id'];?>"
                                        placeholder="Reply to @<?php echo $tweet['username'] ;?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" onclick="#"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="fa fa-arrow-right text-muted"
                                                    id="postComment"></span></span>
                                    </div>
                                </div> <!-- input-group -->
                            </div> <!-- input-group -->
                        </div><!-- user-block -->

                    </div><!-- card-body -->
                </div><!-- card-end -->
                <?php  } ?>
                
                <span id="responseComment"></span>
                <!-- <div class="tweet-show-popup-comment-wrap"> -->
                <div id="comments">
                    <!--COMMENTS-->
                    <?php foreach ($comment_ as $comments) {
				# code..
	echo '
 		 <div class="card text-light">
		   <div class="card-body">
		     <div class="user-block">
              '.((!empty($comments["profile_img"])?'
                  <div class="user-blockImgBorder">
                  <div class="user-blockImg">
                    <img src="'.BASE_URL_LINK.'image/users_profile_cover/'.$comments["profile_img"].'"
                    alt="user image">
                  </div>
                  </div>

                ':' <div class="user-blockImgBorder">
                   <div class="user-blockImg">
                    <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"
                    alt="user image">
                  </div>
                  </div>
                ')).'
               <span class="username"> <a href="'.BASE_URL_PUBLIC.$comments['username'].'" style="float:left;padding-right:3px;">'.$comments['username'].'</a>
                    <!-- //Jonathan Burke Jr. -->
                </span>
                 <span class="description"> Shared publicly - '.$home->timeAgo($comments["comment_at"]).'
                 </span>
                 <span class="description">'.$home->getTweetLink($comments["comment"]).'</span>
              </div> <!-- /.user-block -->
		  </div> <!-- /.card-body -->

		  <div class="card-footer text-muted m-0 p-0" style="border-top: none;"><!-- card-footer -->
				<ul class="list-inline m-0">
                     <li class="list-inline-item mx-3 "><button><i class="fa fa-share" aria-hidden="true"></i></button>
                     </li>
                      <li class="list-inline-item mx-3 "><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                     </li>
	           	'.(($comments["comment_by"] === $user_id)?'
					   <li class="list-inline-item mx-3 more">
                         <label class="deleteComment more" data-tweet="'.$tweet["tweet_id"].'" data-comment="'.$comments["comment_id"].'" ><i class="fa fa-trash" aria-hidden="true"></i></label>
	           			</li>
	           	 ':'').'
				</ul>
			</div"> <!-- /.card-footer -->
		 </div><!-- /.card -->';
	           			  }
	           			 ?>
                </div><!-- comment-End -->

            </div><!-- card-End -->
        </div> <!-- Wrp4 -->
        </div> <!-- Wrp4 -->
    </div> <!-- tweet-show-popup-wrap" -->

    <?php }
?>
<script>
$(document).ready(function () {
    // THIS FUNCTION IS TO SHOW REAMORE IN POST TEXT
    $(".readtext-tweet-readmore").click(function(){
        var tweetText = $(this).data('tweettext');
		$(".view-more-text"+tweetText).contents().unwrap();
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
        // console.log(tweetText);
	});

    $(document).on('click','#readtext-tweet-readmores',function () {

        var tweetText = $(this).data('tweettext');
		$(".view-more-text"+tweetText).contents().unwrap();
		// $(".view-more-text"+tweetText).show();
		$(this).remove();
        console.log(tweetText);
	});
});

</script>