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
            <a class="blog-header-logo text-dark" href="#">Marketplace</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
    </header>

<div class="container mt-3 mb-5">
   <section class="content-header">
        <div class="row mb-2">
            <div class="col-4">
                <h1><i> Shopping</i></h1>
            </div>
            <div class="col-8">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Shopping </li>
                    <li class="breadcrumb-item active"><i>Items</i></li>
                </ol>
            </div>
        </div>
    </section>
   
    <div id="shopping-cart" >
       <button type="button" class="btn btn-primary btn-md" onclick="location.href='<?php echo BASE_URL_PUBLIC.'sale'; ?>'">Back to Purchase more</button>
       <a id="btnEmpty" href="javascript:void(0)" onclick="cart_sale_add('empty','sale',<?php echo $user_id; ?>);">Empty Cart</a>
       <span id="responseSubmititerm"> </span>
                <div id="responseSubmitcartiterm">
                 <?php echo $sale->showCart_item(); ?>
                </div>
    </div>


</div>

<?php include "header_navbar_footer/footer.php"?>