<?php
    $server="localhost";//host name
    $db_username="";//db user name
    $db_password= "";//db password
    $db_name = "ececlub_dinnerdance";// db name
    $con = new mysqli($server,$db_username,$db_password, $db_name);//connect
    // var_dump($con);
    if($con->connect_error){
        die("can't connect". $conn->connect_error);
    }
    
?>