<?php
  echo $_SERVER['PHP_SELF'].'<br>' ; 
  echo $_SERVER['HTTP_HOST'].'<br>' ; 
  echo $_SERVER['SCRIPT_FILENAME'].'<br>' ; 
  echo $_SERVER['DOCUMENT_ROOT'].'<br>' ; 
  echo $_SERVER['REQUEST_URI'].'<br>' ; 
  $paths=basename($_SERVER['REQUEST_URI']);
  $path=$_SERVER['REQUEST_URI'];
  $paths= $_SERVER['PHP_SELF'].'<br>' ; 

  echo $result = substr(strrchr($path,'/'),1);
  echo $result = substr(strrchr($paths,'/'),1);

  // echo getcwd().'<br>' ; 
  // echo exec('pwd').'<br>' ; 
  // == '/'
?>