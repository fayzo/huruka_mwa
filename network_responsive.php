
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title>Network</title>
<?php include "header_navbar_footer/header.php"?>


            <!-- Main content -->
            <section class="content-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Network</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                            <?php if (isset($_SESSION['key'])){ ?>
                            <?php if ($user['user_id'] != $_SESSION['key']) { ?>
                            <li class="breadcrumb-item"><span class="people-message more" data-user="<?php echo $user['user_id'];?>"><a href="javascript:void(0);" ><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </a></span></li>
                            <?php } } ?>
                        </ol>
                   </div>
                </div>
            </section>

    
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    
                    <div class="col-md-12">

                        <div class="card mb-2">
                            <div class="card-header">
                                <h5>More suggestions for you</h5>
                                <hr>
                                    <ul class="nav nav-pills float-left">
                                        <li class="nav-item"><a class="nav-link  active" href="#people"
                                            data-toggle="tab">people</a> </li>
                                    </ul>
                                    <form action="#" method="get" class="sidebar-form float-right" style="margin-top: 5px;">
                                        <div class="input-group input-group-sm">
                                        <input type="text" name="search" id="search" class="form-control  search formnnavbar" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button type="button" name="search" class="btn btn-flat formnnavbar">
                                            <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                        </div>
                                        <div class="search-result"></div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-12 -->
                    <div class="col-md-12" id="Follow-view-responsive">
                        <?php $follow->Network_FollowingLists_Responsive(10,$user_id,$user['user_id']); ?>
                        
                        <div class="loading-div text-center mt-2">
                            <img id="loader" src="<?php echo BASE_URL_LINK."image/img/"?>loading.svg" style="display: none;"/> 
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
           
           
 <?php include "header_navbar_footer/footer.php"?>
