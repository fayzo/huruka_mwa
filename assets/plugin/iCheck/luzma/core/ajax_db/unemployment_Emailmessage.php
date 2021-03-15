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

         <div class="card">
             <div class="card-header text-center">
                 <h5 class="card-title"><i class="fa fa-pencil"></i> Compose New Message</h5>
             </div>
             <div class="card-body">
                 <div class="form-group">
                     <input class="form-control" value="<?php echo $user['email']; ?>" placeholder="To: <?php echo $user['email']; ?>" readonly>
                 </div>
                 <div class="form-group">
                     <input class="form-control" placeholder="Subject:">
                 </div>
                 <div class="form-group">
                     <textarea id="compose-textarea" class="form-control" style="height: 300px">
                      <h1><u>Heading Of Message</u></h1>
                      <h4>Subheading</h4>
                      <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and I will give you a complete account of the system, and expound the actual teachings
                        of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                        how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                        is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                        but because occasionally circumstances occur in which toil and pain can procure him some great
                        pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                        except to obtain some advantage from it? But who has any right to find fault with a man who
                        chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                        produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                        dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                        blinded by desire, that they cannot foresee</p>
                      <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                        <li>List item three</li>
                        <li>List item four</li>
                      </ul>
                      <p>Thank you,</p>
                      <p>John Doe</p>
                    </textarea>
                 </div>
                 <div class="form-group">
                     <div class="btn btn-defaults btn-file">
                         <i class="fa fa-paperclip"></i> Attachment
                         <input type="file" name="attachment">
                     </div>
                     <small class="help-block">Max. 32MB</small>
                 </div> 
             </div>
             <!-- /.card-body -->
             <div class="card-footer">
                 <div class="float-right">
                     <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                 </div>
                 <button type="reset" class="btn btn-default" data-dismiss="card"><i class="fa fa-times"></i>
                     Discard</button>
                 <button class="btn btn-secondary" data-dismiss="card">Close</button>
             </div>
         </div>

          </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php } 


if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $unemployment->searchUnemployment($search);
    echo '<h4 style="padding: 0px 10px;">'.$_POST['search'].'</h4> ';

     if (is_array($result) || is_object($result)){

     foreach ($result as $row) { ?>

         <div class="col-12 px-0 py-2 jobHover more" data-user="<?php echo $row['user_id'];?>" >
            <div class="user-block mb-2" >
             <div class="row">
              <div class="col-2">
                   <div class="user-jobImgall">
                         <?php if (!empty($row['profile_img'])) {?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
              </div>
              <div class="col-10 pl-4">
                  <div>
                      <span class='float-left'>Names: <?php echo $row['firstname']." ".$row['lastname']; ?> </span>
                      <span class="float-right people-message more" data-user="<?php echo $row['user_id'];?>"><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </span>
                  </div>
                  <div class="clear-float">
                      <span class='float-left'>education: <?php echo $row['education']; ?> </span>
                      <span class='float-right emailSent' data-user="<?php echo $row['user_id'];?>"><?php echo $row['email']; ?></span>
                  </div>
                  <div class="clear-float">
                      <span class='float-left'>diploma: <?php echo $row['diploma']; ?> </span>
                      <span class='float-right'><?php echo $row['phone']; ?> </span>
                    </div>
                  <div class="clear-float">
                      <span class='float-left'>Fields study: <?php echo $row['categories_fields']; ?> </span>
                      <span class='float-right'>Unemployment: <?php echo $row['unemployment']; ?> </span>
                  </div>
               </div> <!-- col-10 -->
            </div> <!-- row -->
          </div> <!-- user-block -->
          </div> <!-- col-12 -->
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

         <div class="col-12 px-0 py-2 jobHover more" data-user="<?php echo $row['user_id'];?>" >
            <div class="user-block mb-2" >
             <div class="row">
              <div class="col-2">
                   <div class="user-jobImgall">
                         <?php if (!empty($row['profile_img'])) {?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
              </div>
              <div class="col-10 pl-4">
                  <div>
                      <span class='float-left'>Names: <?php echo $row['firstname']." ".$row['lastname']; ?> </span>
                      <span class="float-right people-message more" data-user="<?php echo $row['user_id'];?>"><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </span>
                  </div>
                  <div class="clear-float">
                      <span class='float-left'>education: <?php echo $row['education']; ?> </span>
                      <span class='float-right emailSent' data-user="<?php echo $row['user_id'];?>"><?php echo $row['email']; ?></span>
                  </div>
                  <div class="clear-float">
                      <span class='float-left'>diploma: <?php echo $row['diploma']; ?> </span>
                      <span class='float-right'><?php echo $row['phone']; ?> </span>
                    </div>
                  <div class="clear-float">
                      <span class='float-left'>Fields study: <?php echo $row['categories_fields']; ?> </span>
                      <span class='float-right'>Unemployment: <?php echo $row['unemployment']; ?> </span>
                  </div>
               </div> <!-- col-10 -->
            </div> <!-- row -->
          </div> <!-- user-block -->
          </div> <!-- col-12 -->
          <hr class="bg-info mt-0 mb-1" style="width:70%;">


        <?php } 
        }
} ?>