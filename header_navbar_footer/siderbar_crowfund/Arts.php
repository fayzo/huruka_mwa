    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Arts</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Arts</li>
                </ol>
            </div>

        </div>
    </section>
    
   <div id="Arts-view">
      <?php echo $crowfund->crowfundraisings(1,'Arts',$user_id); ?>
    </div><!-- row -->