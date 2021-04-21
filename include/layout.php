<!DOCTYPE html>
<html>
<head>
    <title>*Client Info*</title>
    <style>table,tr{border:2px solid gold;border-collapse:collapse;}td{padding:5px;}</style>
</head>

<body>
<?php
  $clientProps=array('screen.width','screen.height','window.innerWidth','window.innerHeight', 
    'window.outerWidth','window.outerHeight','screen.colorDepth','screen.pixelDepth');

  if(! isset($_POST['screenheight'])){

    echo "Loading...<form method='POST' id='data' style='display:none'>";
    foreach($clientProps as $p) {  //create hidden form
      echo "<input type='text' id='".str_replace('.','',$p)."' name='".str_replace('.','',$p)."'>";
    }
    echo "<input type='submit'></form>";

    echo "<script>";
    foreach($clientProps as $p) {  //populate hidden form with screen/window info
      echo "document.getElementById('" . str_replace('.','',$p) . "').value = $p;";
    }
    echo "document.forms.namedItem('data').submit();"; //submit form
    echo "</script>";

  }else{

    echo "<table>";
    foreach($clientProps as $p) {   //create output table
      echo "<tr><td>".ucwords(str_replace('.',' ',$p)).":</td><td>".$_POST[str_replace('.','',$p)]."</td></tr>";
    }
    echo "</table>";
  }
?>
<script>
    window.history.replaceState(null,null); //avoid form warning if user clicks refresh
</script>
</body>
</html>