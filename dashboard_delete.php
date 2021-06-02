
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title>Delete</title>
<?php include "header_navbar_footer/header.php"?>

    <section class="content-header">
        <div class="row">
            <div class="col-3">
                <h5><i>Delete</i></h5>
            </div>
            <div class="col-9">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                </ol>
            </div>
          </div>
      </section>
      <!-- Main content -->

    <div class="container mb-5">
        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">

          </div>
          <div class="col-md-6 mb-4">
          
            <div class="card">
                <div class="card-body">
                    <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
                    <table class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                            <thead class="main-active thead-inverse">
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>option</th>
                                    <th>Number</th>
                                    <th>response</th>
                                </tr>
                            </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>subscription_statement</td>
                                    <td><button type="button" onclick="delete_all('subscription_statement',1)" class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('subscription_statement'); ?></td>
                                    <td> <div id="responseDelete1"></div></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td> transaction_coins</td>
                                    <td><button type="button" onclick="delete_all('transaction_coins',2)" class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('transaction_coins'); ?></td>
                                    <td> <div id="responseDelete2"></div></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>transfer_crowfundraising</td>
                                    <td><button type="button" onclick="delete_all('transfer_crowfundraising',3)" class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('transfer_crowfundraising'); ?></td>
                                    <td> <div id="responseDelete3"></div></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>transfer_fundraising</td>
                                    <td><button type="button" onclick="delete_all('transfer_fundraising',4)" class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('transfer_fundraising'); ?></td>
                                    <td> <div id="responseDelete4"></div></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>transfer_tweet</td>
                                    <td><button type="button" onclick="delete_all('transfer_tweet',5)" class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('transfer_tweet'); ?></td>
                                    <td> <div id="responseDelete5"></div></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td> withdraw_money</td>
                                    <td><button type="button" onclick="delete_all('withdraw_money',6)"  class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('withdraw_money'); ?></td>
                                    <td> <div id="responseDelete6"></div></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td> approval_user_ui: <span id="title7"><?php echo $user['approval_user_ui']; ?></span> </td>
                                    <td><input type="button" id="approval_user_ui" onclick="approval_user_ui(<?php echo $_SESSION['key'];?>,'off',7)" value="off" class="btn btn-primary"></td>
                                    <td><input type="button" id="approval_user_ui" onclick="approval_user_ui(<?php echo $_SESSION['key'];?>,'on',7)" value="on" class="btn btn-warning"></td>
                                    <td> <div id="responseDelete7"></div></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td> fundraising_donation</td>
                                    <td><button type="button" onclick="delete_all('fundraising_donation',8)"  class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('fundraising_donation'); ?></td>
                                    <td> <div id="responseDelete8"></div></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td> crowfund_donation</td>
                                    <td><button type="button" onclick="delete_all('crowfund_donation',9)"  class="btn btn-primary">Delete</button></td>
                                    <td><?php echo $home->total_counts('crowfund_donation'); ?></td>
                                    <td> <div id="responseDelete9"></div></td>
                                </tr>
                        </tbody>
                    </table>

                </div>
            </div>


        </div><!-- col -->
        <div class="col-md-3 mb-3 d-none d-md-block">
        </div><!-- col -->
    </div><!-- row -->

    </div>


<?php include "header_navbar_footer/footer.php"?>
