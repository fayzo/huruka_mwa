      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_icyamunara" data-icyamunara="<?php echo $_SESSION['key']; ?>" > + Add Icyamunara </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Icyamunara</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

<div class="container-fluid">

     <div class="row mt-4">
         <div class="col-md-3 d-none d-md-block">
             <div class="card">
                <div class="card-header">
                   <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                        <h4>Search &amp; Find Goods</h4>
                    </div>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 " id="house-hides">
            <?php echo $icyamunara->icyamunaraList(1,$user_id); ?>
         </div> <!-- col -->

         <div class="col-md-3 d-none d-md-block">

           <div class="card">
                <div class="card-header">
                    <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-3.png" alt="">
                        <h4>Talk To Dealer</h4>
                    </div>
                </div>
            </div> <!-- card -->
             
         </div> <!-- col -->
         
     </div>
</div>
  