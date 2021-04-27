<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['comments']) && !empty($_POST['comments'])) {
    $user_id= $_SESSION['key'];
    $tweet_id= $_POST['tweet_id'];
    $commentz= $users->test_input($_POST['comments']);

    if (!empty($commentz)) {
        # code...
        $home->createsComment('comment',array('comment' => $commentz,'comment_on' => $tweet_id,'comment_by' => $user_id,'comment_at' => date('Y-m-d H:i:s')));
        $commentx= $comment->comments($tweet_id);
        $tweet= $home->getPopupTweet($user_id,$tweet_id,$commentz);
		 # code..
           
            if (!empty($commentx)) {  
                echo '<span id="responseDeletePostSeconds0"></span>
                <div class="direct-chat-message direct-chat-messageS large-2" > '; 
            } else{ echo '<div class="direct-chat-message_ direct-chat-messageS">'; } ?>
                
            <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">

            <?php if (!empty($commentx)) { ?>
                <?php foreach ($commentx as $comments) { 
                     $second_likes= $posts_home->Like_second($user_id,$comments['comment_id']);
                     $dislikes= $posts_home->dislike($user_id,$comments['comment_id']); 
                    ?>
                    <!-- Conversations are loaded here -->
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name float-left mr-1"><a href="<?php echo BASE_URL_PUBLIC.$comments["username"];?>"><?php echo $comments["username"] ;?></a> ||</span>
                                <span class="direct-chat-name float-left"><?php echo $comments["workname"] ;?></span>
                                <span class="direct-chat-timestamp float-right"><?php echo $posts_home->timeAgo($comments['comment_at']); ?></span>
                            </div>
                            <!-- /.direct-chat-info -->
                                <?php if (!empty($comments["profile_img"])) {?>
                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                <?php  }else{ ?>
                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                <?php } ?>
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?php echo  $posts_home->getTweetLink($comments["comment"]) ;?>
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
                                <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $posts_home->CountsComment_second($comments["comment_id"]); ?>)
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
                                $comment_second= $posts_home->comments_second($comments['comment_id']);
                                
                                if (!empty($comment_second)) {  
                                    echo '<h5><i>Comments('.$posts_home->CountsComment_second($comments["comment_id"]).')</i></h5>
                                    <span id="responseDeletePostSecond"></span>
                                    <div class="direct-chat-message direct-chat-messageS large-2" > '; 
                                }else{ echo '<div class="direct-chat-message_ direct-chat-messageS">'; } ?>
                                
                                <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">

                                <?php if (!empty($comment_second)) { ?>
                                
                                <?php foreach ($comment_second as $comments0) { ?>
                                        <!-- Conversations are loaded here -->
                                        <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name float-left mr-1"><a href="<?php echo BASE_URL_PUBLIC.$comments0["username"];?>"><?php echo $comments0["username"] ;?></a> ||</span>
                                                    <span class="direct-chat-name float-left"><?php echo $comments0["workname"] ;?></span>
                                                    <span class="direct-chat-timestamp float-right"><?php echo $posts_home->timeAgo($comments0['comment_at_']); ?></span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <?php if (!empty($comments0["profile_img"])) { ?>
                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                <?php  }else{ ?>
                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                <?php } ?>
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    <?php echo  $posts_home->getTweetLink($comments0["comment_"]) ;?>
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
                                <?php } ?>
                                </span>
                            </div> <!-- /.direct-chat-message -->

                        </div> <!-- /.card-body-->
                        </div> <!-- /.card collapse -->
                        </div> <!-- /.direct-chat-msg -->
                        
                <?php } ?>
                <?php } ?>
                </span>
            </div> <!-- /.direct-message -->
                    
        <?php 
        }
    } 

if (isset($_POST['comment_id']) && !empty($_POST['comment_id'])) {
    $user_id= $_SESSION['key'];
    $comment_id= $_POST['comment_id'];
    $commentz= $users->test_input($_POST['comments_']);

    if (!empty($commentz)) {
        # code...
        $home->createsComment('post_comment',array('comment_' => $commentz,'comment_on_' => $comment_id,'comment_by_' => $user_id,'comment_at_' => date('Y-m-d H:i:s')));
        $commentx= $comment->comments_second($comment_id);
		 # code..
		foreach ($commentx as $comments) { ?>
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg" >
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name float-left mr-1"><a href="<?php echo BASE_URL_PUBLIC.$comments["username"];?>"><?php echo $comments["username"] ;?></a> ||</span>
                    <span class="direct-chat-name float-left"><?php echo $comments["workname"] ;?></span>
                    <span class="direct-chat-timestamp float-right"><?php echo $home->timeAgo($comments['comment_at_']); ?></span>
                </div>
                <!-- /.direct-chat-info -->
                    <?php if (!empty($comments["profile_img"])) { ?>
                    <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                    <?php  }else{ ?>
                    <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                    <?php } ?>
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    <?php echo  $home->getTweetLink($comments["comment_"]) ;?>
                </div>

                <!-- /.direct-chat-text -->
                    <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  
                
                        <?php if ($comments["comment_by_"] == $user_id){ ?>
                            <li  class=" list-inline-item">
                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                    <li>
                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                        <ul style="list-style-type: none; margin:0px;" >
                                        <li style="list-style-type: none; margin:0px;"> 
                                            <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments["comment_id_"];?>"  data-user="<?php echo $comments["comment_by_"];?>" >Delete </label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <?php }else{ echo '';}?>
                        </span>
                    </ul>

            </div> <!-- /.direct-chat-msg -->
                
    <?php }
    }
} 

if (isset($_POST['deleteCommentHome']) && !empty($_POST['deleteCommentHome'])) {
    // $user_id= $_SESSION['key'];
    $user_id= $_POST['comment_by'];
    $deletecomment_id= $_POST['deleteCommentHome'];
    $comment->delete('post_comment',array('comment_id_' => $deletecomment_id,'comment_by_' => $user_id));
}

if (isset($_POST['deleteCommentHome0']) && !empty($_POST['deleteCommentHome0'])) {
    // $user_id= $_SESSION['key'];
    $user_id= $_POST['comment_by'];
    $deletecomment_id= $_POST['deleteCommentHome0'];

    $mysqli= $db;
    $query="DELETE C , L , F ,R FROM comment C 
                    LEFT JOIN post_like L ON L. like_on_ = C. comment_id 
                    LEFT JOIN post_dislike F ON F. like_on_ = C. comment_id 
                    LEFT JOIN post_comment R ON R. comment_on_ = C. comment_id 
                    WHERE C. comment_id = '{$deletecomment_id}' and C. comment_by = '{$user_id}' ";

    $query= $mysqli->query($query);
    var_dump("ERROR: Could not able to execute $query.".mysqli_error($db));

    if($query){
            exit('<div class="alert alert-success alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>SUCCESS DELETE</strong> </div>');
        }else{
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>Fail to delete !!!</strong>
            </div>');
    }

}
?>