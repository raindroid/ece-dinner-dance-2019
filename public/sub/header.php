<?php 
// $VER = "0.0.103";
// include ("test.php");
if (!isset($_SESSION)) {
    session_start();
} ?>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" id="navbar">
    <div class="container">
        <?php include "./public/sub/ece-svg.php";?>
        <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php 
                        if ($TITLE == "event") {
                            echo ('<a class="nav-link active" href="./page_eventinfo.php">EVENT INFO</a>');
                        } else {
                            echo ('<a class="nav-link" href="./page_eventinfo.php">EVENT INFO</a>');
                        }
                    ?>
                </li>
                <li class="nav-item">
                <?php 
                        if ($TITLE == "menu") {
                            echo ('<a class="nav-link active" href="./page_menu.php">MENU</a>');
                        } else {
                            echo ('<a class="nav-link" href="./page_menu.php">MENU</a>');
                        }
                    ?>
                </li>
                <li class="nav-item">
                <?php 
                    if (isset($_SESSION['name']) && FALSE) {
                        if ($TITLE == "personalize") {
                            echo ('<a class="nav-link active" href="./page_personal.php">PERSONAL</a>');
                        } else {
                            echo ('<a class="nav-link" href="./page_personal.php">PERSONAL</a>');
                        }
                    }
                    ?>
                </li>
                <li class="nav-item">
                <?php 
                    if (isset($_SESSION['name'])) {
                        if ($TITLE == "tickets") {
                            echo ('<a class="nav-link active" href="./page_info.php">TICKETS</a>');
                        } else {
                            echo ('<a class="nav-link" href="./page_info.php">TICKETS</a>');
                        }
                    }
                    ?>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <?php 
                        $login_dis = "Log In";
                        if (isset($_SESSION['name'])) {
                            $login_dis = $_SESSION['name'];
                            echo ("<a class=\"nav-link nav-user nav-small\" href=\"./logout.php\">Hello, 
                            <span class='nav-large'>$login_dis</span>!
                            Log Out</a>");
                        } else if ($TITLE == "login") {
                            echo ("<a class=\"nav-link nav-user active\" href=\"./page_login.php\">$login_dis</a>");
                        } else {
                            echo ("<a class=\"nav-link nav-user\" href=\"./page_login.php\">$login_dis</a>");
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div> 
</nav>
<br>
<section class="jumbotron text-center row" id="header">
    <h1 class="neon pink col-12">DINNER DANCE 
        <div class="d-none d-md-inline">2019</div></h1>
</section>