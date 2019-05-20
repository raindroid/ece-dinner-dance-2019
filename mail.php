<?php
    /**
     * sending email for verification
     */
    include('database.php');//链接数据库
    require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['mailto'])) {
        exit("error execution");

    }//检测是否有submit操作 
    $to = $_SESSION['mailto'];

    //prepare link
    function generateRandomString($length = 18)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $link = generateRandomString();
    $sql_update = "update users set `reset_link` = '$link' where email = '$to';";
    $con->query($sql_update);

    $subject = "Verify your account";
    $txt = "This is your verification link for email account: $to. Click it or copy to a browser: https://ece.skule.ca/dinner/page_login.php?veri=done&link=$link";
    $headers = "From: dinnerdance@ece.skule.ca" . "\r\n";

    mail($to, $subject, $txt, $headers);
    header("Location: ./page_login.php?veri=email");
    $con->close();
?>