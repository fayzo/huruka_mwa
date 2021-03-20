<!-- Content Wrapper. Contains page content -->
<div class="container mb-5 mt-3">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i>Profile</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item active"><i> <?php echo $follow->followBtn($user['user_id'],$user_id,$user['user_id']) ;?></i></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 mb-3">
                      <!-- hastTag Me Box -->
                       <div class="sticky-top " style="top: 52px;">
                        <div class="card card-primary mb-3">
                            <div class="card-header main-active p-1">
                                <h5 class="card-title text-center"><i> About Me</i></h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-user mr-1"></i>Company || education</strong>

                                <p class="text-muted">
                                    <?php echo $user['company_education']; ?>
                                </p>

                                <strong><i class="fa fa-user mr-1"></i> type of business</strong>

                                <p class="text-muted">
                                    <?php echo $user['type_of_business']; ?>
                                </p>

                                <strong><i class="fa fa-user mr-1"></i>  Address</strong>

                                <p class="text-muted"> <?php echo $user['address']; ?></p>

                                <strong><i class="fa fa-map-marker mr-1"></i>Location</strong>

                                <p class="text-muted"> <?php echo $user['location']; ?></p>

                                <strong><i class="fa fa-user mr-1"></i> Size of people</strong>

                                <p class="text-muted"> <?php echo $user['size_of_people']; ?></p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                       <?php echo $trending->trends(); ?>
                        </div>
            </div> <!-- /.col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header borders-tops p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">About Me</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- /.post -->
                                <?php echo $Home_GetUsers->getUserTweet($user['user_id'],$user_id) ;?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                              <span id="responsesCOMP"></span>
                                <form class="form-horizontal" >
                                    <input type="hidden" class="form-control" value="<?php echo $user['user_id'];?>" id="company_id" style="display:none">
                                    <div class="form-group">
                                      <label class="control-label" for="">Company || education</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" id="company_education" name="Company_education" >
                                               <?php if(!empty($user['company_education'])){?>
                                                <option > <?php echo $user['company_education'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="company">Company</option>
                                           <option value="Public">Public</option>
                                           <option value="Private">Private</option>
                                           <option value="education">Education</option>
                                         </select>
                                      </div>
                                    </div>

                                     <div class="form-group">
                                      <label class="control-label" for="">type of business</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" name="type_of_business" id="type_of_business">
                                             <?php if(!empty($user['type_of_business'])){?>
                                                <option > <?php echo $user['type_of_business'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="architecture">architecture</option>
                                           <option value="electrical">engineer</option>
                                           <option value="sale">sale</option>
                                           <option value="Buyer">Buyer</option>
                                           <option value="builder">builder</option>
                                           <option value="cleaners">cleaners</option>
                                           <option value="Commission">Commission</option>
                                           <option value="Hotel">Hotel</option>
                                         </select>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputName" class="control-label">Address</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" placeholder="Address" value="<?php echo $user['address'] ;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label">Location</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="location" placeholder="Location" value="<?php echo $user['location']; ?>">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                      <label class="control-label" for="">Size of people</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" name="size_of_people" id="size_of_people">
                                             <?php if(!empty($user['size_of_people'])){?>
                                                <option > <?php echo $user['size_of_people'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="5">5</option>
                                           <option value="10">10</option>
                                           <option value="20">20</option>
                                           <option value="50">50</option>
                                           <option value="100">100</option>
                                           <option value="150">150</option>
                                           <option value="200">200</option>
                                           <option value="250">250</option>
                                           <option value="300">300</option>
                                           <option value="350">350</option>
                                           <option value="500">500</option>
                                           <option value="800">800</option>
                                           <option value="1000">1000</option>
                                         </select>
                                      </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" onclick="company('organization');" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
            
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <!-- whoTofollow: user whoTofollow style 1 -->
                        <?php $follow->whoTofollow($user['user_id'],$user['user_id'])?>
                    </div>
                    <!-- /. col -->

                </div>
                <!-- /.row -->
                 <div class="sticky-top " style="top: 52px;">
                        <!-- hastTag Me Box -->
                         <!-- jobs -->
                         <?php echo $home->jobsfetch() ;?>
                         <!-- jobs -->
                </div>
            </div>
            <!-- /.col-md-3 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- container -->

          