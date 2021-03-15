<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['key']) && $_POST['key'] == 'Unemployment') {
    
    $user_id = $users->test_input($_POST['user_id1']);
    $Career = $users->test_input($_POST['Career']);
    $years = $users->test_input($_POST['years']);
    $field = $users->test_input($_POST['field']);
    $diploma = $users->test_input($_POST['diploma']);
    $age = $users->test_input($_POST['age']);
    $status = $users->test_input($_POST['status']);
    $phone = $users->test_input($_POST['phone']);
    $course = $users->test_input($_POST['course']);
    $editor1 = $users->test_input($_POST['editor1']);
    $unemployment = (($_POST['Career'] == 'unemployment'))?'yes':'no';

    $users->update('users',array( 
    'career'=> $Career, 
    'years' => $years,
    'field' => $field, 
    'categories_fields' => $field, 
    'diploma' => $diploma,
    'age'=> $age,
    'status_career'=> $status,
    'phone'=> $phone,
    'course' => $course,
    'unemployment' => $unemployment,
    'about'=> $editor1 ),array('user_id'=> $user_id, ));


    exit('success');
}


if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id= $_POST['user_id'];
    $user= $home->userData($user_id);
     ?>
<style>
.active{
    color: #fff;
}
</style>
<div class="user-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-bodys">

            <div class="container-fuild">
                <div class="row">

                    <div class="col-12">
                        <div class="card card-widget widget-user" style="height:150px;">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <?php if (!empty($user['cover_img'])) { ?>
                                <div class="widget-user-header text-white"
                                    style="background: url('<?php echo BASE_URL_LINK."image/users_cover_profile/".$user['cover_img'] ;?>')no-repeat center center;background-size:cover;">
                            <?php }else{ ?>
                                <div class="widget-user-header text-white"
                                    style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>')no-repeat center center;background-size:cover;">
                        <?php  } ?>
                                <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3>  -->
                                <h3 class="widget-user-username"><?php echo $user['firstname'].' '.$user['lastname']; ?></h3> 
                                <h5 class="widget-user-desc"><?php echo $user['categories_fields']; ?></h5>
                                <!-- web developers -->
                            </div>

                        </div>
                        <!-- /. card widget-user -->
                    </div>
                    <!-- column -->
                </div>
                <!-- row -->
            </div>
            <!-- container-fuild -->
        <div class="container">
            <div class="row mb-3" style="background:#fff">
                <div class="col-md-2 unemploy-profile">
                  <?php if (!empty($user['profile_img'])) {?>
                        <img class="rounded-circle " src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'];?>" alt="User Avatar">
                    <?php  }else{ ?>
                        <img class="rounded-circle" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Avatar">
                    <?php } ?>
                </div>
                <div class="col-md-1-3 mr-3 p-2">
                    <div><?php echo $user['firstname'].' '.$user['lastname']; ?></div>
                    <!-- <h4>Elizabeth Pierce</h4> -->
                    <div><?php echo $user['country']; ?>
                    <i class="flag-icon flag-icon-<?php echo strtolower($user["country"]) ;?> h4 mb-0"
                             id="<?php echo strtolower($user["country"]) ;?>" title="us"></i>
                    </div>
                    <!-- <div>Rwanda</div> -->
                </div>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div><?php echo $user['career']; ?></div>
                    <!-- Unemployment -->
                    <div><?php echo $user['years']; ?> years</div>
                </div>

                <div class="col-md-1-3 border-left p-2">
                    <div>Resume || CV</div>
                    <div>Cover letter</div>
                </div>
               
                <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div>Age</div>
                    <div><?php echo $user['age']; ?> years</div>
                </div>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div>Status</div>
                    <div><?php echo $user['status_career']; ?></div>
                </div>
                <?php  } ?>

                <div class="col-md-1-3 p-2"> 
                    <button class="btn btn-success btn-sm d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                </div>

            </div>
        </div>

            <section class="content-header container" style="background:#e8e1e1">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-right text-right pt-3">
                            <ul class="list-inline mb-0">
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary"><i><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Request</i></li> -->
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary emailSent" data-user="< ?php echo $user['user_id'];?>"> <i>< ?php echo $user['email']; ?></i></li> -->
                                <li class="list-inline-item h4" ><a href="javascript:vois(0)" <?php if(isset($_SESSION['key'])){ echo 'class="people-message btn btn-primary"'; }else{ echo 'class="btn btn-primary" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>" > <i style="font-size: 14px;" class="fa fa-envelope-o"> Message </i></a></li>
                            </ul>
                            <div class="h4 btn btn-outline-primary emailSent"  data-user="<?php echo $user['user_id'];?>"> <i><?php echo $user['email']; ?></i></div>
                            <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                            <div class="h4 btn btn-outline-primary" ><i class="fa fa-phone" aria-hidden="true"></i> <i><?php echo $user['phone']; ?> </i></div>
                             <?php  } ?>
                        
                        </div>

                        <div class="text-left pt-3">
                            <ul class="list-inline">
                            <?php
                             $course = $user['course'];
                             $expode = explode(",",$course);
                            for ($i=0; $i < 3; ++$i) { ?>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i><?php echo $expode[$i] ;?></i></li>
                            <?php } 
                            for ($i=4; $i < count($expode); ++$i) { ?>
                                <li class="list-inline-item h4 btn btn-outline-primary d-none d-md-inline"><i><?php echo $expode[$i] ;?></i></li>
                            <?php } ?>
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary"><i> project management</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Account</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Business management</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Finance</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Banking</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> purchase & sale</i></li> -->
                            </ul>
                        </div>

                    </div>
                </div>
            </section>

            <section class="container" >
                <h3>About Me</h3>
                <p><?php echo htmlspecialchars_decode($user['about']); ?></p>
            </section>


           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php } 

if (isset($_POST['key']) && $_POST['key'] == 'edit') {
    
    $user_id = $users->test_input($_POST['rowID']);
    $data= $users->selects('users',
    array(
        'career'=> 'career', 
        'years'=> 'years', 
        'field'=> 'field', 
        'categories_fields'=> 'categories_fields', 
        'diploma'=> 'diploma', 
        'age'=> 'age', 
        'status_career'=> 'status_career', 
        'phone' => 'phone',
        'course'=> 'course', 
        'unemployment'=> 'unemployment', 
        'about'=> 'about', 

    ),array(
         'user_id'=> $user_id,
    ));

    $jsonArrays = array(
        'career' => $data['career'],
        'years' => $data['years'],
        'field' => $data['field'],
        'categories_fields' => $data['categories_fields'],
        'diploma' => $data['diploma'],
        'age' => $data['age'],
        'status' => $data['status_career'],
        'phone' => $data['phone'],
        'course' => $data['course'],
        'unemployment' => $data['unemployment'],
        'about' => htmlspecialchars_decode($data['about']),
    );
    
    exit(json_encode($jsonArrays));
 }