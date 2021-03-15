<div class="card mt-3 col-sm-12 col-md-8 offset-md-2">
    <div class="card-header text-center px-0">
        <!-- MODAL TRIGGER -->
        <!-- <input style="float: right" type="button" class="btn btn-success "  data-toggle="modal" data-target="#editPages"  value="Edit Profile"> -->
        <input style="float: right" type="button" class="btn btn-sm btn-success" onclick="BusinessEdits(<?php echo $_SESSION['key'];?>, 'businessviewORedit');"  value="Edit Profile">
        <input style="float: left" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#examplePages" value="Example Page">
        <h5 style="clear: left" ><i>Business Description</i></h5> 
    </div>
  <div class="card-body px-0">
  <?php if(!empty($user['overview'])) { ?>
    <p id="business_id0" data-business="<?php echo $_SESSION['key'];?>"></p>
    <div class="text-center">
    <h6 class="card-title  font-weight-bold The-company-name0">The Logo company </h6>
           <?php if (!empty($user['profile_img'])) {?>
              <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>"  width="40px" height="40px" alt="logo" >
              <?php  }else{ ?>
                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  width="40px" height="40px" alt="logo" >
              <?php } ?>
    </div>
    <hr>

    <h6 class="card-title font-weight-bold">Company overview: </h6>
    <div class="The-company-overview0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">Company history: </h6>
    <div class="company-history0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">Management team: </h6>
      <div class="management-team0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">Legal structure and ownership: </h6>
    <div class="legal-structure0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">Locations and facilities: </h6>
    <div class="location-place0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">Mission statement: </h6>
    <div class="mission-statement0"></div>
    <hr>

    <h6 class="card-title font-weight-bold">website: </h6>
    <div class="website0"></div>
    <hr>
<?php }else{ ?>

<div class="text-center font-weight-bold">
    <h6 class="card-title">The Logo company </h6>
          <label for="">Examples of Logo represent the company</label>
          <ul class="list-inline" style="list-style-type:none">
             <li class="list-inline-item" ><img src="<?php echo BASE_URL_LINK.'image/flag/iconfinder_Flag_of_Burundi_96181.png' ;?>" width="40px" height="40px" alt="logo" ></li>
             <li class="list-inline-item" ><img src="<?php echo BASE_URL_LINK.'image/flag/iconfinder_Flag_of_Burundi_96181.png' ;?>" width="40px" height="40px" alt="logo" ></li>
             <li class="list-inline-item" ><img src="<?php echo BASE_URL_LINK.'image/flag/iconfinder_Flag_of_Burundi_96181.png' ;?>" width="40px" height="40px" alt="logo" ></li>
             <li class="list-inline-item" ><img src="<?php echo BASE_URL_LINK.'image/flag/iconfinder_Flag_of_Burundi_96181.png' ;?>" width="40px" height="40px" alt="logo" ></li>
             <li class="list-inline-item" ><img src="<?php echo BASE_URL_LINK.'image/flag/iconfinder_Flag_of_Burundi_96181.png' ;?>" width="40px" height="40px" alt="logo" ></li>
          </ul>
    </div>
    <hr>

    <h6 class="card-title font-weight-bold">Company overview: </h6>
      <label for="">Examples of where you’ll briefly sum everything up. </label>
          <ul style="list-style-type:none">
             <li>This is where you’ll briefly sum everything up. </li>
          </ul>
    <hr>

      <h6 class="card-title font-weight-bold">Company history: </h6>
      <label for="">Examples of Company history. </label>
          <ul style="list-style-type:dot">
             <li>Provide the back story, including date of founding, and who was involved. </li>
          </ul>
    <hr>

      <h6 class="card-title font-weight-bold">Management team: </h6>
      <label for="">Examples of Details about who runs the company, and other key roles. </label>
          <ul style="list-style-type:dot">
             <li>Details about who runs the company, and other key roles.</li>
          </ul>
    <hr>

      <h6 class="card-title font-weight-bold">Legal structure and ownership: </h6>
      <label for="">Examples of Legal structure and ownership. </label>
          <ul style="list-style-type:dot">
             <li>How you’ve decided to structure your company, and who owns what percentage of it.</li>
          </ul>
    <hr>

      <h6 class="card-title font-weight-bold">Locations and facilities: </h6>
      <label for="">Examples of Details on your workspaces or plans to acquire them. </label>
          <ul style="list-style-type:dot">
             <li>Kigali, Rwanda.</li>
             <li>KG 666 St street.</li>
             <li>PO BOX 242 KIGALI.</li>
          </ul>
    <hr>

      <h6 class="card-title font-weight-bold">Mission statement: </h6>
      <label for="">Examples of Mission statement </label>
          <ul style="list-style-type:dot">
             <li>A concise statement of the guiding principles of your company.</li>
          </ul>
    <hr>
<?php } ?>

  </div>
</div>


    <!-- MODAL -->
    <div class="modal" id="editPages">
      <div style="max-width: 800px;margin: 1.75rem auto;position: relative;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Business Description</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <span id="responseBusiness"></span>
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
                
            <?php if(!empty($user['overview'])) { ?>

              <form method="post">
                <input type="hidden" id="id_business" value="0">
                <div class="form-group">
                  <h4><i> The company name:</h4></i> 
                  <textarea class="form-control" id="The-company-name" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder=" The company name. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> The company overview:</h4></i> 
                  <textarea class="form-control "  id="The-company-overview" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder=" This is where you’ll briefly sum everything up. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Company history:</h4></i> 
                  <textarea class="form-control"  id="company-history" rows="4" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder=" Provide the back story, including date of founding, and who was involved. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Management team:</h4></i> 
                  <textarea class="form-control"  id="management-team" style=" font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  rows="4" placeholder="Details about who runs the company, and other key roles. " ></textarea>
                </div>
                <hr>
        
                <div class="form-group">
                  <h4><i> Legal structure and ownership:</h4></i> 
                  <textarea class="form-control"  id="legal-structure" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="How you’ve decided to structure your company, and who owns what percentage of it. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i> Location and facilities:</h4></i> 
                  <textarea class="form-control" id="location-place" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="Details on your workspaces or plans to acquire them. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i>Mission statement:</h4></i>
                  <textarea class="form-control" id="mission-statement" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder="A concise statement of the guiding principles of your company. " ></textarea>
                </div>
                <hr>

                <div class="form-group">
                  <h4><i>Website If you've :</h4></i>
                  <input type="text" class="form-control" id="website" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="https://www.mywebsie.com"
                  value="https://www.mywebsie.com" >
                </div>
                <hr>
              </form>

              <?php }else{ ?>

              <form method="post">
                <input type="hidden" id="id_business" value="0">
                <div class="form-group">
                  <h4><i> The company name:</h4></i> 
                  <textarea class="form-control textarea" id="The-company-name" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="4" placeholder=" The company name. " ></textarea>
                </div>
                <hr>

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

             <?php } ?>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="pull-right btn btn-primary" onclick="ajax_requestsBusiness('update_Row');" id="Businesspages">Submit
                <i class="fa fa-arrow-circle-right"></i></button>
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

