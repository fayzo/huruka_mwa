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
                return $second.'s remain'; 
            }

        }elseif ($minute <= 60) {
            # code...
            return $minute.'m remain'; 
        }elseif ($hour <= 24 ) {
            # code...
            return $hour.'h remain'; 

        }elseif ($week == 1 ) {
            # code...
            return  'yesterday'; 
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
}

$gud = new Gud();

$date = date('Y-m-d', strtotime('+ 1weeks'));

echo $gud->timeDeadiline($date);
echo $gud->dayRemain($date);


?>