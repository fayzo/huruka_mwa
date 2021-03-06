      <header class="blog-header py-2 bg-light">
         <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <button type="button"  
          <?php 
            echo (isset($_SESSION['key']))?
             (!empty($subscription['events_subscription']) && $users->subscription_deadline($subscription['events_date_pay'],$subscription['events_subscription']) == true )?
             'class="btn btn-light" id="add_events" data-events="'.$_SESSION['key'].'"':'class="btn btn-light price-post" data-pricejob="events"' 
             :' class="btn btn-light" id="login-please" data-login="1"';
            ?> > + Add Events </button>
            <!-- <button type="button" class="btn btn-light" id="add_events" data-events="< ?php echo $_SESSION['key']; ?>" > + Add events </button> -->
         </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Events</a>
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

<div role="tabpanel">
      <div class="nav-scroller py-1 mb-2 bg-light">
        <nav class="nav d-flex justify-content-between" id="list-tab" role="tablist">
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Feature" role="tab" aria-controls="list-Feature">Feature</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Workshops" role="tab" aria-controls="list-Workshops">Workshops</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Networking" role="tab" aria-controls="list-Networking">Networking</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Trade_Shows" role="tab" aria-controls="list-Trade_Shows">Trade Shows</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Conferences" role="tab" aria-controls="list-Conferences">Conferences</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Sports" role="tab" aria-controls="list-Sports">Sports</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Party" role="tab" aria-controls="list-Party">Party</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Training" role="tab" aria-controls="list-Training">Training</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Memorial" role="tab" aria-controls="list-Memorial">Memorial</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Education" role="tab" aria-controls="list-Education">Education</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Government" role="tab" aria-controls="list-Government">Government</a>
           <a class="p-2 text-muted" data-toggle="tab" href="#list-Religion" role="tab" aria-controls="list-Religion">Religion</a>
        </nav>
      </div>

   <div class="container-fluid">

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Feature" role="tabpanel" aria-labelledby="list-Feature-list">
           <?php include "siderbar_events/Feature.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show" id="list-Workshops" role="tabpanel" aria-labelledby="list-Workshops-list">
           <?php include "siderbar_events/Workshops.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show " id="list-Networking" role="tabpanel" aria-labelledby="list-Networking-list">
           <?php include "siderbar_events/Networking.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show " id="list-Trade_Shows" role="tabpanel" aria-labelledby="list-Trade_Shows-list">
           <?php include "siderbar_events/Trade_Shows.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show " id="list-Conferences" role="tabpanel" aria-labelledby="list-Conferences-list">
           <?php include "siderbar_events/Conferences.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show " id="list-Party" role="tabpanel" aria-labelledby="list-Party-list">
           <?php include "siderbar_events/Party.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade show " id="list-Sports" role="tabpanel" aria-labelledby="list-Sports-list">
           <?php include "siderbar_events/sports.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Training" role="tabpanel" aria-labelledby="list-Training-list">
           <?php include "siderbar_events/Training.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Memorial" role="tabpanel" aria-labelledby="list-Memorial-list">
           <?php include "siderbar_events/Memorial.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade " id="list-Education" role="tabpanel" aria-labelledby="list-Education-list">
           <?php include "siderbar_events/Education.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade " id="list-Government" role="tabpanel" aria-labelledby="list-Government-list">
           <?php include "siderbar_events/Government.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade " id="list-Religion" role="tabpanel" aria-labelledby="list-Religion-list">
           <?php include "siderbar_events/Religion.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

      </div>
      <!-- tab-content -->
</div>
<!-- tabpanel -->

</div>
