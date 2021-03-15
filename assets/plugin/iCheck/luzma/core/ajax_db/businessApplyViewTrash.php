<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['trash_id']) ) {
    $user_id= $_SESSION['key'];
    $trash_id= $_POST['trash_id'];
    $mysqli = $db;
    // $query= $mysqli->query("SELECT * FROM users U Left JOIN trash T ON T. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. trash_id = $trash_id ");
    $query= $mysqli->query("SELECT * FROM trash T LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. trash_id = $trash_id ");
    $row = $query->fetch_array();
    ?>
<div class="trash-popup">
    <div class="wrap6">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap">
        	<div class="img-popup-body">

                <div class="card">
                    <span id="responseSubmitdelete"></span>
                     <div class="card-body p-0">
                         <div class="mailbox-read-info">
                             <h5>Message Subject Is Placed Here</h5>
                             <h6>From: <?php echo $row['email_sent_to_'] ;?>
                             <h6>To: <?php echo $row['email0'] ;?>

                                 <span class="mailbox-read-time float-right"><?php echo $home->timeAgo($row['created_on0']) ;?></span></h6>
                         </div>
                         <!-- /.mailbox-read-info -->
                         <div class="mailbox-controls with-border text-center">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm deleteTrashinbox" data-delete="delete" data-trashid="<?php echo $row['trash_id']; ?>" data-toggle="tooltip"
                                     data-container="body" title="Delete">
                                     <i class="fa fa-trash-o"></i></button>
                                 <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                     data-container="body" title="Reply">
                                     <i class="fa fa-reply"></i></button>
                                 <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                     data-container="body" title="Forward">
                                     <i class="fa fa-share"></i></button>
                             </div>
                             <!-- /.btn-group -->
                             <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                 <i class="fa fa-print"></i></button>
                         </div>
                         <!-- /.mailbox-controls -->
                         <div class="mailbox-read-message">
                             <p>Hello John,</p>

                             <p>Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave
                                 put a
                                 bird
                                 on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester
                                 mlkshk.
                                 Ethical
                                 master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk
                                 fanny pack
                                 gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester
                                 chillwave 3 wolf
                                 moon
                                 asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas
                                 church-key
                                 tofu
                                 blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies
                                 narwhal
                                 American
                                 Apparel.</p>

                             <p>Raw denim McSweeney's bicycle rights, iPhone trust fund quinoa Neutra VHS kale chips
                                 vegan
                                 PBR&amp;B
                                 literally Thundercats +1. Forage tilde four dollar toast, banjo health goth paleo
                                 butcher. Four
                                 dollar
                                 toast Brooklyn pour-over American Apparel sustainable, lumbersexual listicle
                                 gluten-free health
                                 goth
                                 umami hoodie. Synth Echo Park bicycle rights DIY farm-to-table, retro kogi sriracha
                                 dreamcatcher PBR&amp;B
                                 flannel hashtag irony Wes Anderson. Lumbersexual Williamsburg Helvetica next level.
                                 Cold-pressed
                                 slow-carb pop-up normcore Thundercats Portland, cardigan literally meditation
                                 lumbersexual
                                 crucifix.
                                 Wayfarers raw denim paleo Bushwick, keytar Helvetica scenester keffiyeh 8-bit irony
                                 mumblecore
                                 whatever viral Truffaut.</p>

                             <p>Post-ironic shabby chic VHS, Marfa keytar flannel lomo try-hard keffiyeh cray. Actually
                                 fap
                                 fanny
                                 pack yr artisan trust fund. High Life dreamcatcher church-key gentrify. Tumblr
                                 stumptown four
                                 dollar
                                 toast vinyl, cold-pressed try-hard blog authentic keffiyeh Helvetica lo-fi tilde
                                 Intelligentsia. Lomo
                                 locavore salvia bespoke, twee fixie paleo cliche brunch Schlitz blog McSweeney's
                                 messenger bag
                                 swag
                                 slow-carb. Odd Future photo booth pork belly, you probably haven't heard of them
                                 actually tofu
                                 ennui
                                 keffiyeh lo-fi Truffaut health goth. Narwhal sustainable retro disrupt.</p>

                             <p>Skateboard artisan letterpress before they sold out High Life messenger bag. Bitters
                                 chambray
                                 leggings listicle, drinking vinegar chillwave synth. Fanny pack hoodie American Apparel
                                 twee.
                                 American
                                 Apparel PBR listicle, salvia aesthetic occupy sustainable Neutra kogi. Organic synth
                                 Tumblr
                                 viral
                                 plaid, shabby chic single-origin coffee Etsy 3 wolf moon slow-carb Schlitz roof party
                                 tousled
                                 squid
                                 vinyl. Readymade next level literally trust fund. Distillery master cleanse migas, Vice
                                 sriracha
                                 flannel chambray chia cronut.</p>

                             <p>Thanks,<br>Jane</p>
                         </div>
                         <!-- /.mailbox-read-message -->
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                         <ul class="mailbox-attachments clearfix list-inline">
                            <?php 
                                 $file = $row['uploadfilecv']."=".$row['uploadfilecertificates'];
                                 $expode = explode("=",$file);
                                 $fileActualExt= array();
                                 for ($i=0; $i < count($expode); ++$i) { 
                                     $fileActualExt[]= strtolower(substr($expode[$i],-3));
                                    }
                                 $fileActualExt[]= 'docx';
                                 $fileActualExt[]= 'xlsx';
                                 $allower_ext = array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip'); // valid extensions
                                
                 if (array_diff($fileActualExt,$allower_ext) == false) {

                     for ($i=0; $i < count($expode); ++$i) { ?>

                     <li  class="list-inline-item">

                       <?php if(pathinfo($expode[$i])['extension'] == 'docx'|| pathinfo($expode[$i])['extension'] == 'xls'||
                                pathinfo($expode[$i])['extension'] == 'doc'|| pathinfo($expode[$i])['extension'] == 'xlsx') { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                  <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>||Sep2014-report.pdf</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>


                    <?php }else if(pathinfo($expode[$i])['extension'] == 'pdf' ) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                         <?php  echo pathinfo($expode[$i])['basename'] ;?> || Sep2014-report.pdf</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                     <?php }else if(pathinfo($expode[$i])['extension'] == 'jpg' || pathinfo($expode[$i])['extension'] == 'jpeg'|| pathinfo($expode[$i])['extension'] == 'png') { ?>

                                  <span class="mailbox-attachment-icon has-img"><img 
                                    src="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>|| Sep2014-report.pdf</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                     <?php } ?>
                          </li>

                    <?php } } ?>
                         
                         </ul>
                     </div>
                 </div>
              </form>
            </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- inbox-popup" -->

<?php } 

if (isset($_POST['delete'])) {

    if ($_POST['delete'] == 'delete') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id = $_POST[ $id];
        $id = $_POST['trashid'];
        // var_dump($_POST);
        // var_dump($id);
        // var_dump(array_keys($_POST)[1]);

	$job->TrashDelete('trash',$id,$datetime);

  }
}

if (isset($_POST['deleteCheck'])) {

    if ($_POST['deleteCheck'] == 'deleteCheck') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }
        
        // $id = $_POST[ $id];
        // var_dump($_POST);
        // var_dump($id);

	$job->TrashAllDelete('apply_job',$id,$datetime);

  }
}

if (isset($_POST['deleteChecksent'])) {

    if ($_POST['deleteChecksent'] == 'deleteChecksent') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }
        
        $job->TrashAllDelete('apply_job',$id,$datetime);
        // $id = $_POST[ $id];
        var_dump($_POST);
        // var_dump($id);

  }
}

if (isset($_POST['deleteCheck_Trash'])) {

    if ($_POST['deleteCheck_Trash'] == 'deleteCheck_Trash') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }
        
        // $id = $_POST[ $id];
        var_dump($_POST);
        // var_dump($id);

	$job->TrashAllDelete('trash',$id,$datetime);

  }
}

?>