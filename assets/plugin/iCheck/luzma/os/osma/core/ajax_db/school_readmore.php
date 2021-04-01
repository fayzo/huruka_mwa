<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['school_id']) && !empty($_POST['school_id'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else {
        # code...
        $username= $users->test_input('irangiro');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);
        $user_id= $profileData['user_id'];
    }
    
    $school_id = $_POST['school_id'];
    $user= $school->schoolReadmore($school_id);
     ?>
<style>
    	ul{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}
		.demo{
			width: 800px;
		}
    </style>
<div class="school-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
           <div class="img-popup-wrap"  id="popupEnd">

        	<div class="img-popup-body">

            <div class="card">
                <div class="card-header">
                   <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

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
                             <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['firstname']." ".$user['lastname'] ;?></a>
                             <!-- //Jonathan Burke Jr. -->
                         </span>
                         <span class="description">Shared publicly - <?php echo $users->timeAgo($user['created_on_']) ;?></span>
                     </div> <!-- /.user-block -->
                </div> <!-- /.card-header -->

                <div class="card-body">

                   <div class="row reusercolor p-2">
                       <div class="col-md-12">
                            <h5 class="text-center black-bg h4 mb-2"><?php echo $user['type_of_school']." in ".$user['provincename']." /".$user['namedistrict']."/".$user['namesector']; ?></h5>
                             <!-- < ?php echo $school['provincename']; ?> /  -->
                                <!-- < ?php echo $school['namedistrict']; ?> District/  -->
                                <!-- < ?php echo $school['namesector']; ?> Sector/  -->
                                <!-- < ?php echo $school['nameCell']; ?> Cell  -->
                       </div>

                       <div class="col-md-6">
                            <div class="clearfix" style="max-width:474px;">
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                <?php 
                                        $file = $user['photo_']."=".$user['other_photo_'];
                                        $expode = explode("=",$file);
                                        // $splice = array_expode ($expode,0,10);
                                        for ($i=0; $i < count($expode); ++$i) { 
                                            ?>
                                            <li data-thumb="<?php echo BASE_URL_PUBLIC.'uploads/school/'.$expode [$i]; ?>" > 
                                               <img src="<?php echo BASE_URL_PUBLIC.'uploads/school/'.$expode [$i]; ?>" />
                                            </li>
                                      <?php } ?>
                                </ul>
                            </div>  
                        <h4 class="mt-2"><i>School Info</i></h4>

                        <div><i class="h5"> Seller: <?php echo $user['author_']; ?></i>
                        <span <?php if(isset($_SESSION['key'])){ echo 'class="btn-sm btn-primary people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>"><i class="fa fa-envelope-o"></i> Message </span><br>
                        </div>

                        <div class="b">
                            Location: 
                            <?php echo $user['provincename']."/".$user['namedistrict']."/".$user['namesector']."/".$user['nameCell']; ?></div>
                        <div class="mb-2">
                                <span>Phone: <?php echo $user['phone_']; ?></span><br>
                                <span>Type of school: <?php echo $user['type_of_school']; ?></span><br>
                        </div>

                       </div> <!-- col-md-6  -->
                       <div class="col-md-6">
                            <h4 class="mt-2"><i>Details of school</i></h4>
                            <div class="mt-2">
                                <?php echo $user['text_']; ?>
                            </div>
                            <!-- <ul>
                                <li>200 m square feet Garden,</li>
                                <li>4 bedroom,</li>
                                <li>2 bathroom, </li>
                                <li>kitchen and cabinet,</li>
                                <li>car parking ,</li>
                                <li>dapibuseget quame</li>
                            </ul>       -->
                       </div><!-- /.col -->
                       <?php 
                        $file = $user['photo_']."=".$user['other_photo_'];
                        $expodefile = explode("=",$file); 
                        $fileActualExt= array();
                         for ($i=0; $i < count($expodefile); ++$i) { 
                             $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                         }
                         $allower_ext = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
             if (array_diff($fileActualExt,$allower_ext) == false) {

                        $file = $user['photo_']."=".$user['other_photo_'];
                        $expode = explode("=",$file);  
                        $count = count($expode); ?>

               <?php if ($count < 4) { ?>

                         <?php 
                               $file = $user['photo_']."=".$user['other_photo_'];
                               $title= $user['photo_Title_main']."=".$user["photo_Title"];
                               $photo_Title=  explode("=",$title);
                               $explode = explode("=",$file);
                               $splice= array_splice($explode,0,3);
                               for ($i=0; $i < count($splice); ++$i) { 
                                   ?>
                                    <div class="col-md-6 mt-2">
                                         <div class="imageschoolViewPopup more"  data-school="<?php echo $user["school_id"] ;?>">
                                         <img src="<?php echo BASE_URL_PUBLIC."uploads/school/".$splice[$i] ;?>"
                                             alt="photo_" >
                                         </div>
                                     <div class="h5"><i><?php echo $photo_Title[$i]; ?></i></div>
                                   </div>
                             <?php } ?>

                  <?php }else if ($count > 4) { ?>

                            <?php 
                               $file = $user['photo_']."=".$user['other_photo_'];
                               $title= $user['photo_Title_main']."=".$user["photo_Title"];
                               $photo_Title=  explode("=",$title);
                               $explode = explode("=",$file);
                               $splice= array_splice($explode,0,4);
                               for ($i=0; $i < count($splice); ++$i) { 
                                   ?>
                                    <div class="col-md-6 mt-2">
                                         <div class="imageschoolViewPopup more"  data-school="<?php echo $user["school_id"] ;?>">
                                         <img src="<?php echo BASE_URL_PUBLIC."uploads/school/".$splice[$i] ;?>"
                                             alt="photo_" >
                                         </div>
                                     <div class="h5"><i><?php echo $photo_Title[$i]; ?></i></div>
                                   </div>
                             <?php } ?>

                            <span class="btn btn-primary imageschoolViewPopup  float-right" data-school="<?php echo $user["school_id"] ;?>" > View More photo_  <i class="fa fa-picture-o"></i> >>> </span>

                  <?php } ?>
                  
               <?php } ?>
                   </div><!-- /.row -->
                </div><!-- /.card-body -->
                <div class="card-footer text-muted">
                    Footer
                </div><!-- /.card-footer -->
            </div>


           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
 <script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:1500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});
    </script>
<?php } 