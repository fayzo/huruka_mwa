    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Electronics</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Electronics</li>
                </ol>
            </div>

        </div>
    </section>

   <div id="electronics-view">
      <?php echo $crowfund->crowfundraisings(1,'electronics',$user_id); ?>
    </div><!-- row -->