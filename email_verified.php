<?php
include "core/init.php";

echo $_GET['token'];

if(isset($_GET['token'])){

    $users->email_hash($_GET['token']);
    function setInterval($f, $milliseconds)
    {
            $seconds=(int)$milliseconds/1000;
            while(true)
            {
                $f();
                sleep($seconds);
            }
    }

    setInterval(function(){
        // echo "hi!\n";
        header('location: '.CREATE_PASSPOWRD.'');
        exit();
    }, 5000);
}

?>