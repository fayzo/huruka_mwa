<div class="container mt-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6 hidden-xs">
                <h1><i> Business</i></h1>
            </div>
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item ">Business</li>
                    <li class="breadcrumb-item active"><i>helps</i></li>
                </ol>
            </div>
        </div>
    </section>

   <div id="businessPagination">
    <?php echo $fundraising->fundraisings(1,'business',$user_id); ?>
  </div>

</div>