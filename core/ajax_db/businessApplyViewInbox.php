<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
ini_set('display_errors', 1); 
error_reporting(E_ALL);

if (isset($_POST['cv_id'])) {
    $user_id= $_SESSION['key'];
    $cv_id= $_POST['cv_id'];
    $mysqli = $db;
    // $query= $mysqli->query("SELECT * FROM users U Left JOIN apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. cv_id = $cv_id ");
    $query= $mysqli->query("SELECT * FROM email_apply_job A LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. cv_id = $cv_id ");
    $row = $query->fetch_array();
    ?>

<div class="inbox-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap" id="popupEnd">
        	<div class="img-popup-body">

                <div class="card">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                    <span id="responseSubmitdelete"></span>
                     <div class="card-body p-0">
                         <div class="mailbox-read-info">
                             <h5>Message Subject Is Placed Here</h5>
                             <h6>From: <?php echo $row['email_sent_from'] ;?></h6>
                             <h6>To: <?php echo $row['email_sent_to'] ;?>
                                <span class="mailbox-read-time float-right"><?php echo $home->timeAgo($row['created_on0']) ;?></span>
                            </h6>
                             <div>Subject: <?php echo $row['subject_composer'] ;?></div>
                         </div>
                         <!-- /.mailbox-read-info -->
                         <div class="mailbox-controls with-border text-center">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm deleteforminbox" data-delete="delete"  data-cvid="<?php echo $row['cv_id']; ?>" data-id_radom="<?php echo $row['cv_id_radom']; ?>" data-toggle="tooltip"
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
                               <!-- MAIL BOX HERE GOES -->
                             <!-- MAIL BOX HERE GOES -->

                             <?php echo htmlspecialchars_decode($row['addition_information']); ?>

                             <!-- MAIL BOX HERE GOES -->
                             <!-- MAIL BOX HERE GOES -->
                             
                         </div>
                         <!-- /.mailbox-read-message -->

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                         <ul class="mailbox-attachments clearfix list-inline">
                            <?php 
                                if (!empty($row['uploadfilecertificates'])) {
                                    # code...
                                    $file = $row['uploadfilecv']."=".$row['uploadfilecertificates'];
                                    $file_size = $row['cv_file_size']."=".$row['certificates_file_size'];
                                }else{
                                    $file = $row['uploadfilecv'];
                                    $file_size = $row['cv_file_size'];
                                }

                                 $expode = explode("=",$file);
                                 $file_sizes = explode("=",$file_size);

                                 $fileActualExt= array();
                                 for ($i=0; $i < count($expode); ++$i) { 
                                    $fileActualExt[]= strtolower(substr($expode[$i],strrpos($expode[$i],'.')+1));
                                }

                                 $image= array('jpg','jpeg','png','gif');
                                 $pdf= array('pdf');
                                 $coins= array('coins');
                                 $docx= array('doc','docx','lsx');
                                 $mp3= array('mp3','ogg');
                                 $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
                                 $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);
          
                                
                 if (array_diff($fileActualExt,$allower_ext) == false) {

                     for ($i=0; $i < count($expode); ++$i) {  ?>
                     
                     <li  class="list-inline-item">

                     <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                  <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                        <!-- ||Sep2014-report.pdf -->
                                    </a>
                                     <span class="mailbox-attachment-size">
                                         <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                         <!-- 1,245 KB -->
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                    <?php }else if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                         <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                          <!-- || Sep2014-report.pdf -->
                                        </a>
                                     <span class="mailbox-attachment-size">
                                     <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                         <!-- 1,245 KB -->
                                         <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                    <?php }else if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>

                                  <span class="mailbox-attachment-icon has-img"><img 
                                    src="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                    <!-- || Sep2014-report.pdf -->
                                    </a>
                                     <span class="mailbox-attachment-size">
                                        <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                         <!-- 1,245 KB -->
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
        $id[] = $_POST['cvid'];

        $id= array_values(array_filter($id)); // start to 0 index
        // var_dump($_POST);
        // var_dump($id);
        for ($i=0; $i < count($id) ; $i++) { 
            $query= $job->InboxDelete('email_trash',$id[$i],$datetime);
        }

        if($query){
            exit('<div class="alert alert-success alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>SUCCESS</strong> </div>');
        }else{
                    exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                        <button class="close" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>Fail input try again !!!</strong>
                    </div>');
        }

  }
}



// <p>Hello John,</p>

//                              <p>Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave
//                                  put a
//                                  bird
//                                  on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester
//                                  mlkshk.
//                                  Ethical
//                                  master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk
//                                  fanny pack
//                                  gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester
//                                  chillwave 3 wolf
//                                  moon
//                                  asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas
//                                  church-key
//                                  tofu
//                                  blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies
//                                  narwhal
//                                  American
//                                  Apparel.</p>

//                              <p>Raw denim McSweeney's bicycle rights, iPhone trust fund quinoa Neutra VHS kale chips
//                                  vegan
//                                  PBR&amp;B
//                                  literally Thundercats +1. Forage tilde four dollar toast, banjo health goth paleo
//                                  butcher. Four
//                                  dollar
//                                  toast Brooklyn pour-over American Apparel sustainable, lumbersexual listicle
//                                  gluten-free health
//                                  goth
//                                  umami hoodie. Synth Echo Park bicycle rights DIY farm-to-table, retro kogi sriracha
//                                  dreamcatcher PBR&amp;B
//                                  flannel hashtag irony Wes Anderson. Lumbersexual Williamsburg Helvetica next level.
//                                  Cold-pressed
//                                  slow-carb pop-up normcore Thundercats Portland, cardigan literally meditation
//                                  lumbersexual
//                                  crucifix.
//                                  Wayfarers raw denim paleo Bushwick, keytar Helvetica scenester keffiyeh 8-bit irony
//                                  mumblecore
//                                  whatever viral Truffaut.</p>

//                              <p>Post-ironic shabby chic VHS, Marfa keytar flannel lomo try-hard keffiyeh cray. Actually
//                                  fap
//                                  fanny
//                                  pack yr artisan trust fund. High Life dreamcatcher church-key gentrify. Tumblr
//                                  stumptown four
//                                  dollar
//                                  toast vinyl, cold-pressed try-hard blog authentic keffiyeh Helvetica lo-fi tilde
//                                  Intelligentsia. Lomo
//                                  locavore salvia bespoke, twee fixie paleo cliche brunch Schlitz blog McSweeney's
//                                  messenger bag
//                                  swag
//                                  slow-carb. Odd Future photo booth pork belly, you probably haven't heard of them
//                                  actually tofu
//                                  ennui
//                                  keffiyeh lo-fi Truffaut health goth. Narwhal sustainable retro disrupt.</p>

//                              <p>Skateboard artisan letterpress before they sold out High Life messenger bag. Bitters
//                                  chambray
//                                  leggings listicle, drinking vinegar chillwave synth. Fanny pack hoodie American Apparel
//                                  twee.
//                                  American
//                                  Apparel PBR listicle, salvia aesthetic occupy sustainable Neutra kogi. Organic synth
//                                  Tumblr
//                                  viral
//                                  plaid, shabby chic single-origin coffee Etsy 3 wolf moon slow-carb Schlitz roof party
//                                  tousled
//                                  squid
//                                  vinyl. Readymade next level literally trust fund. Distillery master cleanse migas, Vice
//                                  sriracha
//                                  flannel chambray chia cronut.</p>

//                              <p>Thanks,<br>Jane</p>
?>