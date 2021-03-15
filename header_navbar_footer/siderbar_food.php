      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_food" data-food="<?php echo $_SESSION['key']; ?>" > + Add food </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Food Delivery</a>
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
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 " id="food-hides">
            <?php echo $food->foodList('food',1,$user_id); ?>
         </div> <!-- col -->

         <div class="col-md-3 d-none d-md-block">
               <span id="responseSubmitfooditerm"> </span>
                <div id="responseSubmitfooditermview">
                  <?php echo $food->FoodshowCart_itemSale(); ?>
                </div>
             
         </div> <!-- col -->
         
     </div>
</div>
  