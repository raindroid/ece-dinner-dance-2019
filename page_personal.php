<?php 
header("./page_info.php");
exit();
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
<?php
    include('database.php');
    // include('login.php');
    if(!isset($_POST["login"])){
        exit("error execution");
        
    }//检测是否有submit操作 
    $sql = "select * from users where email = '$name' and password='$passowrd'";//检测数据库是否有对应的username和password的sql
    $result = $con->query($sql);//执行sql
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $diet = $row['food'];
        $tableNum =  $row['table_num'];
        
    } else {
        $diet = '';
        $tableNum = '';
        die("wrong username or password");
    }
?>
<body>
    <?php 
        $TITLE = "personalize";
        include "./public/sub/header.php";
    ?>
    <div class="container" id='main'>
        <div class="main-back ">
            <div class="row row-centered" style="word-wrap: break-all">
                <form name="loginForm" class="form-style" role="form" action="./sendData.php" method="post">
                    <!-- <div class="form-group"> -->
                    <div class="row space">
                        <div class="col-6 col-char">
                            <label for="dietry"><span class="neon blue">Food Preference: </span> </label>
                        </div>
                        <div class="col-6">
                            <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control" placeholder="vegie, allergy, etc." name="food" value="<?php echo json_encode($diet);?>"required/>
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                    <!-- </div>
                    <div class="form-group"> -->
                    <div class="row space">
                        <div class="col-6" style="text-align: center">
                            <label for="table"><span class="neon blue">Table Selection:</span></label>
                        </div>
                        <div class="col-6">
                            <span class="block input-icon input-icon-right">
                                <input type="number" class="form-control" placeholder="tableNum: 01 - 30" name="table_num" value="<?php echo json_encode($tableNum);?>" 
                                min='1' max='30' required/>
                                <i class="ace-icon fa fa-lock"></i>
                            </span>
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="row space">
                        <div class="col-4">
                            <label class="control-label no-padding-right"> </label>
                        </div>
                        <div class="col-4">
                            <button type="submit" id="personal-button" name="personal" class="btn btn-outline-success">
                            <i class="fas fa-utensils"></i>&nbsp;&nbsp;Submit</button>
                        </div>
                        <div class="col-4">
                            <label class="control-label no-padding-right"> </label>
                        </div>
                    </div>
                </form>
                <form class="form-style" role="form" action="./sendData.php" method="post">
                <p style="text-align: center;">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table1" aria-expanded="false" aria-controls="table1">Table01</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table2" aria-expanded="false" aria-controls="table2">Table02</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table3" aria-expanded="false" aria-controls="table3">Table03</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table4" aria-expanded="false" aria-controls="table4">Table4</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table5" aria-expanded="false" aria-controls="table5">Table5</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table6" aria-expanded="false" aria-controls="table6">Table6</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table7" aria-expanded="false" aria-controls="table7">Table7</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table8" aria-expanded="false" aria-controls="table8">Table8</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table9" aria-expanded="false" aria-controls="table9">Table9</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table10" aria-expanded="false" aria-controls="table10">Table10</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table11" aria-expanded="false" aria-controls="table11">Table11</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table12" aria-expanded="false" aria-controls="table12">Table12</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table13" aria-expanded="false" aria-controls="table13">Table13</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table14" aria-expanded="false" aria-controls="table14">Table14</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table15" aria-expanded="false" aria-controls="table15">Table15</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table16" aria-expanded="false" aria-controls="table16">Table16</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table17" aria-expanded="false" aria-controls="table17">Table17</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table18" aria-expanded="false" aria-controls="table18">Table18</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table19" aria-expanded="false" aria-controls="table19">Table19</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table20" aria-expanded="false" aria-controls="table20">Table20</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table21" aria-expanded="false" aria-controls="table21">Table21</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table22" aria-expanded="false" aria-controls="table22">Table22</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table23" aria-expanded="false" aria-controls="table23">Table23</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table24" aria-expanded="false" aria-controls="table24">Table24</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table25" aria-expanded="false" aria-controls="table25">Table25</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table26" aria-expanded="false" aria-controls="table26">Table26</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table27" aria-expanded="false" aria-controls="table27">Table27</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table28" aria-expanded="false" aria-controls="table28">Table28</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table29" aria-expanded="false" aria-controls="table29">Table29</button>               
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#table30" aria-expanded="false" aria-controls="table30">Table30</button>          
                </p>
                <div class="row">
                    <div class="collapse multi-collapse" id="table1">
                        <div class="card card-body">
                           
                        </div>
                    </div>
                </div>
                </form>                      
            </div>  
        </div>
    </div>

    <?php include './public/sub/footer.php'; ?>
</body>
</html>