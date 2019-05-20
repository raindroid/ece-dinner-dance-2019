<?PHP 
    include('database.php');//链接数据库
    require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['name'])) {
        header("Location: ./page_personal.php");
    }
    if(!isset($_POST["reset"])){
        exit("error execution");
    }//检测是否有submit操作 
    $email = $_POST['email'];//post获得用户名表单值
    $password = $_POST['password'];
    if ($email && $password) {
        $email = $con->real_escape_string($email);
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10,]);
        $sql = $con->query("update users set reset_link = '' where email = '$email';");
        $sql = $con->query("update users set password = '$password' where email = '$email';");

        $sql = "update users set `is_activated` = '1' where email = '$email';";
        $result = $con->query($sql);//执行sql
        header("Location: ./page_login.php");
    }
    $con->close();//关闭数据库
?>