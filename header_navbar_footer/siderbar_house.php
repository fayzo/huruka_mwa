      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_house" data-house="<?php echo $_SESSION['key']; ?>" > + Add house </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">House</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

<div class="container-fluid ">

     <div class="row mt-4">
         <div class="col-md-3 d-none d-md-block">
             <div class="card">
                <div class="card-header">
                    <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-2.png" alt="">
                        <h4>Search &amp; Find House</h4>
                    </div>
                </div>
                <!-- <div class="card-body">
                    <div class="single-howit-works">
                        <img src="< ?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                        <h4>Find Your Property</h4>
                    </div>
                </div> -->
            </div> <!-- card -->

            <div class="card">
                <div class="card-header">
                    <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-3.png" alt="">
                        <h4>Talk To Agent</h4>
                    </div>
                </div>
                <!-- <div class="card-body">
                    <div class="section-title">
                        <span>Find Your Dream House</span>
                    </div>
                </div> -->
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 " id="house-hides">
            <?php echo $house->houseList('House_For_sale',1,$user_id); ?>
         </div> <!-- col -->

         <div class="col-md-3 d-none d-md-block">
            <?php echo $house->Property_City_search($user_id);?>
            <!-- card -->
         </div> <!-- col -->
         
     </div>
</div>
  