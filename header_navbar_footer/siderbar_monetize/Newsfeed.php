    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i> News-Feed</i></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">News-Feed</li>
                </ol>
            </div>

        </div>
    </section>
    
   <div id="NewsFeed-view">

   
   <?php
         $sql= "SELECT * FROM subscription ORDER BY subscription_id ASC ";
         $query= $db->query($sql); ?>
   
   <?php 
        if ($query->num_rows > 0) {  ?>

            <!-- <table class="table table-striped table-bordered table-responsive-sm table-hover table_admin1"> -->
            <table id="example2" class="table table-striped table-bordered table-hover table-inverse table-responsive-sm table-responsive" >
                    <thead class="main-active thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>user_id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>Description</th>
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
                                <td><?php echo $row['user_id_subscription']; ?></td>
                                <td><?php echo $row['name_subscription']; ?></td>
                                <td><?php echo $row['email_subscription'] ;?></td>
                                <td><?php echo 'newsfeed subscription' ;?></td>
                                <td><?php echo number_format($row['newsfeed_price_pay'])?></td>
                                <td><?php echo $home->timeAgo($row['newsfeed_date_pay'])?></td>
                            </tr>
            <?php } ?>

                </tbody>
            </table>

            <?php } ?> 
            
    </div><!-- row -->