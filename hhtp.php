<?php
  // echo $_SERVER['PHP_SELF'].'<br>' ; 
  // echo $_SERVER['HTTP_HOST'].'<br>' ; 
  // echo $_SERVER['SCRIPT_FILENAME'].'<br>' ; 
  // echo $_SERVER['DOCUMENT_ROOT'].'<br>' ; 
  // echo $_SERVER['REQUEST_URI'].'<br>' ; 
  // $paths=basename($_SERVER['REQUEST_URI']);
  // $path=$_SERVER['REQUEST_URI'];
  // $paths= $_SERVER['PHP_SELF'].'<br>' ; 

  // echo $result = substr(strrchr($path,'/'),1);
  // echo $result = substr(strrchr($paths,'/'),1);

  // echo getcwd().'<br>' ; 
  // echo exec('pwd').'<br>' ; 
  // == '/'

echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 1day')).'</br>';
echo '--------------</br>';
echo date('Y-m-d H:i:s', strtotime('+ 1day')).'</br>';
echo '--------------</br>';
echo date('Y-m-d H:i:s', strtotime('+ 5day')).'</br>';
echo date('Y-m-d H:i:s', strtotime('+ 4weeks')).'</br>';
echo date('Y-m-d H:i:s', strtotime('+ 1months')).'</br>';
echo date('Y-m-d H:i:s', strtotime('+ 1years')).'</br>';

class Gud 
{
  public function dayRemain($datetime){
    $Date  = $datetime;
    $now  = date('Y-m-d');
    $datetime1 = new DateTime($Date);
    $datetime2 = new DateTime($now);
    $interval = $datetime1->diff($datetime2);
    return ($Date > $now )? 
    ' ('.$interval->format('%R%a').'days Remain)':'';
}
  public function timeDeadiline($datetime){

    $time= strtotime($datetime);
    $current= time($datetime);
    if ($time > $current) {
        # code...
        $second= $time - $current ;
        $minute= round($second / 60);
        $hour= round($second / 3600);
        $week= round($second / 86400);
        $month= round($second / 2600640);

        $date = date('d/m/Y', $time);

        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');


        if ($week <= 7) {
            # code...
            return  $interval->format('%a days').' remain'; 
        }elseif ($month <= 12) {
            # code...
            return date('M j',$time); 

        }else { 
            # code...
            return date('M j, Y',$time); 
        }

        
    }else{
        $second= $current - $time;
        $minute= round($second / 60);
        $hour= round($second / 3600);
        $week= round($second / 86400);
        $month= round($second / 2600640);

        $date = date('d/m/Y', $time);

        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');

        if ($second <= 60) {
            # code...
            if ($second == 0 ) {
                # code...
                return 'now'; 
            }else {
                # code...
                return $second.'s ago'; 
            }

        }elseif ($minute <= 60) {
            # code...
            return $minute.'m ago '; 
        }elseif ($hour <= 24 ) {
            # code...
            return $hour.'h ago'; 

        }elseif ($week == 1 ) {
            # code...
            return  '1 day ago'; 
        }elseif ($week <= 7) {
            # code...
            return  $interval->format('%a days').' ago'; 
        }elseif ($month <= 12) {
            # code...
            return date('M j',$time); 

        }else { 
            # code...
            return date('M j, Y',$time); 
        }

    }
    
  }

    public function subscription_deadline($date,$subscription){
     
        // $date = date('Y-m-d', strtotime('+ 1weeks'));
        // $date = date('Y-m-d', strtotime('+' +$subscription));
        // $datetime= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 1'+$subscription));
        $datetime= date('Y-m-d H:i:s', strtotime($date.'+ 1'.$subscription));
        
        # code...
        $time= strtotime($datetime);
        $current= time($datetime);
        if ($time > $current) {
            # code...
            return true;
        }else {
            # code...
            return false; 

        }
        
        // echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 1day')).'</br>';
        // echo '--------------</br>';
        // echo date('Y-m-d H:i:s', strtotime('+ 1day')).'</br>';
        // echo '--------------</br>';
        // echo date('Y-m-d H:i:s', strtotime('+ 5day')).'</br>';
        // echo date('Y-m-d H:i:s', strtotime('+ 4weeks')).'</br>';
        // echo date('Y-m-d H:i:s', strtotime('+ 1months')).'</br>';
        // echo date('Y-m-d H:i:s', strtotime('+ 1years')).'</br>';

    }

}

$gud = new Gud();

$date = date('Y-m-d', strtotime(date('2021-04-23 07:07:12').'+ 1weeks'));

echo $gud->timeDeadiline($date);
echo $gud->dayRemain($date);
// echo $gud->subscription_deadline($date,'weeks');
$date = date('2021-04-23 07:07:12');

if ($gud->subscription_deadline($date,'weeks') == true) {
    # code...
    echo 'true';
}else {
    # code...
    echo 'false';

}
?>