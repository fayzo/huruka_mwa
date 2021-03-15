        <header class="blog-header py-2 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
            <button type="button" class="btn btn-light" id="add_sale" data-sale="<?php echo $_SESSION['key']; ?>" > + Add sale </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Shopping Items</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

<div class="container-fluid">

    <div class="row mt-3">
      <div class="col-4 col-md-2 col-lg-2 d-none d-md-block">
          <div class="list-group sticky-top" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-Business-list" onclick="cartItemsCategories('electronics',1,<?php echo $user_id; ?>);" data-toggle="tab" role="tab" aria-controls="list-Community" >Electronics <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('electronics');?></span></a>
            <a class="list-group-item list-group-item-action" id="list-Business-list" onclick="cartItemsCategories('arts',1,<?php echo $user_id; ?>);" data-toggle="tab" role="tab" aria-controls="list-Community" >Arts <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('arts');?></span></a>
            <a class="list-group-item list-group-item-action" id="list-Community-list" onclick="cartItemsCategories('clothes',1,<?php echo $user_id; ?>);" data-toggle="tab"  role="tab" aria-controls="list-Community" >Clothes  <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('clothes');?></span></a>
            <a class="list-group-item list-group-item-action" id="list-Community-list" onclick="cartItemsCategories('sports',1,<?php echo $user_id; ?>);" data-toggle="tab"  role="tab"  aria-controls="list-Community">Sports  <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('sports');?></span></a>
            <a class="list-group-item list-group-item-action" id="list-Community-list" onclick="cartItemsCategories('health_beauty',1,<?php echo $user_id; ?>);" data-toggle="tab"  role="tab" aria-controls="list-Community">Health  <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('health_beauty');?></span></a>
            <a class="list-group-item list-group-item-action" id="list-Community-list" onclick="cartItemsCategories('home_garden',1,<?php echo $user_id; ?>);" data-toggle="tab"  role="tab" aria-controls="list-Community">Home  <span class="float-right badge badge-primary"><?php echo $sale->cartcountPOSTS('home_garden');?></span></a>
          </div>
      </div>

      <div class="col-sm-12 col-md-10 col-lg-10 ">
          <div class="row">
              <div class="col-md-9" id="sale-hides">
                  <?php echo $sale->cartList('electronics',1,$user_id); ?>
              </div> <!-- col -->

              <div class="col-md-3">
               <span id="responseSubmititerm"> </span>
                <div id="responseSubmitcartiterm">
                <?php echo $sale->showCart_itemSale(); ?>
                </div>
              </div><!-- col -->
          </div><!-- row -->
      </div>

    </div><!-- row -->
</div>
