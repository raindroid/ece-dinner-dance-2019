<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['name'])) {
    header("Location: ./page_login.php");
    exit();
}

check_table(1);
function check_table ($at) {
    include('database.php');
    $result = $con->query("select * from dinner where table_num=$at order by ticket_num;");
    echo "count: ".$result->num_rows."<br>";
    while($p = $result->fetch_assoc()){
        echo "email=".$p['email'].'<br>';
    }


    $con->close();
}
?>