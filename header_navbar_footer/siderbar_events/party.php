 
  <section class="content-header">
        <div class="row mb-2">
            <div class="col-4">
                <h4><i>Party</i></h4>
            </div>

            <div class="col-8">
                <ol class="breadcrumb float-right">
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
