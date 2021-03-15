<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['available']) && !empty($_POST['available'])) {
    $user_ids= $_SESSION['key'];
	$house_id= $_POST['house_id'];
	$user_id= $_POST['user_id'];
    $available= $_POST['available'];
    $discount_change= $_POST['discount_change'];
    $price_discount= $_POST['price_discount'];
	$price= $_POST['price'];
    $banner= $_POST['banner'];
    
    $icyamunara->updateReal('icyamunara',array(
        
        'banner' => $banner, 
        'buy' => $available, 
        'discount' => $discount_change, 
        'price_discount' => $price_discount, 
        'price' => $price,
        'house_id' => $house_id

    ),array(
        'house_id' => $house_id
    ));
    
    // $icyamunara->update_cyamunara($banner,$available,$discount_change,$user_id, $price_discount,$price,$house_id);
}

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$house_id= $_POST['deleteTweetHome'];
    $icyamunara->deleteLikesCyamunara($house_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$house_id= $_POST['showpopupdelete'];
	$house_user_id= $_POST['deleteEvents'];
    $houses=$icyamunara->cyamunara_getPopupTweet($user_id,$house_id,$house_user_id);
    ?>
    <div class="house-popup">
      <div class="wrap5">
        <div class="post-popup-body-wrap" style="top: 15%;">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header">
                    <span class="closeDelete"><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center text-muted">Are you sure you want to delete this Posts?</h5>
                </div>
                <div class="card-body">

                <div class="shadow-lg">
                    <div class="user-block border-bottom">
                     <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                                     <?php if (!empty($houses['profile_img'])) {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $houses['profile_img'] ;?>" alt="User Image">
                                     <?php  }else{ ?>
                                       <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                     <?php } ?>
                               </div>
                            </div>
                        <span class="username">
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $houses['firstname']." ".$houses['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($houses['created_on3']); ?></span>
                        </span>
                        <span class="description"></span>
                    </div> <!-- user-block -->

           <ul class="timeline timeline-inverse">  
                    <li class="time-label">
                        <?php echo $house->buychangesColor($houses['buy']); ?>
                     
                         <?php if($houses['discount'] != 0){ ?>
                            <?php echo $house->PercentageDiscount($houses['discount']); ?>
                        <?php }else { echo '';  ?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                        <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/house/'.$houses['photo'] ;?>" alt="Card image cap"> -->
                        <div class='card-img-left flex-auto d-none d-lg-block' style="background: url('<?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$houses['photo']; ?>')no-repeat center center;background-size:cover;height:100px;width:100px">
                        <?php $banner = $houses['banner'];
                        switch ($banner) {
                            case $banner == 'new':
                                # code...
                                echo '<img style="margin-left: -10px;" src="'.BASE_URL_LINK.'image/banner/new.png" height="100px" width="100px">';
                                break;
                            case $banner == 'great_deal':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/great-deal.png" height="100px" width="100px">';
                                break;
                            case $banner == 'new_arrival':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival.png" height="100px" width="100px">';
                                break;
                            case $banner == 'vegetables':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival5.png" height="100px" width="100px">';
                                break;
                            case $banner == 'macedone':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival5.png" height="100px" width="100px">';
                                break;
                            
                        } ?>
                          
                        </div>
                        <div class="card-body pt-0">
                           <div class="text-primary mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="house-readmore" data-house="<?php echo $houses['house_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                 <!-- < ?php echo $icyamunara['provincename']; ?> /  -->
                                <?php echo $houses['namedistrict']; ?> District/ 
                                <?php echo $houses['namesector']; ?> Sector
                                <!-- < ?php echo $icyamunara['nameCell']; ?> Cell  -->
                            </a>
                               <!-- <span class="float-right"> < ?php echo $houses['price']; ?> Frw</span> -->
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-home" aria-hidden="true"></i>cyamunara</span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $house->timeAgo($houses['created_on3'])." By ".$houses['authors']; ?></span>
                            </div>
                            <p class="card-text clear-float">200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading... </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <li>
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </li>
                  </ul>
                      
                </div><!-- shadow -->

                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it-house  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- rehouse-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- rehouse-popup -->

<?php
}
?>