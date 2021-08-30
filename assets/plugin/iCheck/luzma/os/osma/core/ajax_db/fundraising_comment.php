<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['comments']) && !empty($_POST['comments'])) {
    $user_id= $_SESSION['key'];
    $fund_id= $_POST['fund_id'];
    $commentz= $users->test_input($_POST['comments']);

    if (!empty($commentz)) {
        # code...
        $home->createsComment('comment_funding',array('comment' => $commentz,'comment_on' => $fund_id,'comment_by' => $user_id,'comment_at' => date('Y-m-d H:i:s')));
        $commentx= $fundraising->Fundraising_comments($fund_id);
		 # code..
		foreach ($commentx as $user) { 
            $likes= $fundraising->Fundraising_comment_like($user_id,$user['comment_id']); ?>

            <div class="user-block mt-3"  id="userComment<?php echo $user["comment_id"]; ?>">
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
                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"> <?php echo $user['username']; ?> comment on - <?php echo $users->timeAgo($user['comment_at']) ;?></a>
                   <!-- <span class="float-right mr-1">44 <i class="fa fa-heart"></i> -->
                        <?php if($likes['like_on_'] == $user['comment_id']){ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraisingUser-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts_'] ;?></span> <i class="fa fa-heart"  ></i></span>
                        <?php }else{ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraisingUser-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts_'] > 0){ echo $user['likes_counts_'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                        <?php } ?>

                        <?php if($user["comment_by"] === $user_id){ ?>
                            <span class="deleteFundraisingComment more" data-fund="<?php echo $user["fund_id"]; ?>" data-comment="<?php echo $user["comment_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span>
                        <?php }else { echo ''; } ?>
                    </span>
                    <!-- //Jonathan Burke Jr. -->
                </span>
                <span class="description"><?php echo $user['comment']; ?> </span>
            </div> <!-- /.user-block -->
    <?php }
    }
}


if (isset($_POST['deletecomment_id']) && !empty($_POST['deletecomment_id'])) {
    $user_id= $_SESSION['key'];
	$comment_id= $_POST['deletecomment_id'];
    $comment->delete('comment_funding',array('comment_id' => $comment_id,'comment_by' => $user_id));
    
}
?>