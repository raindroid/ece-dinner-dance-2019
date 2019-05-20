<?PHP 
    include('database.php');//链接数据库
    require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['name'])) {
        header("Location: ./page_personal.php");
    }
    if(!isset($_POST["forgot"])){
        exit("error execution");
    }//检测是否有submit操作 
    $email = $_POST['email'];
    if ($email) {
        $email = $con->real_escape_string($email);
        $res = $con->query("select * from users where email='$email';");
        if ($res->num_rows > 0) {
            $res = $res->fetch_assoc();
            $_SESSION['mailto'] = $email;
            include('mail_hash.php');
        }
    }
    // header("Location: ./page_login.php");
    $con->close();//关闭数据库
?>