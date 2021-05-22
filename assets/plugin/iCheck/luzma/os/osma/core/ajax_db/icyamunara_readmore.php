<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['house_id']) && !empty($_POST['house_id'])) {
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
    
    $house_id = $_POST['house_id'];
    $user= $icyamunara->icyamunaraReadmore($house_id);
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
<div class="icyamunara-popup">
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
                             <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                             <!-- //Jonathan Burke Jr. -->
                         </span>
                         <span class="description">Shared publicly - <?php echo $users->timeAgo($user['created_on3']) ;?></span>
                     </div> <!-- /.user-block -->
                </div> <!-- /.card-header -->

                <div class="card-body">

                   <div class="row reusercolor p-2">
                       <div class="col-md-12">
                            <h5 class="text-center black-bg h4 mb-2"><?php echo "Marketplace in ".$user['provincename']." Location ".$user['namedistrict']." district/".$user['namesector']." sector/".$user['nameCell']." cell"; ?></h5>
                             <!-- < ?php echo $house['provincename']; ?> /  -->
                                <!-- < ?php echo $house['namedistrict']; ?> District/  -->
                                <!-- < ?php echo $house['namesector']; ?> Sector/  -->
                                <!-- < ?php echo $house['nameCell']; ?> Cell  -->
                       </div>

                       <div class="col-md-6 mb-2">

                            <div class="clearfix" style="max-width:474px;">
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                <?php 
                                        $file = $user['photo']."=".$user['other_photo'];
                                        $expode = explode("=",$file);
                                        // $splice = array_expode ($expode,0,10);
                                        for ($i=0; $i < count($expode); ++$i) { 
                                            ?>
                                            <li data-thumb="<?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$expode [$i]; ?>" > 
                                               <img src="<?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$expode [$i]; ?>" />
                                            </li>
                                      <?php } ?>
                                </ul>
                            </div>  
                        </div> <!-- col-md-6  -->
                        <div class="col-md-6 mb-2">
                            <h4 class="mt-2"><i>Personal Info</i></h4>
                            
                            <div><i class="h5"> Seller: <?php echo $user['authors']; ?></i>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="btn-sm btn-primary people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>"><i class="fa fa-envelope-o"></i> Message </span><br>
                            </div>
                            
                            <div class="b">
                            Location: 
                                <?php echo $user['provincename']."/".$user['namedistrict']."/".$user['namesector']."/".$user['nameCell']; ?>
                            </div>
 
                            <div class="mb-2">
                                <span>Phone: <?php echo $user['phone']; ?></span><br>
                                <span>Price: <?php echo number_format($user['price'])." Frw"; ?></span><br>
                            </div>
                            <h4 class="mt-2"><i>Details of Cyamunara</i></h4>
                            <div class="mt-2">
                                <?php echo $user['text']; ?>
                            </div>
                            <!-- <ul>
                                <li>200 m square feet Garden,</li>
                                <li>4 bedroom,</li>
                                <li>2 bathroom, </li>
                                <li>kitchen and cabinet,</li>
                                <li>car parking ,</li>
                                <li>dapibuseget quame</li>
                            </ul>       -->

                            <div class="p-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text btn btn-default" onclick="copyText()" data-toggle="tooltip" title="Contacts" data-original-title="Contacts" id="basic-addon2">Copy Link</button>
                                    </div>
                                    <input type="text" id="mycopyText" style="width:1px" class="form-control" value="<?php echo BASE_URL_PUBLIC."icyamunaraa?id=".$_POST['house_id'];?>" readonly>
                                </div>
            
                                <a class="btn btn-sm btn-primary mt-2" href="<?php echo BASE_URL_PUBLIC."icyamunaraa?id=".$_POST['house_id'];?>"> Redirect to link</a>
            
                                <script>
                                    function copyText() {
                                        var copyText = document.getElementById('mycopyText');
                                        copyText.select();
                                        copyText.setSelectionRange(0,99999);
                                        document.execCommand('copy');
                                        alert('Copied a Url link: ' + copyText.value);
                                        // alert('Copied a Url link: ' + copyText.innerHTML);
                                        // alert('Copied a Url link: ' + copyText.childNodes[0].nodeValue);
                                    }
                                </script>
            
                            </div>
                        </div>
                        
                <?php 
                        $expodefile = explode("=",$user['photo']."=".$user['other_photo']); 
                        $title= $user['photo_Title_main']."=".$user["photo_Title"];
                        $photo_title=  explode("=",$title);

                        $fileActualExt= array();
                        for ($i=0; $i < count($expodefile); ++$i) { 
                            $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
                        }
                        $image= array('jpg','jpeg','png','gif'); // valid extensions
                        $allower_ext= array('jpg','jpeg','png','gif'); // valid extensions

                    if (array_diff($fileActualExt,$allower_ext) == false) { 
                            # code...
                                
                            $fileActualExt_image =array_intersect($fileActualExt,$image);
                            $count_image =count(array_intersect($fileActualExt_image,$image));
                            $filePathinfo_image=array();

                            
                    if(!empty($fileActualExt_image)) { 
                            
                        foreach ($expodefile as $file_image) {
                            # code...
                            $filePathinfo = pathinfo($file_image);

                            if (in_array($filePathinfo['extension'],$fileActualExt_image)) {
                                # code...
                                $filePathinfo_image[]= $filePathinfo['basename'];
                            }
                        }

                    if ($count_image === 1) { ?>

                        <div class="row mb-1">
                                <?php $expode = $filePathinfo_image; ?>
                            <div class="col-12 more">
                                <img style="width: 100%;height: auto;" class="imagehouseViewPopupmore"  data-house="<?php echo $user["house_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/icyamunara/".$expode[0] ;?>" >
                                    <div class="h5"><i><?php echo $photo_title[0]; ?></i></div>
                            </div>
                        </div>

                    <?php
                        }else if($count_image === 2){?>
                        <div class="row mb-2 more">
                                <?php $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,0,2);
                                    for ($i=0; $i < count($splice); ++$i) { 
                                    ?>
                            <div class="col-sm-12 col-md-6">
                                <img style="width: 100%;height: auto;" class="imagehouseViewPopupmore"  data-house="<?php echo $user["house_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/icyamunara/".$splice[$i] ;?>" >
                                    
                                    <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                            </div>
                                <?php }?>
                        </div>

                    <?php }else if($count_image === 3 || $count_image > 3){?>
                        <div class="row mb-2 more">
                            <?php $expode = $filePathinfo_image;
                                $splice= array_splice($expode,0,1);
                                ?>
                        <div class="col-6">
                            <img style="width: 100%;height: auto;" class="imagehouseViewPopupmore"  data-house="<?php echo $user["house_id"] ;?>"
                                src="<?php echo BASE_URL_PUBLIC."uploads/icyamunara/".$splice[0] ;?>" >
                                <div><i><?php echo $photo_title[0]; ?></i></div>
                        </div>
                        <!-- /.col -->

                        <div class="col-6">
                            <div class="row mb-2 more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    // var_dump($expode);
                                    $splice= array_splice($expode,1,2);
                                    // var_dump($splice);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                    <img style="width: 100%;height: auto;" class="imagehouseViewPopupmore"  data-house="<?php echo $user["house_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/icyamunara/".$splice[$i] ;?>" >
                                     <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                            <div class="row more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,3,2);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                   <img style="width: 100%;height: auto;" class="imagehouseViewPopupmore"  data-house="<?php echo $user["house_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/icyamunara/".$splice[$i] ;?>" >
                                        
                                        <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                        <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <span class="btn btn-primary imagehouseViewPopup float-right" data-house="<?php echo $user["house_id"] ;?>" > View More photo  <i class="fa fa-picture-o"></i> >>> </span>
                        </div>
                    </div>
                    <!-- /.row -->
                        
                    <?php }  } } ?>
                    
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