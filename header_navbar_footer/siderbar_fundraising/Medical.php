<div class="container mt-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Medical</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Medical</li>
                    <li class="breadcrumb-item active"><i>helps</i></li>
                </ol>
            </div>
        </div>
    </section>

  <div id="medicalPagination">
    <?php echo $fundraising->fundraisings(1,'medical',$user_id); ?>
  </div>
</div>