
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title>Withdraw</title>
<?php include "header_navbar_footer/header.php"?>

    <section class="content-header">
        <div class="row">
            <div class="col-3">
                <h5><i>Transfer money to the users </i></h5>
            </div>
            <div class="col-9">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                </ol>
            </div>
          </div>
      </section>
      <!-- Main content -->

    <div class="container-fluid mb-5">

    <div class="card">
        <div class="card-body">
        <?php 
            $sql= "SELECT * FROM withdraw_money W 
            LEFT JOIN users U ON W. user_id_withdraw = U. user_id
            ORDER BY W. withdraw_date DESC";
            $query= $db->query($sql);
            if ($query->num_rows > 0) {  ?>

            <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
            <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                    <thead class="main-active thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>type of payment</th>
                            <th>Bank details</th>
                            <th>Phone details</th>
                            <th>status</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                <tbody>
            <?php
                $i=1;
                while($row= $query->fetch_array()) { 
                    // var_dump($row); 
                ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['name_withdraw']?></td>
                                <td><?php echo $row['email_withdraw']?></td>
                                <td><?php echo $row['withdraw']; ?></td>
                                <td><?php echo $row['type_of_payment']; ?></td>
                                <td><?php echo 'Bank Name ='.$row['bank_name'];?></br>
                                <?php echo 'Bank Account ='. $row['bank_account'];?></br>
                                <?php echo 'Swift Number ='.$row['swift_number'];?></td>
                                <td><?php echo 'SIM ='.$row['sim_account'];?></br>
                                <?php echo 'Number ='. $row['sim_number'];?></td>
                                <?php echo ($row['status_withdraw'] == 'pending')?'
                                <td class="text-danger">'.$row['status_withdraw'].'
                                <div class="response'.$row['withdraw_id'].'"></div>
                                <button type="button" id="update_transfer_payment" 
                                class="btn btn-danger btn-sm" data-withdraw="'.$row['withdraw_id'].'" data-type="update" >Transfer payment</button></br>
                                <button type="button" id="update_transfer_payment" 
                                class="btn btn-primary btn-sm" data-withdraw="'.$row['withdraw_id'].'"  data-type="block"  >Block payment</button></br>
                                <button type="button" id="update_transfer_payment" 
                                class="btn btn-warning btn-sm" data-withdraw="'.$row['withdraw_id'].'"  data-type="remove"  >Remove payment</button></td>
                                ':'
                                <td class="text-success">'.$row['status_withdraw'].'</td>
                                '?>
                                <td><?php echo number_format($row['withdraw_price'])?></td>
                                <td><?php echo $users->timeAgo($row['withdraw_date'])?></td>
                            </tr>
            <?php } ?>

                </tbody>
            </table>

            <?php } ?> 

        </div>
    </div>

    </div>


<?php include "header_navbar_footer/footer.php"?>
