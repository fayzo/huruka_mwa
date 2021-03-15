    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Film</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Film</li>
                </ol>
            </div>

        </div>
    </section>

     <div id="Film-view">
      <?php echo $crowfund->crowfundraisings(1,'Film',$user_id); ?>
    </div><!-- row -->