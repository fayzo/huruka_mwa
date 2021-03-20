<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Notification_body extends Home 
{
    public function Notification_body_users($user_id,$data)
    { 
        $tweet= $data;
        $likes= $this->likes($user_id,$tweet['tweet_id']);
        // $retweet= $this->checkRetweet($tweet['tweet_id'],$user_id);
        $retweet= $this->checkRetweet($tweet['tweet_id'],$tweet['retweet_by']);
        $user= $this->userData($tweet['retweet_by']);
        $comment= $this->comments($tweet['tweet_id']);
        
        ?>
                <!-- TEXT -->
                <!-- TEXT -->
                <div class="title-name-black"><?php echo $tweet['title_name']; ?></div>

                <div id="link_" class="show-read-more">
                <?php 

                    if (strlen($tweet['status']) > 200) {
                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                    $tweettext = substr($tweet['status'], 0, 200);
                    $tweetstatus = substr($tweet['status'], 0, strrpos($tweettext, ' ')).'
                    <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmores" data-tweettext="'.$tweet['tweet_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                    echo $this->getTweetLink($tweetstatus);
                    }else{
                    echo $this->getTweetLink($tweet['status']);
                    }  

                    if (strlen($tweet['status']) > 200) {
                        // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                        $tweettext = substr($tweet['status'], 0, 200);
                        $tweetstatus = substr($tweet['status'], strrpos($tweettext, ' '));
                        echo '<span style="display: none;" class="more-text view-more-text'.$tweet["tweet_id"].'">'.$this->getTweetLink($tweetstatus).'</span>';
                    }  
                    ?>
                </div>
                
                <?php 
                
                    $expodefile = explode("=",$tweet['tweet_image']);
                    $title= $tweet["photo_Title"];
                    $photo_title=  explode("=",$title);
                    $fileActualExt= array();
                    for ($i=0; $i < count($expodefile); ++$i) { 
                        $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
                    }

                    
                    $expode = $expodefile;
                    $file_size = $tweet['tweet_image_size'];
                    $file_sizes = explode("=",$file_size);
                    // $count = count($expodefile);

                    $image= array('jpg','jpeg','png','gif');
                    $pdf= array('pdf');
                    $coins= array('coins');
                    $docx= array('doc','docx','lsx');
                    $mp3= array('mp3','ogg');
                    $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
                    $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);


            if (array_diff($fileActualExt,$allower_ext) == false) { 
                    # code...
                        
                    $fileActualExt_image =array_intersect($fileActualExt,$image);
                    $count_image =count(array_intersect($fileActualExt_image,$image));
                    $filePathinfo_image=array();
                    
                    $fileActualExt_pdf =array_intersect($fileActualExt,$pdf);
                    $count_pdf =count(array_intersect($fileActualExt_pdf,$pdf));
                    $filePathinfo_pdf=array();

                    $fileActualExt_docx =array_intersect($fileActualExt,$docx);
                    $count_docx =count(array_intersect($fileActualExt_docx,$docx));
                    $filePathinfo_docx=array();
                    
                    $fileActualExt_coins =array_intersect($fileActualExt,$coins);
                    $count_coins =count(array_intersect($fileActualExt_docx,$coins));

                    $fileActualExt_mp4 =array_intersect($fileActualExt,$mp4);
                    $count_mp4 =count(array_intersect($fileActualExt_docx,$mp4));

                    $fileActualExt_mp3 =array_intersect($fileActualExt,$mp3);
                    $count_mp3 =count(array_intersect($fileActualExt_docx,$mp3));
                
            
                if(!empty($fileActualExt_image)) { 
                    $expodefile = explode("=",$tweet['tweet_image']);
                        
                    foreach ($expodefile as $file_image) {
                        # code...
                        $filePathinfo = pathinfo($file_image);

                        if (in_array($filePathinfo['extension'],$fileActualExt_image)) {
                            # code...
                            $filePathinfo_image[]= $filePathinfo['basename'];
                        }
                    }


                if ($count_image === 1) { ?>

                    <div class="row mb-1">
                        <?php $expode = $filePathinfo_image; ?>
                    <div class="col-12 more">
                        <img class="img-fluid imagePopup"
                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                        
                            <div><i><?php echo $photo_title[0]; ?></i></div>
                    
                    </div>
                    </div>

                <?php
                    }else if($count_image === 2){?>
                    <div class="row mb-2 more">
                            <?php $expode = $filePathinfo_image;
                                $splice= array_splice($expode,0,2);
                                for ($i=0; $i < count($splice); ++$i) { 
                                ?>
                        <div class="col-6">
                            <img class="img-fluid mb-2 imagePopup"
                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                
                                <div><i><?php echo $photo_title[$i]; ?></i></div>
                        
                        </div>
                            <?php }?>
                    </div>

                <?php }else if($count_image === 3 || $count_image > 3){?>
                    <div class="row mb-2 more">
                        <?php $expode = $filePathinfo_image;
                            $splice= array_splice($expode,0,1);
                            ?>
                    <div class="col-6">
                        <img class="img-fluid mb-2 imagePopup"
                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            
                            <div><i><?php echo $photo_title[0]; ?></i></div>
                    
                    </div>
                    <!-- /.col -->

                    <div class="col-6">
                        <div class="row mb-2 more">
                                <?php 
                                $expode = $filePathinfo_image;
                                // var_dump($expode);
                                $splice= array_splice($expode,1,2);
                                // var_dump($splice);
                                    for ($i=0; $i < count($splice); ++$i) { ?>
                            <div class="col-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                
                                <div><i><?php echo $photo_title[$i]; ?></i></div>
                            
                            </div>
                                <?php }?>

                        </div>
                        <!-- /.row -->
                        <div class="row more">
                                <?php 
                                $expode = $filePathinfo_image;
                                $splice= array_splice($expode,3,2);
                                    for ($i=0; $i < count($splice); ++$i) { ?>
                            <div class="col-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                    
                                    <div><i><?php echo $photo_title[$i]; ?></i></div>
                            
                            </div>
                                <?php }?>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                
                    <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                    </div>
                </div>
                <!-- /.row -->
                    
                <?php } 

                }
                
                if(!empty($fileActualExt_docx)) { 
                    $expodefile = explode("=",$tweet['tweet_image']);
                    // $filePathinfo_docx= array();
                    foreach ($expodefile as $file_image) {
                        # code...
                        $filePathinfo = pathinfo($file_image);

                        if (in_array($filePathinfo['extension'],$fileActualExt_docx)) {
                            # code...
                            $filePathinfo_docx[]= $filePathinfo['basename'];
                        }
                    }

                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $rowCount = 0;
                switch ($count_docx) {
                    case 1:
                            $numOfCols = 1; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                case 2:
                        # code...
                            $numOfCols = 2; ?>

                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 3:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 4:
                        # code...
                            $numOfCols = 2; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break; 
                    case 5:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                        
                    <?php
                        break; 
                    case 6:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_docx;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo $numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                        </div>
                    </div>
                <!-- /.row -->
                    <?php
                        break;
                }
                
                }
                if(!empty($fileActualExt_pdf)) { 
                    $expodefile = explode("=",$tweet['tweet_image']);

                    foreach ($expodefile as $file_image) {
                        # code...
                        $filePathinfo = pathinfo($file_image);

                        if (in_array($filePathinfo['extension'],$fileActualExt_pdf)) {
                            # code...
                            $filePathinfo_pdf[]= $filePathinfo['basename'];
                        }
                    }

                    // var_dump($filePathinfo_pdf);

                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $rowCount = 0;
                switch ($count_pdf) {
                    case 1:
                            $numOfCols = 1; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                case 2:
                        # code...
                            $numOfCols = 2; ?>

                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 3:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 4:
                        # code...
                            $numOfCols = 2; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break; 
                    case 5:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                        
                    <?php
                        break; 
                    case 6:
                        # code...
                            $numOfCols = 3; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_pdf;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo $numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                    <!-- 1,245 KB -->
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                        </div>
                    </div>
                <!-- /.row -->
                    <?php
                        break;
                }
                
            }

            if(!empty($fileActualExt_mp4)) { 

                $expodefile = explode("=",$tweet['tweet_image']);

                foreach ($expodefile as $file_image) {
                    # code...
                    $filePathinfo = pathinfo($file_image);

                    if (in_array($filePathinfo['extension'],$fileActualExt_mp4)) {
                        # code...
                        $filePathinfo_mp4[]= $filePathinfo['basename'];
                    }
                } 
                
                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $rowCount = 0;
                switch ($count_pdf) {
                    case 1:
                            $numOfCols = 1; ?>
                            <div class="row">
                            <?php $expode = $filePathinfo_mp4;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                        <div class="row">
                            <div class="col-12">
                                <video controls preload="auto" width="100px"  height="auto" >
                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>"
                                    type="video/<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['extension'] ;?>"> 
                                </video>
                            </div>
                            <div class="col-12">
                                <div class="mailbox-attachment-info main-active">
                                    <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                    <span class="mailbox-attachment-size">
                                    <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div><!-- col -->
                        </div><!-- row -->
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                case 2:
                        # code...
                            $numOfCols = 2; ?>

                            <div class="row">
                            <?php $expode = $filePathinfo_mp4;
                                $size_kb = explode("=",$tweet['tweet_image_size']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                        <div class="row">
                            <div class="col-12">
                                <video controls preload="auto" width="100px"  height="auto" >
                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>"
                                    type="video/<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['extension'] ;?>"> 
                                </video>
                            </div>
                            <div class="col-12">
                                <div class="mailbox-attachment-info main-active">
                                    <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                    <span class="mailbox-attachment-size">
                                    <?php echo  $this->formatSizeUnits($size_kb[$i]); ?>
                                        <!-- 1,245 KB -->
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </div><!-- col -->
                        </div><!-- row -->
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                } ?>

            <?php }
            
            if(!empty($fileActualExt_mp3)){ 
                $expodefile = explode("=",$tweet['tweet_image']);

                foreach ($expodefile as $file_image) {
                    # code...
                    $filePathinfo = pathinfo($file_image);

                    if (in_array($filePathinfo['extension'],$fileActualExt_mp3)) {
                        # code...
                        $filePathinfo_mp3[]= $filePathinfo['basename'];
                    }
                } 
                
                ?>
                <div class="row mb-2">
                    <?php 
                    $expode = $filePathinfo_mp3;
                    $size_kb = explode("=",$tweet['tweet_image_size']);
                    // $splice= array_splice($expode,0,2);
                    $splice= $expode;
                    for ($i=0; $i < count($splice); ++$i) { ?> 

                    <div class="col-12">
                        <audio controls>
                            <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>"
                            type="audio/<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['extension'] ;?>">
                                <!-- fallback content here -->
                        </audio>
                    </div>
                    <?php } ?>

                </div>
            <?php }

            if(!empty($fileActualExt_coins)){ 
                
                $expodefile = explode("=",$tweet['tweet_image']);

                foreach ($expodefile as $file_image) {
                    # code...
                    $filePathinfo = pathinfo($file_image);

                    if (in_array($filePathinfo['extension'],$fileActualExt_coins)) {
                        # code...
                        $filePathinfo_coins[]= $filePathinfo['basename'];
                    }
                } 
                
                ?>
            <div class="row mb-2">
                <div class="col-12">
                    <?php $username =(!empty($_SESSION['username']))? $_SESSION['username']: 'irangiro' ;?> 
                    <?php echo Follow::coins_recharge_tweet($tweet['user_id'],$user_id,$username,$tweet['username'],$tweet["tweet_id"]); ?>
                </div>
            </div>
            <?php } 

        } ?>


        <ul class="mt-2 list-inline" style="list-style-type: none; margin-bottom:10px;">  
                <?php if(isset($_SESSION['key']) && $_SESSION['approval'] === 'on'){ ?>
                <?php if($tweet['tweet_id'] == $retweet['retweet_id']){ ?>
                <li class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="share-btn retweeted text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet["retweet_counts"];?></span></i>
                    Share</button></li>
                <?php }else{ ?>

                    <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="share-btn retweet text-sm mr-2"':'class=" text-sm mr-2" id="login-please" data-login="1"' ;?>   data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                        <?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.''.'</span></i>';} ?>
                        Share</button></li>

                <?php } } ?>
                    <?php if($likes['like_on'] == $tweet['tweet_id']){ ?>
                        <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="unlike-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?> data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                        <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                            Like</button></li>

                    <?php }else{ ?>
                        <li  class=" list-inline-item"> <button <?php echo (isset($_SESSION['key']))?'class="like-btn text-sm"':'class="text-sm" id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                        <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                            Like</button></li>
                    <?php } ?>
                
                <span style="float:right">
            
                <li  class=" list-inline-item"><button <?php echo (isset($_SESSION['key']))?'class="comments-btn text-sm" data-toggle="collapse"':'class="text-sm" id="login-please" data-login="1"' ;?> data-target="#a<?php echo  $tweet["tweet_id"];?>" >
                    <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $this->CountsComment($tweet["tweet_id"]); ?>)
                </button></li>
                

                <?php if (isset($_SESSION['key']) && $tweet["retweet_by"] == 0 && $tweet["tweetBy"] == $user_id){ ?>
                    <li  class=" list-inline-item">
                        <ul class="deleteButt text-sm" style="list-style-type: none; margin:0px;" >
                            <li>
                            <a href="javascript:void(0)" class="more" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul style="list-style-type: none; margin:0px;" >
                                    <li style="list-style-type: none; margin:0px;"> 
                                        <label class="deleteTweet" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["tweetBy"];?>" >Delete </label>
                                </li>
                            </ul>
                            </li>
                        </ul>
                    </li>
                <?php }else if (isset($_SESSION['key']) && $tweet["retweet_by"] == $user_id){ ?>
                    <li  class=" list-inline-item">
                        <ul class="deleteButt text-sm" style="list-style-type: none; margin:0px;" >
                            <li>
                            <a href="javascript:void(0)" class="more" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul style="list-style-type: none; margin:0px;" >
                                    <li style="list-style-type: none; margin:0px;"> 
                                        <label class="delete_retweet_by" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["retweet_by"];?>" >Delete </label>
                                </li>
                            </ul>
                            </li>
                        </ul>
                    </li>
                <?php }else{ echo '';}?>
                </span>
        </ul>
        <div class="input-group">
            <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>">
            <div class="input-group-append">
                <span class="input-group-text btn" style="padding: 0px 10px;" 
                    aria-label="Username" aria-describedby="basic-addon1" <?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="<?php echo $tweet['tweet_id'];?>">
                    <span class="fa fa-arrow-right text-muted" ></span>
                </span>
            </div>
        </div>

        <div class="card collapse" id="a<?php echo  $tweet["tweet_id"];?>">
            <!-- <div class="input-group">
                <textarea class="form-control form-control-sm" id="commentHome< ?php echo $tweet['tweet_id'];?>" type="text"
                    style="height: 43px;" name="comment"  placeholder="Reply to  < ?php echo $tweet['username'] ;?>" row="1" ></textarea>
                <div class="input-group-append">
                    <span class="input-group-text btn" style="padding: 0px 10px;" 
                        aria-label="Username" aria-describedby="basic-addon1" < ?php echo (isset($_SESSION['key']))?'id="post_HomeComment"':'id="login-please" data-login="1"' ;?>  data-tweet="< ?php echo $tweet['tweet_id'];?>">
                        <span class="fa fa-arrow-right text-muted" ></span>
                    </span>
                </div>
            </div>  --><!-- input-group -->
            
            <div class="card-body" style="padding-right:0">
                <?php if (!empty($comment)) { ?>
                <h5><i>Comments (<?php echo $this->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                <span id='responseDeletePostSeconds0'></span>

                <div class="direct-chat-message direct-chat-messageS large-2" >
                <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                <?php foreach ($comment as $comments) { 
                    $second_likes= $this->Like_second($user_id,$comments['comment_id']);
                    $dislikes= $this->dislike($user_id,$comments['comment_id']);
                    ?>
                        <!-- Conversations are loaded here -->
                        <!-- Message. Default to the left -->
                            <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                    <span class="direct-chat-timestamp float-right"><?php echo $this->timeAgo($comments['comment_at']); ?></span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <?php if (!empty($comments["profile_img"])) {?>
                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                <?php  }else{ ?>
                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                <?php } ?>
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                <?php echo  $this->getTweetLink($comments["comment"]) ;?>
                            <!-- /.direct-chat-text -->
                            <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                            
                                <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                        <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                        <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                <?php }else{ ?>
                                        <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                        <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                <?php } ?>

                                <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                    <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                    <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                        unlike</button></li>
            
                                <?php }else{ ?>
                                    <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                        <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                            unlike</button></li>
                                <?php } ?>

                                <span style="float:right">
                                                    
                                <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                    <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $this->CountsComment_second($comments["comment_id"]); ?>)
                                </button></li>
                                            
                                    <?php if ($comments["comment_by"] == $user_id){ ?>
                                    <li  class=" list-inline-item">
                                        <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                            <li>
                                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <ul style="list-style-type: none; margin:0px;" >
                                                    <li style="list-style-type: none; margin:0px;"> 
                                                        <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php }else{ echo '';}?>
                                    </span>
                                </ul>
                            </div>
                            
                            <div class="card collapse border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                <div class="card-header pb-0 px-0">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                            name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                        <div class="input-group-append">
                                            <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                <span class="fa fa-arrow-right text-muted" ></span>
                                            </span>
                                        </div>
                                    </div> <!-- input-group -->
                                </div>
                                <div class="card-body" style="padding-right:0">
                                    <?php 
                                    $comment_second= $this->comments_second($comments['comment_id']);
                                    if (!empty($comment_second)) { ?>
                                    <h5><i>Comments (<?php echo $this->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                    <span id='responseDeletePostSecond'></span>
                                    <div class="direct-chat-message direct-chat-messageS large-2" >
                                    <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                    <?php foreach ($comment_second as $comments0) { ?>
                                            <!-- Conversations are loaded here -->
                                            <!-- Message. Default to the left -->
                                                <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                    <div class="direct-chat-info clearfix">
                                                        <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                        <span class="direct-chat-timestamp float-right"><?php echo $this->timeAgo($comments0['comment_at_']); ?></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <?php if (!empty($comments0["profile_img"])) { ?>
                                                    <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                    <?php  }else{ ?>
                                                    <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                    <?php } ?>
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <?php echo  $this->getTweetLink($comments0["comment_"]) ;?>
                                                        <!-- /.direct-chat-text -->
                                                        <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                <li  class=" list-inline-item">
                                                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                            <ul style="list-style-type: none; margin:0px;" >
                                                                                <li style="list-style-type: none; margin:0px;"> 
                                                                                    <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <?php }else{ echo '';}?>
                                                                </span>
                                                            </ul>
                                                    </div>
                                                </div> <!-- /.direct-chat-messg -->
                                        
                                        <?php } ?>
                                    </span>
                                </div> <!-- /.direct-chat-message -->
                            <?php } ?>

                            </div> <!-- /.card-body-->
                            </div> <!-- /.card collapse -->
                        </div> <!-- /.direct-chat-msg -->
                <?php } ?>
                </span>
                </div> <!-- /.direct-message -->
                <?php } ?>
            </div> <!-- /.card-body-->
            </div> <!-- /.card collapse -->

<?php 
    }


}

$Notification_body = new Notification_body();

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>