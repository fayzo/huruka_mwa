 <!-- Content Wrapper. Contains page content -->
 <div class="mb-2">

     <!-- Main content -->
     <section class="content">
         <div class="row">
             <div class="col-md-3 mb-3" >
               <div class="sticky-top"  style="top: 52px;">
                 <!-- <a href="#compose.php" data-toggle="modal" id="myModalComposermessage" data-target="#myModalComposer" class="btn main-active mb-3" -->
                 <a href="#compose.php" data-toggle="modal" id="myModalComposermessage" class="btn main-active mb-3"
                     style="width:100%"><i class="fa fa-pencil"></i> Compose</a>

                 <div class="card">
                     <div class="card-header main-active folders p-1">
                         <h4 class="card-title text-center"><i>Folders</i></h4>

                         <div class="card-tools">
                             <button type="button" class="btn btn-tool btn-sm" data-target="#collapseExample1"
                                 data-toggle="collapse"><i class="fa fa-minus"></i>
                             </button>
                         </div>
                     </div>

                     <div class="collapse show" id="collapseExample1">
                         <div class="card-body p-0">
                             <div class="list-group " id="list-tab" role="tablist">
                                 <a class="list-group-item list-group-item-action active" id="list-inbox-list"
                                     data-toggle="tab" href="#list-inbox" role="tab" aria-controls="list-inbox"><i
                                         class="fa fa-inbox"></i> Inbox 
                                         <span class="badge badge-primary float-right"><?php echo $job->count_inbox_job($_SESSION['email']); ?></span></a>
                                 <a class="list-group-item list-group-item-action" id="list-Sent-list" data-toggle="tab"
                                     href="#list-Sent" role="tab" aria-controls="list-profile"><i
                                         class="fa fa-envelope-o"></i> Sent
                                         <span class="badge badge-primary float-right"><?php echo $job->count_sent_job($user_id); ?></span></a>
                                         </a>
                                 <a class="list-group-item list-group-item-action" id="list-Trash-list"
                                     data-toggle="tab" href="#list-Trash" role="tab" aria-controls="list-profile"> <i
                                         class="fa fa-trash-o"></i> Trash
                                         <span class="badge badge-primary float-right"><?php echo $job->count_trash_job($_SESSION['email']); ?></span></a>
                                         </a>
                             </div>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- end of collapse -->
                 </div>
                 <!-- /.card -->

              </div>
             <!-- /. sticky -->
             </div>
             <!-- /. col -->
             <div class="col-md-9">
             <!-- <script src="< ?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script> -->

                 <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="list-inbox" role="tabpanel"
                         aria-labelledby="list-home-list">
                         <?php include "message/inbox.php"?>
                     </div> <!-- END-OF A LINK OF inbox ID=#  -->
                     <div class="tab-pane fade " id="list-Sent" role="tabpanel" aria-labelledby="list-Sent-list">
                         <?php include "message/sent.php"?>
                     </div> <!-- END-OF A LINK OF sent ID=#  -->
                     <!-- <div class="tab-pane fade" id="list-Drafts" role="tabpanel" aria-labelledby="list-Drafts-list">
                         < ?php include "message/drafts.php"?>
                     </div>  -->
                     <!-- END-OF A LINK OF Drafts ID=#  -->
                     <div class="tab-pane fade" id="list-Trash" role="tabpanel" aria-labelledby="list-Trash-list">
                         <?php include "message/trash.php"?>
                     </div> <!-- END-OF A LINK OF folder ID=#  -->
                 </div>
             </div>
             <!-- /.col -->
         </div>
         <!-- /.row -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

<!-- COMPOSE EMAIL TO WRITE AND SENDING -->
 <div class="modal" id="myModalComposer">
     <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
         <div class="modal-content">
             <form method="post" id="email-composer-new" enctype="multipart/form-data" >
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id ;?>">

             <div class="modal-header">
                 <h5 class="modal-title"><i class="fa fa-pencil"></i> Compose New Message</h5>
                 <button class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
             
                 <div class="form-group">
                     <input class="form-control emailcomposer search-email-composer" name="emailcomposer" placeholder="To:">
                      <div class="search-result">			
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

                 <div class="form-group emailsendto" id="myDiv-search-email-composer">
                 </div>
                 <div class="form-group">
                     <input class="form-control subjectcomposer" name="subjectcomposer" placeholder="Subject:">
                 </div>
                 <div class="form-group">
                     <textarea id="editor2" name="textcomposer" class="form-control textcomposer" style="height: 300px"></textarea>
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
             <div class="modal-footer">
                <div id="responseSubmit"></div>
                 <div class="float-right">
                     <!-- <button type="button" class="btn btn-default email-composer-daft1" name="draft" value="draft"><i class="fa fa-pencil"></i> Draft</button> -->
                     <button type="button" class="btn btn-primary email-composer-new1" name="send" id="sendx" value="send"><i class="fa fa-envelope-o"></i> Send</button>
                 </div>
                 <!-- <button type="reset" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                     Discard</button> -->
                 <button class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </form>
         </div>
     </div>
 </div>
 <br>
 
                     <!-- <h1><u>Heading Of Message</u></h1>
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
                      <p>John Doe</p> -->

 <!-- READ FILE MESSAGE -->
 <div class="modal" id="myModalReady">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-titles">Read Mail </h5>
                 <div class="card-tools">
                     <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i
                             class="fa fa-chevron-left"></i></a>
                     <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i
                             class="fa fa-chevron-right"></i></a>
                 </div>
                 <button class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <div class="card">
                     <div class="card-body p-0">
                         <div class="mailbox-read-info">
                             <h5>Message Subject Is Placed Here</h5>
                             <h6>From: support@adminlte.io
                                 <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span></h6>
                         </div>
                         <!-- /.mailbox-read-info -->
                         <div class="mailbox-controls with-border text-center">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                     data-container="body" onclick="deleteInbox()" title="Delete">
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
                     <div class="card-footer bg-white">
                         <ul class="mailbox-attachments clearfix">
                             <li>
                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                 <div class="mailbox-attachment-info">
                                     <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                         Sep2014-report.pdf</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                             </li>
                             <li>
                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                                 <div class="mailbox-attachment-info">
                                     <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App
                                         Description.docx</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                             </li>
                             <li>
                                 <span class="mailbox-attachment-icon has-img"><img
                                         src="" alt="Attachment"></span>

                                 <div class="mailbox-attachment-info">
                                     <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>
                                         photo1.png</a>
                                     <span class="mailbox-attachment-size">
                                         2.67 MB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                             </li>
                             <li>
                                 <span class="mailbox-attachment-icon has-img"><img
                                         src="" alt="Attachment"></span>

                                 <div class="mailbox-attachment-info">
                                     <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>
                                         photo2.png</a>
                                     <span class="mailbox-attachment-size">
                                         1.9 MB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <div class="float-right">
                     <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                     <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                 </div>
                 <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                 <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                 <button class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>