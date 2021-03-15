<?php include "header_navbar_footer/header_if_login.php"?>
<title>Email</title>
<?php include "header_navbar_footer/header.php"?>

<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-3">
                <h1><i>Email</i></h1>
            </div>
            <div class="col-9">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'" > Profile</a></i></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <?php include "header_navbar_footer/siderbar_jobs_post/messages.php"?>
            </div>
            <div class="col-md-3 d-none d-md-block">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <?php echo $trending->trends(); ?>
                        <!-- Profile Image -->
                        <div class="sticky-top" style="top:53px;">
                            <?php echo $job->jobsfetch() ;?>
                        </div>
                        <!-- jobs -->
                    </div>
                    <!-- /.col -->

                    <!-- <div class="col-md-12 mb-3">
                    < ?php echo $follow->whoTofollow($user_id,$user_id) ;?>
                    </div> -->

                </div>
                <!-- /.row -->
                <div class="sticky-top " style="top: 52px;">
                    <?php echo $home->options(); ?>
                </div>
                
            </div>
            <!-- /.col-md-3 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>

<?php include "header_navbar_footer/footer.php"?>
  