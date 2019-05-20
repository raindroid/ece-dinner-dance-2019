<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['name'])) {
    header("Location: ./page_info.php");
    exit();
} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ECE Club Dinner Dance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   
    <!-- <script src="./main.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="./public/style/login_styles.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./public/style/page_eventinfo.css" />
    <link rel="stylesheet" href="./public/style/main-svg.css">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
</head>
<script>
    function goPAGE() {
            if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                var div = document.getElementsByClassName("blue");
                div.setAttribute("class", "intialism");
            }
        }
        goPAGE();
</script>

<body> 
    <?php 
    $TITLE = "login";
               
    include "./public/sub/header.php";
    ?>
    <script>
        $(window).on('load', function(){        
            $('#myModal').modal('show');
            setTimeout(() => {
                $('.alert').addClass("inv");
            }, 5000);
        }); 
    </script> 
    <div class="background-image"></div>

    <div class="wrapper content container">
        <div class="container">
            
            <?php
                if (isset($_GET["action"]) && $_GET["action"] == "register"){
            ?>
            <form class="form" name="registerForm" role="form" action="./register.php" method="POST">
                <?php
                    if (isset($_GET["error"]) && $_GET["error"] == "email") {
                        $msg_type = "Error";
                        $msg_content = "You have registered before!<br> <a href='./page_login.php'>Log In here</a>";
                    } else if (isset($_GET["error"]) && $_GET["error"] == "input") {
                        $msg_type = "Error";
                        $msg_content = "You have invalid input!";
                    } else if (isset($_GET["error"]) && $_GET["error"] == "name") {
                        $msg_type = "Error";
                        $msg_content = "The username is already taken!";
                    } 
                ?>
                
                <input type="email" placeholder="Email" aria-label="Email"
                    name="email" required 
                    <?php
                        if (isset($_GET["email"])) {
                            echo "value=\"", $_GET["email"], "\"";
                        }
                    ?>
                    focus>
                <input type="text" placeholder="Username" aria-label="Username"  aria-describedby="basic-addon1"
                    name="name" required>
                <div class="row justify-content-center">
                    <div class="col-2"></div>
                    <input class="col-3 in-form" type="first_name" name="first" placeholder="Fisrt Name"  
                    <?php
                    if (isset($_GET["first"])) {
                        echo "value=\"", $_GET["first"], "\"";
                    }
                    ?> required>
                    <div class ="col-1" > </div>
                    <input class="col-3 in-form" type="last_name" name="last" placeholder="Last Name"
                    <?php
                    if (isset($_GET["last"])) {
                        echo "value=\"", $_GET["last"], "\"";
                    }
                    ?> required>
                    <div class ="col-2" > </div>
                </div>                    
                <input type="password" placeholder="Password" aria-label="Password"  aria-describedby="basic-addon1" 
                    pattern=".{6,20}" title="6 to 20 characters" name="password" required>
                <div class="space"></div>
                <button type="submit" id="register-button" name="register" class="btn btn-outline-success">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Register</button>
            </form> 

            <?php
                }else if (isset($_GET["action"]) && $_GET["action"] == "reset") {
                    include('database.php');//链接数据库
                    require_once('./lib/password.php');

                    $name = "error";
                    if (isset($_GET["link"])) {
                        $link = $_GET["link"];
                        $result = $con->query("select * from users where reset_link = '$link';");
                        if ($result) {
                            $name = $result->fetch_assoc()['email'];
                        }
                    }
                    $con->close();
                    if ($name == "error") {
                        $url = "./page_login.php?error=link";
                        echo "<script type='text/javascript'>";
                        echo "window.location.href='$url'";
                        echo "</script>"; 
                    }
            ?>
            <form class="form" name="resetForm" role="form" action="./reset_pwd.php" method="POST">
                <input class="alert alert-primary" type="email" name="email" 
                value="<?php echo ($name)?>" readonly>
                <input type="password" placeholder="Password" aria-label="Password"  aria-describedby="basic-addon1" 
                    id="password" pattern=".{6,20}" title="6 to 20 characters" name="password" required>
                <input type="password" placeholder="Confirm Password" id="confirm_password" id="confirm_password" required>
                <button type="submit" id="reset-button" name="reset" class="col-5 btn btn-outline-success">
                <i class="fas fa-check-double"></i>&nbsp;&nbsp;Confirm</button>
            </form>
            <script>
                var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

                function validatePassword(){
                if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
                }

                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            </script>
            <?php
                }else if (isset($_GET["action"]) && $_GET["action"] == "forgot") {
            ?>
                <form class="form" name="forgotForm" role="form" action="./forgot.php" method="POST">
                    <input type="email" name="email" placeholder="email">
                    <button type="submit" id="forgot-button" name="forgot" class="col-5 btn btn-outline-success">
                    <i class="fas fa-ghost"></i>&nbsp;&nbsp;Confirm</button>
                </form>
            <?php
                }else { //Log in
            ?>
            <form class="form" name="loginForm" role="form" action="./login.php" method="POST">
                <?php
                    if (isset($_GET["veri"]) && $_GET["veri"] == "email") {
                ?>
                    <div class="alert alert-info" role="alert">
                        Please check your email box for verfication link!
                    </div>
                <?php
                    } 
                    if (isset($_GET["veri"]) && $_GET["veri"] == "done" && isset($_GET["link"])) {
                        $_SESSION['veri_link'] = $_GET["link"];
                ?>
                    <div class="alert alert-success" role="alert">
                        Log in to finish verification, YES! 
                    </div>
                <?php
                    } else if (isset($_GET["error"]) && $_GET["error"] == "link") {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Illegal link
                    </div>
                <?php
                    } else if (isset($_GET["error"]) && $_GET["error"] == "veri") {
                ?>
                    <div class="alert alert-danger" role="alert">
                        You have to verification first! (Check email or click "forgot password")
                    </div>
                <?php 
                    } else if (isset($_GET["error"]) && $_GET["error"] == "input") {
                ?>
                    <div class="alert alert-danger" role="alert">
                        You have invalid username/email or password!
                    </div>
                <?php 
                    }
                ?>
                <input type="text" placeholder="Username" aria-label="Username"  aria-describedby="basic-addon1"
                    name="name" required focus>
                <input type="password" placeholder="Password" aria-label="Password"  aria-describedby="basic-addon1" 
                    name="password" required>
                <div class="space"></div>
                <div class="row justify-content-center">
                    <button type="submit" id="login-button" name="login" class="col-5 btn btn-outline-success">
                        <i class="fas fa-utensils"></i>&nbsp;&nbsp;Login</button>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col mx-auto">
                        <p class="mx-auto text-center">
                            <span><a id="forgot" href="./page_login.php?action=forgot">Forgot password?</a></span>
                            or
                            <span><a id="register" href="./page_login.php?action=register">Register Today</a></span>
                        </p>
                    </div>
                </div>
            </form>
            <?php
                }
            ?>
        </div>
    </div>
    

    <?php include './public/sub/toronto_footer.php'; ?>
    <?php if (isset($msg_type)) { ?>
    <div class="modal in fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content alert alert-danger">
                <div class="modal-header alert alert-danger">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $msg_type ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $msg_content ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>

