<?php 
if (!isset($_SESSION)) {
    session_start();
}?>
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
    <link rel="stylesheet" href="./public/style/login_styles.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./public/style/page_eventinfo.css" />
    <link rel="stylesheet" href="./public/style/main-svg.css">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
</head>
<script>
    function goPAGE() {
            if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                var div_1 = document.getElementsByClassName("blue");
                div_1.setAttribute("class", "intialism");
                document.getElementsByClassName("tickets_info").setAttribute("style", "font: 8px;");
            }
        }
        goPAGE();
</script>

<body>
    <?php 
        $TITLE = "menu";
        include "./public/sub/header.php";
    ?>
    <div class="background-image"></div>
    <div class="wrapper content container">
        <div class="container">
        <div class="main-back ">
            <div class="row" style="word-wrap: break-all">
                <div class="col-4" >
                    <span class="neon blue">Appetizer:</span>
                </div>
                <div class="col-8">
                    <span class="neon blue">Farfalle Tomato Basil</span>
                </div>
                <div class="col-4">
                    <span class="neon blue">Main Entree:</span>
                </div>
                <div class="col-8">
                    <span class="neon blue">Chicken Piccata</span>   
                </div>
                <div class="col-4">
                    <span class="neon blue">Vegetarian:</span>
                </div>
                <div class="col-8">
                    <span class="neon blue">Eggplant Parmigiana</span>   
                </div>
                <div class="col-4">
                    <span class="neon blue">Dessert:</span>
                </div>
                <div class="col-8">
                    <span class="neon blue">Triple Chocolate Mousse</span>
                </div>
            </div>     
    </div>       
        </div>
    </div>
    <?php include './public/sub/toronto_footer.php'; ?>
    
</body>
</html>

