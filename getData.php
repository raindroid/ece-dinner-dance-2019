<?php
    include('database.php');
    include('login.php');
    if(!isset($_POST["login"])){
        exit("error execution");
        
    }//检测是否有submit操作 

    $sql = "select * from users where email = '$name' and password='$passowrd'";//检测数据库是否有对应的username和password的sql
    $result = $con->query($sql);//执行sql
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $diet = $row['food'];
        $tableNum =  $row['table_num'];
        $arr = array(
            'food' => $diet, 
            'tableNum' => $tableNum,
        );
        echo $arr;
        $data = json_encode($arr);
    } else {
        die("wrong username or password");
    }
    
    
?>