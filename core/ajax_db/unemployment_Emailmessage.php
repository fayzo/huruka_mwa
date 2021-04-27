<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    // $user_id= $_SESSION['key'];
    $user_id = $_POST['user_id'];
    $user= $home->userData($user_id);
?>

<div class="user-popup">
    <div class="wrap6">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap">
        	<div class="img-popup-body">
        <form method="post" id="email-composer-new" enctype="multipart/form-data" >

         <div class="card">
             <div class="card-header text-center">
                 <h5 class="card-title"><i class="fa fa-pencil"></i> Compose New Message</h5>
             </div>
             <div class="card-body">
                <!-- <input type="hidden" id="user_id" name="user_id" value="< ?php echo $user_id ;?>"> -->
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['key'];?>">

                 <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">TO:</span>
                        </div>
                        <input class="form-control emailcomposer search-email-composer" name="emailcomposer"  value="<?php echo $user['email']; ?>" placeholder="To: <?php echo $user['email']; ?>" readonly>
                    </div>
                 </div>

                 <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">From:</span>
                        </div>
                        <input class="form-control emailcomposerFROM " name="emailcomposerFROM"  value="<?php echo $_SESSION['email']; ?>" placeholder="From: <?php echo $_SESSION['email']; ?>" readonly>
                    </div>
                 </div>

                 <div class="form-group">
                     <input class="form-control subjectcomposer" name="subjectcomposer" placeholder="Subject:">
                 </div>
                 <div class="form-group">
                     <textarea name="textcomposer" class="form-control textcomposer" id="editor2" style="height: 300px">
                    </textarea>
                 </div>
                 <div class="form-group">
                     <div class="btn btn-defaults btn-file">
                         <i class="fa fa-paperclip"></i> Attachment
                         <input type="file" id="filecomposer" onChange="displayImageNameSize0(this)" name="file[]" multiple>
                     </div>
                     <small class="help-block">Max. 32MB</small>
                 </div> 
                 <div class="row">
                    <div class="col-6" id="add-photo1">
                    </div>
                </div>
             </div>
             <!-- /.card-body -->
             <div class="card-footer">
                <span id="responseSubmit"></span>

                 <div class="float-right">
                     <!-- <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                     <button type="button" class="btn btn-primary email-composer-new1" name="send" id="sendx" value="send"><i class="fa fa-envelope-o"></i> Send</button>
                 </div>
                 <button type="reset" class="btn btn-default" data-dismiss="card"><i class="fa fa-times"></i>
                     Discard</button>
                 <button class="btn btn-secondary" data-dismiss="card">Close</button>
             </div>
         </div>
        </form>

          </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<!-- <script>
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text edito
    });
</script> -->
<?php } 


if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $unemployment->searchUnemployment($search);
    echo '<h4 style="padding: 0px 10px;">'.$_POST['search'].'</h4> ';

     if (is_array($result) || is_object($result)){

     foreach ($result as $row) { ?>

        <div class="row">
             <div class="col-12 py-2 jobHover more" data-user="<?php echo $row['user_id'];?>" >
                <div class="user-block mb-2" >
                   <div class="user-jobImgall img_size" id="unemployment" data-user="<?php echo $row['user_id'];?>">
                         <?php if (!empty($row['profile_img'])) {?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
                    <div style="display: flow-root;" class="text_size">
                        <div class='float-left'>
                            <span> <?php echo $row['username']; ?> </span><br> <!-- Names: -->
                            <span><?php echo $row['education']; ?> </span><br><!-- education:  -->
                            <span><?php echo $row['diploma']; ?> </span><br><!-- diploma:  -->
                            <span ><?php echo $row['categories_fields']; ?> </span><!-- study:  -->
                        </div>
                        <!-- hidden-xs -->
                        <div class="float-right text-right ">
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>"><i class="fa fa-envelope-o"></i> Message </span><br>
                            <span  <?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>">@Mail</span><br>
                            <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                                <span><?php echo $row['phone']; ?> </span><br>
                            <?php  }else{ ?>
                                <div>RW <i class="flag-icon flag-icon-rw h4 mb-0" id="rw" title="us"></i></div>
                            <?php  } ?>
                            <!-- <span  < ?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="< ?php echo $row['user_id'];?>">< ?php echo $row['email']; ?></span><br> -->
                            <span>Unemployment: <?php echo $row['unemployment']; ?> </span>
                        </div>
                    </div>
                </div> <!-- user-block -->
            </div> <!-- col-12 -->
            </div> <!-- row -->
          <hr class="bg-info mt-0 mb-1" style="width:70%;">


        <?php } 
        }
} 



if (isset($_POST['searchProfess']) && !empty($_POST['searchProfess'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['searchProfess']);
    $result= $employment->searchemployment($search);
    echo '<h4 style="padding: 0px 10px;">'.$_POST['searchProfess'].'</h4> ';

     if (is_array($result) || is_object($result)){

     foreach ($result as $row) { ?>

             <div class="row">
             <div class="col-12 py-2 jobHover more" data-user="<?php echo $row['user_id'];?>" >
                <div class="user-block mb-2" >
                   <div class="user-jobImgall img_size" id="unemployment" data-user="<?php echo $row['user_id'];?>">
                         <?php if (!empty($row['profile_img'])) {?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
                    <div style="display: flow-root;" class="text_size">
                        <div class='float-left'>
                            <span> <?php echo $row['username']; ?> </span><br> <!-- Names: -->
                            <span><?php echo $row['education']; ?> </span><br><!-- education:  -->
                            <span><?php echo $row['diploma']; ?> </span><br><!-- diploma:  -->
                            <span ><?php echo $row['categories_fields']; ?> </span><!-- study:  -->
                        </div>
                        <!-- hidden-xs -->
                        <div class="float-right text-right ">
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>"><i class="fa fa-envelope-o"></i> Message </span><br>
                            <span  <?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>">@Mail</span><br>
                            <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                                <span><?php echo $row['phone']; ?> </span><br>
                            <?php  }else{ ?>
                                <div>RW <i class="flag-icon flag-icon-rw h4 mb-0" id="rw" title="us"></i></div>
                            <?php  } ?>
                            <!-- <span  < ?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="< ?php echo $row['user_id'];?>">< ?php echo $row['email']; ?></span><br> -->
                            <span>Unemployment: <?php echo $row['unemployment']; ?> </span>
                        </div>
                    </div>
                </div> <!-- user-block -->
            </div> <!-- col-12 -->
            </div> <!-- row -->
          <hr class="bg-info mt-0 mb-1" style="width:70%;">


        <?php } 
        }
} ?>