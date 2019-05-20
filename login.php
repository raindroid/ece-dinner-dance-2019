<?PHP 
    include('database.php');//链接数据库
    require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['name'])) {
        header("Location: ./page_info.php");
    }
    if(!isset($_POST["login"])){
        exit("error execution");
    }//检测是否有submit操作 
    $name = $_POST['name'];//post获得用户名表单值
    $password = $_POST['password'];//post获得用户密码单值

    if ($name && $password){//如果用户名和密码都不为空
        $name = $con->real_escape_string($name);
        // $password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10,]);
        // $saved_psd = $con->query("select password from users where email='$name';");
        $sql = "select * from users where email = '$name';";//检测数据库是否有对应的username和password的sql
        $result = $con->query($sql);//执行sql
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if (password_verify($password, $result["password"])) {
            // if ($password === $result["password"]) {
                if (isset($_SESSION['veri_link']) && $_SESSION['veri_link'] === $result['reset_link']) {
                    $_SESSION['name'] = $result["display_name"];
                    $sql = "update users set `reset_link` = '' where email = '$name';";
                    $result = $con->query($sql);//执行sql
                    $sql = "update users set `is_activated` = '1' where email = '$name';";
                    $result = $con->query($sql);//执行sql
                    header("Location: ./page_info.php");
                    exit();
                } else if ($result['is_activated'] == 0) {
                    header("Location: ./page_login.php?error=veri&". $_SESSION['veri_link']);
                } else {
                    $_SESSION['name'] = $result["display_name"];
                    header("Location: ./page_info.php");
                    exit();
                }
            } else {
                header("Location: ./page_login.php?error=input&".$result['password']);
            }
        } else {
            $sql = "select * from users where display_name = '$name';";//检测数据库是否有对应的username和password的sql
            $result = $con->query($sql);//执行sql
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                if (password_verify($password, $result["password"])) {
                    
                    if (isset($_SESSION['veri_link']) && $_SESSION['veri_link'] == $result['reset_link']) {
                        $_SESSION['name'] = $result["display_name"];
                        $sql = "update users set `reset_link` = '' where display_name = '$name';";
                        $result = $con->query($sql);//执行sql
                        $sql = "update users set `is_activated` = '1' where display_name = '$name';";
                        $result = $con->query($sql);//执行sql
                        header("Location: ./page_info.php");
                    } else if ($result['is_activated'] == 0) {
                        header("Location: ./page_login.php?error=veri");
                    } else { 
                        $_SESSION['name'] = $result["display_name"];
                        header("Location: ./page_info.php");
                       
                    }
                } else {
                    header("Location: ./page_login.php?error=input");
                } 
            }else {
                header("Location: ./page_login.php?error=input");
            }
        }
    }else{//如果用户名或密码有空
        header("Location: ./page_login.php?error=input");
    }

    $con->close();//关闭数据库
?>