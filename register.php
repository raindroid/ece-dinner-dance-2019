<?PHP 
    include('database.php');//链接数据库
    require_once('./lib/password.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_POST["register"])) {
        exit("error execution");

    }//检测是否有submit操作 
    $email = $_POST['email'];
    $name = $_POST['name'];//post获得用户名表单值
    $first = $_POST['first'];
    $last = $_POST['last'];
    $password = $_POST['password'];//post获得用户密码单值

    if ($name && $password && $email && $first && $last) {//如果用户名和密码都不为空
        $email = $con->real_escape_string($email);
        $name = $con->real_escape_string($name);
        $first = $con->real_escape_string($first);
        $last = $con->real_escape_string($last);

        $result  = $con->query("select * from users where email='$email';");
        if ($result->num_rows > 0) {
            // die("is it?" .($result->fetch_assoc()['is_early_bird']));
            header ("Location: ./page_login.php?action=register&error=email");
            exit();
        }

        $result = $con->query("select * from users where display_name='$name';");
        if ($result->num_rows > 0) {
            header("Location: ./page_login.php?action=register&error=name&email=$email&first=$first&last=$last");
            exit();
        }

        $password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10,]);
        // echo "encrypted = $password";
        // $sql = "select * from users where email = '$name' and password='$password'";//检测数据库是否有对应的username和password的sql
        // $result = $con->query($sql);//执行sql
        $sql_insert = "insert into users (email, display_name, password, dinnerdance_year, first_name, last_name)
        values ('$email', '$name', '$password', 2019, '$first', '$last');";
        $result = $con->query($sql_insert);//执行sql
        if ($result === TRUE) {
            $_SESSION['mailto']=$email;
            header("Location: ./mail.php");
        } else {
        die("error 1 sql = $sql_insert");
            header("Location: ./page_login.php?action=register&error=input");
        }

    } else {//如果用户名或密码有空
        die("error 2 email=$email, name=$name, first=$first, last=$last, password=$password");
        header("Location: ./page_login.php?action=register&error=input");
    }

    $con->close();//关闭数据库
?>