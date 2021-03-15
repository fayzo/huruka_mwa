    <!-- MODAL -->
    <div class="modal" id="editPages">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Business Description</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
             <h4><i> The Logo company: </i></H4>
                <div class="card-widget widget-user">
                  <div class="img-relatives">
                    <div class="profile-upload">
                        <!-- Hidden upload form -->
                        <form method="post" action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/profileEdit.php"
                            enctype="multipart/form-data" id="picUploadFormLogo" target="uploadTarget">

                            <input type="hidden" name="edit_profileLogo" id="edit_profileLogo"
                                value="<?php echo $_SESSION['key'];?>" style="display:none" />
                            <input type="file" name="pictureLogo" id="fileInputLogo" style="display:none" />
                        </form>

                        <iframe id="uploadTarget" name="uploadTarget" src="#"
                            style="width:0;height:0;border:0px solid black;"></iframe>
                        <!-- Profile image -->
                        <div class="text-center img-placeholder">
                            <h4>Update image</h4>
                        </div>
                        <!-- Image update link -->
                        <a href="javascript:void(0);" class="img-upload-iconLinks" id="edit_linkUploadLogo">
                            <i class="fa fa-camera" aria-hidden="true"></i> </a>
                             <?php if (!empty($user['profile_img'] )) {?>
                                    <img class="rounded-circle" id="imagePreviewLogo" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>">
                             <?php  }else{ ?>
                                    <img class="rounded-circle" id="imagePreviewLogo" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>">
                             <?php } ?>
                        <!-- <img class="rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/img/user3-128x128.jpg"
                            alt="User Avatar"> -->
                    </div>
                  </div>
                </div>
                <!-- END OF PROFILE EDIT IMAGE CONTENT -->
                <hr>
             <form method="post">

                <div class="form-group">
                  <h4><i> The company overview:</h4></i> 
                  <textarea class="form-control textarea"  id="The-company-overview" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder=" This is where you’ll briefly sum everything up. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Company history:</h4></i> 
                  <textarea class="form-control textarea"  id="company-history" rows="4" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder=" Provide the back story, including date of founding, and who was involved. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Management team:</h4></i> 
                  <textarea class="form-control textarea"  id="management-team" style=" font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  rows="4" placeholder="Details about who runs the company, and other key roles. " ></textarea>
                </div>
                <hr>
        
                <div class="form-group">
                  <h4><i> Legal structure and ownership:</h4></i> 
                  <textarea class="form-control textarea"  id="legal-structure" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="How you’ve decided to structure your company, and who owns what percentage of it. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Location and facilities:</h4></i> 
                  <textarea class="form-control textarea" id="location-place" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="Details on your workspaces or plans to acquire them. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i>Mission statement:</h4></i>
                  <textarea class="form-control textarea" id="mission-statement" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="A concise statement of the guiding principles of your company. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i>Website If you've :</h4></i>
                  <input type="text" class="form-control" id="website" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="https://www.mywebsie.com"
                  value="https://www.mywebsie.com" >
                </div>
                <hr>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="pull-right btn btn-primary" id="Businesspages">Submit
                <i class="fa fa-arrow-circle-right"></i></button>
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

