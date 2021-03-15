        <header class="blog-header py-2 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_school" data-school="<?php echo $_SESSION['key']; ?>" > + Add school </button>
           <?php } ?>
          </div>
          <div class="col-4  pt-1 text-center">
            <a class="blog-header-logo text-dark" href="#">School & University</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
          <span id="clock"></span>
          </div>
        </div>
      </header>

<div class="container-fluid pt-3 ">

    <div class="row">
      <div class="col-md-3 d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                        <h4>Search &amp; Find School</h4>
                    </div>
                </div>
            </div> <!-- card -->
      </div>

      <div class="col-md-6" id="jobs-hides">
            <!-- < ?php echo $school->schoolList(1,1); ?> -->
            <!-- < ?php echo $school->schoolList0(1,'kindergarden School'); ?> -->
            <?php echo $school->schoolList0(1,'Featured'); ?>
      </div>

      <div class="col-md-3 d-none d-md-block" >
        <span id="responseSubmititerm"> </span>
        <div id="responseSubmitcartiterm">
          <div class="card">
                <div class="card-header">
                <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-2.png" alt="">
                        <h4>Search &amp; Find School</h4>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
      </div><!-- col -->

    </div><!-- row -->
</div><!-- container-fluid -->
