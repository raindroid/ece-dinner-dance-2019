<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['name'])) {
    header("Location: ./page_login.php");
    exit();
}

header("Location: ./page_info.php");
exit();
//ends

if (!isset($_POST["change"])) {
    exit("error execution");
}//检测是否有submit操作 
$tid = $_GET['tid'];
if (!isset($_GET['tid'])) {
    exit("error request tid=$tid");
}
require_once 'table_limit.php';

// foreach ($_SESSION as $x => $x_value) {
//     echo "Key=" . $x . ", Value=" . $x_value;
//     echo "<br>";
// }
// $id = $_SESSION["tid" . $tid];
$tid = $_SESSION["tk".$_SESSION["tid" . $tid]];

$name = $_POST['name'];//post获得用户名表单值
$first = $_POST['first'];
$last = $_POST['last'];
$table = $_POST['table'];
$food = $_POST['food'];
$depart = $_POST['depart'];
$return = $_POST['return'];
$comment = $_POST['comment'];

$user = $_SESSION['name'];
session_unset();
$_SESSION['name'] = $user;

//Read info from database
include('database.php');

function check_query($res, $it)
{
    if ($res === true) {
        // echo ("check $it, good.");
        return;
    } else {
        $_SESSION['update'] = "$it";
        header("location: ./page_info.php");
        exit();
    }
}
if (!empty($name) && !empty($first) && !empty($last) && !empty($table) && !empty($food)) {//如果用户名和密码都不为空
    $name = $con->real_escape_string($name);
    $first = $con->real_escape_string($first);
    $last = $con->real_escape_string($last);
    $table = $con->real_escape_string($table);
    $food = $con->real_escape_string($food);
    $depart = $con->real_escape_string($depart);
    $return = $con->real_escape_string($return);

    check_query($con->query("update dinner set display_name='$name' where ticket_num='$tid';"), 'name');
    check_query($con->query("update dinner set last_name='$last' where ticket_num='$tid';"), 'last');
    check_query($con->query("update dinner set first_name='$first' where ticket_num='$tid';"), 'first');
    check_query($con->query("update dinner set food='$food' where ticket_num='$tid';"), 'food');

    if ($table > 0 && $table <= 30 && $con->query("select * from dinner where table_num=$table;")->num_rows < $tlim[$table]) {
        check_query($con->query("update dinner set table_num='$table' where ticket_num='$tid';"), 'table');
    } else if ($con->query("select * from dinner where table_num=$table and ticket_num='$tid';")->num_rows> 0) {
    } else {
        $_SESSION['update'] = 'tablefull';
        header("location: ./page_info.php");
        exit();
    }
} else {
    $_SESSION['update'] = 'unfill';
    header("location: ./page_info.php");
    exit();
}

if (!empty($depart)) {
    if ($depart > 0 && $depart <= 5 && $con->query("select * from dinner where bus_depart=$depart;")->num_rows < 48) {
        check_query($con->query("update dinner set bus_depart='$depart' where ticket_num='$tid';"), 'depart');
    } else if (!($con->query("select * from dinner where bus_depart=$depart and ticket_num='$tid';")->num_rows > 0)) {
        $_SESSION['update'] = 'departfull';
        header("location: ./page_info.php");
        exit();
    }
}

if (!empty($return)) {
    if ($return > 0 && $return <= 5 && $con->query("select * from dinner where bus_return=$return;")->num_rows < 48) {
        check_query($con->query("update dinner set bus_return='$return' where ticket_num='$tid';"), 'return');
    } else if (!($con->query("select * from dinner where bus_return=$return and ticket_num='$tid';")->num_rows > 0)) {
        $_SESSION['update'] = 'returnfull';
        header("location: ./page_info.php");
        exit();
    }
}

if (!empty($comment)) {
    $_SESSION['commentfrom'] = $first.' '.$last.' '.$name;
    $_SESSION['commentcontent'] = $comment;
    $_SESSION['mailto'] = 'me';
    include 'mail_back.php';
}

$_SESSION['update']='suc';
header("location: ./page_info.php?tid=$tid");
exit();
$con->close();
?>