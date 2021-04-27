
<?php include "header_navbar_footer/header_if_login.php"?>
<title> Friend Request</title>
<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
    <div class="container-fluid mb-5">
     <!-- Main content -->

        <section class="content-header">
            <div class="row">
                <div class="col-8">
                    <h3>Friend Request</h3>
                </div>
                <div class="col-4">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                        <?php if (isset($_SESSION['key'])){ ?>
                        <?php if ($user['user_id'] != $_SESSION['key']) { ?>
                        <li class="breadcrumb-item"><span class="people-message more" data-user="<?php echo $user['user_id'];?>"><a href="javascript:void(0);" ><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </a></span></li>
                        <?php } } ?>
                    </ol>
                </div>
            </div>
        </section>

        
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <?php if (isset($_SESSION['key'])){ ?>
                    <div class="col-md-3 mb-3 d-none d-md-block">
                        <!-- Profile Image -->
                        <?php echo $home->userProfile($user_id); ?>
                        <!-- hastTag Me Box -->
                        <?php echo $trending->trends(); ?>
                    </div>
                    <!-- /.col -->
                    
            <?php }else{ ?>

                    <div class="col-md-3 mb-3 d-none d-md-block">
                        <?php echo $job->jobsfetch() ;?>
                    </div>

            <?php } ?>

            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12 mb-4"  id="jobs-hides">
                        <!-- jobs -->
                        <ul class="whoTofollow-list row" id="FriendRequest-menu-view">
                        <?php 
	                    echo '<li class="col-sm-12 col-md-12" ><span id="friendrequest_respone"></span></li>';
                
                        $user_id= $_SESSION['key'];
                        // $tweet_id= $_POST['showMessage'];
                        $mysqli= $db;
                        $query= $mysqli->query("SELECT * FROM  users U Left JOIN  follow F ON F. sender = U. user_id WHERE F. receiver = $user_id and F. status_request = 0  ORDER BY rand() ");
                        ?>
                                <?php while($whoTofollow = $query->fetch_array()) {  
                                    $workname = (strlen($whoTofollow["workname"]) > 20)? substr($whoTofollow["workname"],0,20).'..' : $whoTofollow["workname"];
                    
                    echo '      <li class="col-sm-12 col-md-4 mb-2 bg-light jobHovers more friendrequest_id'.$whoTofollow['sender'].'" style="margin-right: 10px;padding: 5px;border-radius: 5px;">
                                    <div class="whoTofollow-list-img">
                                            '.((!empty($whoTofollow['profile_img'])?'
                                            <img src="'.BASE_URL_LINK."image/users_profile_cover/".$whoTofollow['profile_img'].'">
                                            ':'
                                            <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'">
                                        ')).'
                    
                                        '.$follow->lengthsOfWhoNewCome($whoTofollow['date_registry']).'
                                    </div>
                                    <ul class="whoTofollow-list-info">
                                        <li><a href="'.BASE_URL_PUBLIC.$whoTofollow['username'].'" id="'.$whoTofollow["user_id"].'" >'.$whoTofollow['username'].'</a>
                                        </li>
                                        <li>'.((!empty($workname)?'
                                        <small class="my-0" style="font-size: 12px;">'.$workname.'</small>
                                        ':'
                                        <small class="my-0" style="font-size: 12px;">Member</small>
                                        ')).'</li>
                                    </ul>
                                    <div class="whoTofollow-btn">
                                            <div class="my-0 ml-2">'.$follow->FriendRequestBtns($whoTofollow['user_id'],$user_id,$user_id).'</div>
                                        <!-- <a href="#" type="button" class="btn main-active btn-sm">Follow</a> -->
                                    </div>
                                </li> ';
                                    
                            } ?>

                            </ul>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-6 -->

            <div class="col-md-3">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12 mb-3">
                       <?php echo $home->options(); ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>


<?php include "header_navbar_footer/footer.php"?>
