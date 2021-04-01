<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['retweet']) && !empty($_POST['retweet'])) {
    $user_id= $_SESSION['key'];
	  $retweet_id= $_POST['retweet'];
	  $tweet_by= $_POST['tweet_By'];
	  $comment= $_POST['comments'];
	  $comments= $users->test_input($comment);
      $g=$home->retweet($retweet_id, $user_id,$tweet_by,$comments);
}

if (isset($_POST['showpopretweet']) && !empty($_POST['showpopretweet'])) {
    $user_id= $_SESSION['key'];
    $tweet_id= $_POST['showpopretweet'];
    $tweet_by= $_POST['tweet_By'];
	$retweet= $home->getPopupTweet($user_id, $tweet_id, $tweet_by); 
	?>

            <div class="retweet-popup">
                <div class="wrap6" id="disabler">
                  <div class="wrap6Pophide" onclick="togglePopup( )"></div>
                  <div class="img-popup-wrap"  id="popupEnd">
                  
                    <div class="card">
                       <div class="card-header py-1 main-active">
                		    <button class="close-retweet-popup float-right" style="font-size: 14px;cursor: pointer;"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                			<h3 class="text-center" style="font-weight: normal; font-size: 16px;">Shares this to followers?</h3>
                		</div>
                		<div class="card-body">

                		    <div class="retweet-popup-input">
                               <div class="input-group">
                                    <input class="form-control form-control-md retweetMsg " type="text" 
                                       placeholder="Add a comment... to share <?php echo $retweet['username'] ;?> Post" >
                                    <div class="input-group-append">
                                      <span class="input-group-text btn retweet-it" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeComment" >
                                            <span class="fa fa-share"  > Shares</span>
                                      </span>
                                    </div>
                                </div> <!-- input-group -->
                            </div>


                				<div class="retweet-popup-comment-wrap">
									<div class="user-block" style="margin-bottom:10px;">
                                        <div class="user-blockImgBorder">
                                        <div class="user-blockImg" >
                                              <?php if (!empty($retweet['profile_img'])) {?>
                                              <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $retweet['profile_img'] ;?>" alt="User Image">
                                              <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                              <?php } ?>
                                        </div>
                                        </div>
                                        <span class="username">
                                            <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$retweet['username'] ;?>"><?php echo $retweet['firstname']." ".$retweet['lastname'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                           <span class="description">Shared public - <?php echo $home->timeAgo($retweet['posted_on']); ?></span>
                                        </span>
                                               
                                            <!-- TEXT -->
                                            <!-- TEXT -->
                                            <div class="title-name-black"><?php echo $retweet['title_name']; ?></div>

                                            <div id="link_" class="show-read-more">
                                            <?php 

                                                if (strlen($retweet['status']) > 200) {
                                                    // $tweetstatus = substr($retweet['status'],0, strpos($retweet['status'], ' ', 200)).'
                                                $tweettext = substr($retweet['status'], 0, 200);
                                                $tweetstatus = substr($retweet['status'], 0, strrpos($tweettext, ' ')).'
                                                <span class="readtext-tweet-readmore" data-tweettext="'.$retweet['tweet_id'].'"><a href="javascript:void(0)" id="readtext-tweet-readmore" data-tweettext="'.$retweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                                echo $home->getTweetLink($tweetstatus);
                                                }else{
                                                echo $home->getTweetLink($retweet['status']);
                                                }  
                                                
                                             if (strlen($retweet['status']) > 200) {
                                                // $tweetstatus = substr($retweet['status'],0, strpos($retweet['status'], ' ', 200)).'
                                                $tweettext = substr($retweet['status'], 0, 200);
                                                $tweetstatus = substr($retweet['status'], strrpos($tweettext, ' '));
                                                echo '<span style="display: none;" class="more-text view-more-text'.$retweet["tweet_id"].'">'.$home->getTweetLink($tweetstatus).'</span>';
                                            }  
                                            ?>
                                            </div>

                                            <!-- TEXT -->
                                            <!-- TEXT -->
                                            <?php 
                                            //  if ($retweet['tweet_image'] == true) {
                                            if (!empty($retweet['donation_payment'])) {
                                                $equal = '';
                                                if (!empty($donation_payment) && !empty($retweet['tweet_image']) ) {
                                                    $equal.=  '=';
                                                }
                                                $donation_payment= $equal.$retweet['donation_payment'];
                                            }else {
                                                $donation_payment='';
                                            }
                                            
                                            $photo = $retweet['tweet_image'].$donation_payment;
                                            // var_dump($donation_payment,$photo);
                                            $expodefile = explode("=",$photo);
                                            $title= $retweet["photo_Title"];
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
                                                $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);
                    
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

                                                $expode = $expodefile;
                                                $file_size = $retweet['tweet_image_size'];
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
                                                            <?php echo Follow::coins_recharge_tweet($retweet['user_id'],$user_id,$username,$retweet['username'],$retweet["tweet_id"]); ?>
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
                                                
                                                    } ?> 
                                                    </div>
                                                <?php } ?>

                                           
                                </div>
                		   </div> <!-- retweet-popup-comment-wrap -->
                		</div> <!-- card-body -->
                		<div class="card-footer"> 
                		</div>
                	</div>
                </div>
             </div> 

<?php 
}
?>
