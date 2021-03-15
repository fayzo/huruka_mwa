<div class="container mt-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Creative</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Creative</li>
                    <li class="breadcrumb-item active"><i>helps</i></li>
                </ol>
            </div>
        </div>
    </section>

  <div id="creativePagination">
    <?php echo $fundraising->fundraisings(1,'creative',$user_id); ?>
  </div>
</div>