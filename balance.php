
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' Your Balance'; ?></title>
<?php include "header_navbar_footer/header.php"?>

<section class="content-header">
        <div class="row">
            <div class="col-4">
                <h5><i> Balance</i></h5>
            </div>
            <div class="col-8">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                    <li class="breadcrumb-item active"><i>
                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button>
                    </i></li>
                </ol>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">

      <div class="row">

        <div class="col-md-3 mb-3 d-none d-md-block">

             <?php  echo $home->userProfile($user_id); ?>

            <?php echo $trending->trends(); ?>
            <!-- Profile Image -->
            
            <div class="sticky-top" style="top: 52px;z-index:1000;">
              <?php echo $job->jobsfetch() ;?>
            </div>

        </div>
        
        <div class="col-md-6 mb-4">

        <div class="card">
            <div class="card-header main-active p-1">
                 <h4 class="h4 text-center font-weight-normal">Balance</h4>
            </div>
            <div class="card-body">

            <div class="form-group">
              <label>Your Coins Balance is: </label> <i class="fa fa-money text-success"></i>
              <i class="fas fa-coins text-warning"></i> 15,000 coins
              <button type="button" class="btn btn-default"><i class="fas fa-money-check"></i> Withdraw</button>
            </div>

              <label for="inputEmail" >Buy coins and deposit in your account <i class="fa fa-check-circle text-success"></i></label>
              <table class="table table-hover table-inverse table-responsive">
                  <thead class="thead-inverse">
                      <tr>
                          <th>N0</th>
                          <th>Coins</th>
                          <th width="30%"></th>
                          <th>Price</th>
                      </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>1</td>
                              <td><i class="fas fa-coins text-warning"></i> 35 coins</td></td>
                              <td></td>
                              <td>
                                <button type="button" onclick="coins('21000')" class="btn btn-sm btn-danger">500 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td><i class="fas fa-coins text-warning"></i> 70 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins('21000')" class="btn btn-sm btn-danger">1,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td><i class="fas fa-coins text-warning"></i> 350 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins('5000')" class="btn btn-sm btn-danger">5,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td><i class="fas fa-coins text-warning"></i> 1400 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins('21000')" class="btn btn-sm btn-danger">21,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>5</td>
                              <td><i class="fas fa-coins text-warning"></i> 3500 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins('54000')" class="btn btn-sm btn-danger">54,000 Frw</button>
                              </td>
                          </tr>
                      </tbody>
              </table>

            </div>
                <!-- /.card_body -->
            <div class="card-footer text-muted">
            </div> <!-- /.card_footer -->
        </div><!-- /.card -->

        <div class="card mt-3">
            <div class="card-header main-active p-1 text-center">
                <h4 class="card-title">Transaction Historic statement</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Users</th>
                            <th>Comment</th>
                            <th>Transaction</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td> <img class="rounded-circle" width="35px" height="35px" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"></td>
                                <td>it was gud to danate</td>
                                <td><i class="fas fa-coins text-warning"></i> 50,000 Coins</td>
                                <td>12/2/2021</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td> <img class="rounded-circle" width="35px" height="35px" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"></td>
                                <td>it was gud to danate</td>
                                <td><i class="fas fa-coins text-warning"></i> 50,000 Coins</td>
                                <td>12/2/2021</td>

                            </tr>
                        </tbody>
                </table>
            </div>
            <!-- /.card_body -->
            <div class="card-footer text-muted">
            </div> <!-- /.card_footer -->
        </div><!-- /.card -->

        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <?php $follow->whoTofollow($user['user_id'],$user['user_id'])?>

            <div class="sticky-top" style="top: 52px;z-index:1000;">
                <?php echo $home->options(); ?>
            </div>
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
