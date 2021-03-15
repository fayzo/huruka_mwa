      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_car" data-car="<?php echo $_SESSION['key']; ?>" > + Add car </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Car</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           <!-- <form class="form-inline">
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="searches" id="searches" aria-describedby="helpId"
                        placeholder="Search">
                </div>
              </form> -->
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
                        <h4>Search &amp; Find Car</h4>
                    </div>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 " id="car-hides">
            <?php echo $car->carList('car_For_sale',1,$user_id); ?>
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
  