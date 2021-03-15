           <!-- ***************** FORM OF CRUD ******************************* -->
      <!-- <div class="well" style="margin:auto; padding:auto; width:100%;"> -->
        <div class="row mt-2 mb-4">
            <div class="col-12">
             <div class="text-center">
                <span class="h4">An Un-Approval Users : <span class="bg-success rounded text-white">Off</span></span>
                <!-- <input style="float: right" type="button" class="btn btn-success" id="admin" value="Add admin"> -->
              </div>
                <table class="table table-striped  table-hover  table-responsive-sm table_admin1" > <!-- table-bordered -->
                    <thead class="main-active">
                        <tr>
                            <td>ID</td>
                            <td>firstname</td>
                            <td>lastname</td>
                            <td>username</td>
                            <td>password</td>
                            <td>email</td>
                            <!-- <td>address</td>
                            <td>address2</td> -->
                            <td>country</td>
                            <!-- <td>state</td> -->
                            <td>Options</td>
                        </tr>
                    </thead>
                    <tbody id="tbody_admin1" >

                    </tbody>
                </table>

          </div>
       <!-- </div> -->
    </div> <!-- END-OF FORM OF CRUD  -->



    <div class="well" style="margin:auto; padding:auto; width:80%;">
     <form class="needs-validation" novalidate>
        <div id="manage_admin_form" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">FORM OF ADMIN address</h2>
                    </div>
                    <div class="modal-body">
                     <div id="editContent_admin">
                      <form method="post" enctype="multipart/form-data" id="users_form">
                         <div class="form-group">
                            <input type="hidden" id="admin_editRowID" value="0">
                            <label for="firstName">firstName</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="firstName" required>
                            <div class="invalid-feedback">
                              Valid firstName is required.
                            </div>

                            <label for="lastName">lastName</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="lastName" required>
                            <div class="invalid-feedback">
                              Valid lastName is required.
                            </div>
            
                            <label for="Username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                            <div class="invalid-feedback">
                              Valid Username is required.
                            </div>

                            <label for="password">Password</label>
                            <input type="text" name="Password" class="form-control" id="password" placeholder="Password" required>
                            <div class="invalid-feedback" style="width: 100%;">
                              Your Password is required.
                            </div>
            
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">@</span>
                               </div>
                               <input type="email" class="form-control" id="emailz" placeholder="you@example.com" required>
                               <div class="invalid-feedback">
                                  Please enter a valid email address for shipping updates.
                               </div>
                            </div>
            
                          <!-- <label for="address">Address</label>
                          <input type="type" class="form-control" id="addressz" placeholder="address" required>
                          <div class="invalid-feedback">
                            Please enter your shipping address.
                          </div>
            
                          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
             -->
                             <label for="country">Country</label>
                              <div id="myDiv">
                              </div>
                             <div class="invalid-feedback">
                               Please select a valid country.
                             </div>
            
                              <label for="state">State</label>
                              <select class="custom-select d-block w-100" id="statez" required>
                                <option value="">Choose...</option>
                                <option>Kigali</option>
                                <option>Bujumbura</option>
                                <option>DAR Salam</option>
                              </select>
                              <div class="invalid-feedback">
                                Please provide a valid state.
                              </div>       
                          </div> 
                          <div class="form-group image">
                            <label for="">Upload Picture</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                          </div>      
                          <input type="submit" value="submit" class="btn btn-success user_form">
                        </form>
                        </div> <!-- THIS IS EDIT-CONTENT -->

                        <!-- START OF UPLOAD IMAGE CONTENT -->
                      <div id="profile_image_ADMIN">
                          <div class="container">

                              <div class="user-box">
                                  <div class="img-relative">
                                      <!-- Loading image -->
                                      <div class="overlay uploadProcess" style="display: none;">
                                          <div class="overlay-content"><img src="<?php echo BASE_URL_LINK ;?>image/image_default/load.jpg" /></div>
                                      </div>
                                      <!-- Hidden upload form -->
                                      <form method="post" action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/profileEdit.php"  enctype="multipart/form-data"
                                          id="picUploadForm" target="uploadTarget">
                                          
                                          <input type="hidden" name="edit_profile" id="edit_profile" value="" style="display:none" />
                                          <input type="file" name="picture" id="fileInput" style="display:none" />
                                      </form>
                                      <iframe id="uploadTarget" name="uploadTarget" src="#"
                                          style="width:0;height:0;border:0px solid black;"></iframe>
                                      <!-- Image update link -->
                                      <!-- <p class="editLink" `><img src="images/upload_image.png" width="80px" /></p> -->
                                      <a href="javascript:void(0);" class="editLink" id="edit_linkUploadS">
                                      <img src="<?php echo BASE_URL_LINK ;?>image/image_default/upload_image.png" width="80px" /></a>
                                      <!-- Profile image -->
                                      <img id="imagePreview" class="imagePreview" width="180px">
                                  </div>
                                  <div class="name">
                                      <h4>Profile_img :</h4>
                                      <div  id="nameView4"></div> 
                                  </div>
                              </div>

                              <div class="user-box">
                                  <div class="img-relative">
                                      <!-- Loading image -->
                                      <div class="overlay cover_uploadProcess" style="display: none;">
                                          <div class="overlay-content"><img src="<?php echo BASE_URL_LINK ;?>image/image_default/load.jpg" /></div>
                                      </div>
                                      <!-- Hidden upload form -->
                                      <form method="post" action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/profileEdit.php"  enctype="multipart/form-data"
                                          id="cover_picUploadForm" target="cover_uploadTarget">
                                          
                                          <input type="hidden" name="edit_cover" id="edit_cover" value="" style="display:none" />
                                          <input type="file" name="cover_picture" id="cover_fileInput" style="display:none" />
                                      </form>
                                      <iframe id="cover_uploadTarget" name="cover_uploadTarget" src="#"
                                          style="width:0;height:0;border:0px solid black;"></iframe>
                                      <!-- Image update link -->
                                      <!-- <p class="editLink" `><img src="images/upload_image.png" width="80px" /></p> -->
                                      <a href="javascript:void(0);" class="editLinks" id="edit_linkUpload">
                                      <img src="<?php echo BASE_URL_LINK ;?>image/image_default/upload_image.png" width="80px" /></a>
                                      <!-- Profile image -->
                                      <img id="cover_imagePreview" class="cover_imagePreview" width="180px">
                                  </div>
                                  <div class="name">
                                      <h4>Cover_img :</h4>
                                      <div id="cover_nameView4"></div>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <!-- END OF UPLOAD IMAGE CONTENT -->

                        <div id="showContent_admin" style="display:none;">

                            <p><span style="font-weight:bold;font-size:17px;">FirstName : </span>
                            <span id="firstnameView"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">LastName : </span>
                            <span id="lastnameView" ></span> </p>
                            <!-- style="overflow-y: scroll; height: 300px;"> -->
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">UserName : </span>
                            <span id="usernameView"></span></p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Password : </span>
                            <span id="passwordView"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Email : </span>
                            <span id="emailViewz"></span> </p>
                            <hr>
                            <!-- <p><span style="font-weight:bold;font-size:17px;">Address : </span>
                            <span id="addressViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Address 2 :</span>
                            <span id="address2View"></span> </p> -->
                            <!-- <hr> -->
                            <p><span style="font-weight:bold;font-size:17px;">country : </span>
                            <span id="countryViewz"></span> </p>
                            <hr>
                            <!-- <p><span style="font-weight:bold;font-size:17px;">state : </span>
                            <span id="stateViewz"></span> </p> -->
                            <!-- <hr> -->
                        </div>
                     </div> <!-- THIS IS MODAL BODY -->

                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" id="closeBtn1" >
                        <input type="button" id="button_admin" onclick="ajax_requests('add_admin');" value="Save" class="btn btn-success">
                    </div>

                </div>
            </div>
        </div>
    </form>
 </div>