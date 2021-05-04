 
  <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i>Party</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Party</li>
                    <li class="breadcrumb-item">Events</li>
                </ol>
            </div>

        </div>
    </section>

<div class="row">
    <div class="col-12 col-md-12 ">
      <div id="Party">
          <!-- END SLIDER WITH CAPTIONS -->
         <?php echo $events->eventsList(1,'Party',$user_id); ?>
      </div>
    </div> 
    <!-- col -->
</div> <!-- row -->
