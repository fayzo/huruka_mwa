    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> Users-coins</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Users-coins</li>
                </ol>
            </div>

        </div>
    </section>
    
   <div id="Users-coins-view">
   <?php
         $sql= "SELECT * FROM users ORDER BY amount_francs Desc ";
         $query= $db->query($sql); ?>
   
   <?php 
        if ($query->num_rows > 0) {  ?>

            <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
            <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                    <thead class="main-active thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>user_id</th>
                            <th>username</th>
                            <th>email</th>
                            <th>Description</th>
                            <th>amount coins</th>
                            <th>amount francs</th>
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
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email'] ;?></td>
                                <td><?php echo 'Coins' ;?></td>
                                <td><?php echo number_format($row['amount_coins'],2)?></td>
                                <td><?php echo number_format($row['amount_francs'])?></td>
                                <td><?php echo $home->timeAgo($row['last_login'])?></td>
                            </tr>
            <?php } ?>

                </tbody>
            </table>

            <?php } ?> 


    </div><!-- row -->