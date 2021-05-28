<header class="blog-header py-2 mb-3 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Religion</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
          </div>
        </div>
      </header>

 <div class="container-fluid">

<div role="tabpanel">
  <div class="row">
    <div class="col-sm-12 col-md-2 col-lg-2 py-3 px-2 d-none d-md-block">
      <div class="list-group sticky-top" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-Quran-list" data-toggle="tab" href="#list-Quran" role="tab" aria-controls="list-Quran"><i class="fa fa-book" aria-hidden="true"></i> Quran</a>
        <a class="list-group-item list-group-item-action" id="list-Bible-list" data-toggle="tab" href="#list-Bible" role="tab" aria-controls="list-Bible"><i class="fa fa-book" aria-hidden="true"></i> Bible</a>
      </div>
    </div>

    <div class="col-sm-12 col-md-10 col-lg-10">
      <div class="nav-scroller py-0 d-sm-block d-md-none main-active " style="clear:right;height:3.4rem;"> 
          <nav class="nav d-flex justify-content-between pb-0  horizontal-large-2" id="list-tab" role="tablist">
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Quran"><i class="fa fa-book" aria-hidden="true"></i> Quran<span class="badge badge-primary">114</span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Bible"><i class="fa fa-book" aria-hidden="true"></i> Bible<span class="badge badge-primary">114</span></a>
          </nav>
      </div> 

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Quran" role="tabpanel" aria-labelledby="list-Quran-list">
           <?php include "siderbar_Religion/Quran.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Bible" role="tabpanel" aria-labelledby="list-Bible-list">
           <?php include "siderbar_Religion/Bible.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

      </div>
      
    </div>
  </div>
</div>
</div>
<!-- Use any element to open the sidenav -->
<!-- <span>open</span> -->

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<!-- <div id="main">
  ...
</div> -->