<?php
    include('database.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['name'])) {
        header("Location: ./page_personal.php");
    }
    // include('login.php');
    // die("HEllo world");
    // if(!isset($_POST["login"])){
    //      header("Location: ./login.php");
    // }//检测是否有submit操作 
    //$email = $_POST['email'];
    $food = $_POST['food'];//post获得用户名表单值
    $tableNum = $_POST['table_num'];//post获得用户密码单值
    $name = $_SESSION['name'];
    $temp = $con->query("select * from users where display_name='$name';");
    if ($temp->num_rows > 0) {
        $sql_insert = "UPDATE users SET food='$food', table_num='$tableNum' WHERE display_name='$name';";
        $result = $con->query($sql_insert);//执行sql
        
        // die("insert=$sql_insert");
        header("Location: ./page_login.php?error=failtoupdate");
        if ($result == TRUE) {
            header("Location: ./page_eventinfo.php");
        } else {
            header("Location: ./page_login.php?error=failtoupdate");
            die("fail to store data");
        }
    } else {
        header("Location: ./page_login.php?error=nosuchrow");
    }

    
?>