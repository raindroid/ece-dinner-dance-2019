<?php
    // include('database.php');//链接数据库
    // require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['mailto']) || $_SESSION['mailto']!='me') {
        exit("error execution");

    }//检测是否有submit操作 
    $to = "dinnerdance@ece.skule.ca";
    $_SESSION['mailto'] = null;

    $from = $_SESSION['commentfrom'];
    $msg = $_SESSION['commentcontent'];
    $_SESSION['commentfrom'] = null;
    $_SESSION['commentcontent'] = null;
    $subject = "Comment received";
    $txt = "Message from <$from>. \r\nContent: $msg";
    $headers = "From: dinnerdance@ece.skule.ca" . "\r\n";

    mail($to, $subject, $txt, $headers);
    // die("msg=$msg");
    // header("Location: ./page_eventinfo");
    // exit();
    // $con->close();
?>