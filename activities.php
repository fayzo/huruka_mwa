<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<?php include "header_navbar_footer/header.php"?>

    <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
           <!-- < ?php if (isset($_SESSION['job_user'])) { ?>
            <button type="button" class="btn btn-light" id="addPostsjobs" > + Add jobs </button>
           < ?php } ?> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Activities</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
    </header>

<div class="container-fluid mb-3">
   <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h5><i>Your Activities</i></h5>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Activities </li>
                    <li class="breadcrumb-item active"><i>Posts</i></li>
                </ol>
            </div>
        </div>
    </section>
    
    <div class="row mt-4">
         <div class="col-md-3 d-none d-md-block">
             <div class="card">
                <div class="card-header">
                   <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                        <h4>Search <br> Edit & Delete</h4>
                    </div>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 ">

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link  active" href="#jobs"
                                data-toggle="tab">Jobs</a> </li>
                            <li class="nav-item"><a class="nav-link" href="#fundraisings"
                                data-toggle="tab">Fundraisings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#Crowfundraising"
                                data-toggle="tab">Crowfundraising</a></li>
                            <li class="nav-item"><a class="nav-link" href="#House"
                                data-toggle="tab">House</a></li>
                            <li class="nav-item"><a class="nav-link" href="#car"
                                data-toggle="tab">Car</a></li>
                            <li class="nav-item"><a class="nav-link" href="#icyamunara"
                                data-toggle="tab">icyamunara</a></li>
                            <li class="nav-item"><a class="nav-link" href="#sale"
                                data-toggle="tab">Sale</a></li>
                        </ul>
                </div>
                <div class="card-body">
                <div class="tab-content">
                        <div class="tab-pane active " id="jobs">
                            <?php echo $job->jobsactivities($_SESSION['key']); ?>
                        </div> 
                        <div class="tab-pane" id="fundraisings">
                            <?php echo $fundraising->fundraisingsActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="Crowfundraising">
                        <!-- < ?php echo $home->eventsListActivities($_SESSION['key']); ?> -->
                        <?php echo $crowfund->crowfundraisingsActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="House">
                            <!-- < ?php echo $home->blogsActivities($_SESSION['key']); ?> -->
                            <?php echo $car->houseListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="car">
                        <?php echo $car->carListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="icyamunara">
                        <?php echo $car->icyamunaraListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="sale">
                            <?php echo $sale->saleActivities($_SESSION['key']); ?>
                        </div>
                    </div> <!-- /.tab-content -->
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>

            </div> <!-- col -->

            <div class="col-md-3 d-none d-md-block">

                <div class="card">
                    <div class="card-header">
                        <div class="single-howit-works">
                            <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                            <h4>Search <br> Edit & Delete</h4>
                        </div>
                    </div>
                </div> <!-- card -->
                    
            </div> <!-- col -->

        </div>

</div>

<?php include "header_navbar_footer/footer.php"?>