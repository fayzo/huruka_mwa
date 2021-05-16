
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title>Withdraw</title>
<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
    <div class="container-fluid mb-5">

    <div class="card">
        <div class="card-body">
   
        <?php 
            $sql= "SELECT * FROM withdraw_money  ORDER BY withdraw_date DESC ";
            $query= $db->query($sql);
            if ($query->num_rows > 0) {  ?>

            <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
            <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                    <thead class="main-active thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <!-- <th>Name</th>
                            <th>email</th> -->
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
                                <td><?php echo $row['withdraw']?></td>
                                <!-- <td>< ?php echo $row['name_subscription_']?></td>
                                <td>< ?php echo $row['email_subscription_']?></td> -->
                                <?php echo ($row['status_withdraw'] == 'pending')?'
                                <td class="text-danger">'.$row['status_withdraw'].'</td>
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
