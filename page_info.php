<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION) || (!isset($_SESSION['name'])) || empty($_SESSION['name'])) {
    header("Location: ./page_login.php");
    exit();
} 
?>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/style/main-svg.css">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <link rel="stylesheet" href="./public/style/person_info.css">
    <!-- Core CSS file -->
    <!-- <link rel="stylesheet" href="path/to/photoswipe.css"> -->
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

</head>

<body>
    <?php
        //Read info from database
        include('database.php');

        function generateRandomString($length = 18)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        $name=$_SESSION['name'];
        $user_info = $con->query("select * from users where display_name='$name';")->fetch_assoc();
        $email=$user_info['email'];

        $tickets_info = $con->query("select * from dinner where email='$email';");
        $tickets = array();
        $count = $tickets_info->num_rows;
        while ($ticket_info=$tickets_info->fetch_assoc()) {
            // $count = $count+1;
            $ticket = array(
                "num"=>$ticket_info['ticket_num'],
                "name"=>$ticket_info['display_name'],
                "first_name"=>$ticket_info['first_name'],
                "last_name"=>$ticket_info['last_name'],
                "food"=>$ticket_info['food'],
                "table_num"=>$ticket_info['table_num'],
                "drinking"=>$ticket_info['is_drinking_ticket'],
                "bus_depart"=>$ticket_info['bus_depart'],
                "bus_return"=>$ticket_info['bus_return'],
            );
            $tickets[] = $ticket;
            // array_push($tickets, $ticket);
        }
        

        $TITLE="tickets";
        include "./public/sub/header.php";
        $con->close();

    ?> 
    <div id="test-body">
        <!-- <div class="background-image"></div> -->

        <div class="wrapper content container">
            <div class="container alert alert-primary card p-4 shadow-lg mb-5 rounded" id='info-card'>
            <p class="alert alert-success">
                <?php
                    echo "Hi, $name <br>< $email ><br>";
                    echo "You have ".$count. " tickets. <a href='https://www.facebook.com/events/2243691382586401/' target=\" _blank \">Buy ticket(ONLY A FEW LEFT!)</a><br>";   //.count($tickets);
                ?>            
            <?php
                if (isset($_SESSION['update'])) {
            ?>
            <script>
                $(window).on('load', function(){        
                    $('#myModal').modal('show');
                }); 
            </script>
            <!-- Modal -->
            <div class="modal in fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="aModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content alert <?php echo $_SESSION['update'] == "suc" ? "" : "alert-danger" ?>">
                    <div class="modal-header alert  <?php echo $_SESSION['update'] == "suc" ? "" : "alert-danger" ?>">
                        <h5 class="modal-title" id="aModalLabel"> <?php echo $_SESSION['update'] == "suc"?"Great Success":"Huge Failure" ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                                switch ($_SESSION['update']) {
                                    case "unfill":
                                        echo "You have unfiled input(s)";
                                        break;
                                    case "tablefull":
                                        echo "The table is full";
                                        break;
                                    case "returnfull":
                                        echo "The return bus is full";
                                        break;
                                    case "departfull":
                                        echo "The depart bus is full";
                                        break;
                                    case "suc":
                                        echo "Updated Successfully!";
                                        break;
                                    default:
                                        echo "Unexpected Error about ".$_GET['error'];
                                }
                                $_SESSION['update'] = null;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            <div class="row">
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php
                            for ($i=0; $i<$count; $i++) {
                                $ac = ($i==0)?"active":"";
                                $id = $tickets[$i]['num'];
                                $id_text = "Ticket #".$id;

                                echo "<a class='nav-link $ac tab-btn' id='v-pills-tab-$id' data-toggle='pill' href='#v-pills-$id' role='tab' aria-controls='v-pills-$id' aria-selected='true'>
                                <i class='fas fa-ticket-alt'></i>&nbsp&nbsp$id_text</a>";
                            }
                        ?>
                    <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> -->
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <?php
                            for ($i=0; $i<$count; $i++) {
                                $ac = ($i==0)?"active":"";
                                $ticket = $tickets[$i];
                                $id = $ticket['num'];
                                $id_text = "Ticket #".$id;
                                $value = generateRandomString();
                                $_SESSION["tid".$value] = $i;
                                $_SESSION["tk"."$i"] = $id;
                                
                                echo "<div class='tab-pane fade show $ac card' id='v-pills-$id' role='tabpanel' aria-labelledby='v-pills-tab-$id'>";
                                echo "<form class='form' name='changeForm' role='form' action='./info_change.php?tid=$value' method='POST'>";

                                echo "<div class='input-group flex-nowrap'><div class='input-group-prepend'>";
                                echo "<div class='input-group-text form-text' id='addon-wrapping'>Display Name</div ></div>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='*Display Name' name='name'
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['name']."'></div>";
                                // echo "<p>Display Name: ".$ticket['name']."</p>";

                                echo "<div class='input-group flex-nowrap'>";
                                // echo "<span class='input-group-text' id='addon-wrapping'>First Name</span></div>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='*First Name' name='first'
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['first_name']."'>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='*Last Name' name='last'
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['last_name']."'></div>";
                                // echo "<p>First Name: ".$ticket['first_name']."</p>";
                                // echo "<p>Last Name: ".$ticket['last_name']."</p>";

                                echo "<div class='input-group flex-nowrap'><div class='input-group-prepend'>";
                                echo "<span class='input-group-text form-text' id='addon-wrapping'>Ticket Number</span></div>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='Ticket Number' disabled
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['num']."'></div>";
                                // echo "<div disabled value=".$ticket['num'].">";
                                // echo "<span class='input-group-text' id='addon-wrapping'>Ticket Number</span>".$ticket['num']."</div>";




                                echo "<div class='input-group flex-nowrap table-div' id='table-div'><div class='input-group-prepend'>";
                                echo "<span class='input-group-text form-text' id='addon-wrapping'>Table Number
                                <a data-fancybox=\" gallery \" href=\"./public/pic/newevent.jpg \">&nbsp&nbsp<i class=\" fas fa-utensils \"></i></a></span></div>";
                                echo "<input id='table-input-$i' type='number' class='form-control form-input table-input disabled-input' placeholder='*Table Number (from 1 to 30)' name='table'
                                aria-label='Username' aria-describedby='addon-wrapping' max='30' min='1' title='Only 1 to 30 allowed'
                                value='".$ticket['table_num']. "'>
                                </div>";
                                // echo "<p>table_num: ".$ticket['table_num']."</p>";

                                ?>
                                
                                <div class="card inv inv-all" id="table-card-<?php echo $i ?>" >
                                    <div class="card-body">
                                        <div class="row justify-content-between mb-2" style="height:6vh">
                                            <p class="h5 card-title col-4 align-middle text-center card-title-me" id="card-title-<?php echo $i ?>">Name list @ </p>
                                            <div class="col-1"></div>
                                            <div class="align-middle text-center badge badge-pill badge-light col-3 card-badge" id="card-badge-<?php echo $i ?>">
                                                <p class='h5 align-middle text-center card-label' id="card-label-<?php echo $i ?>">
                                                    <i class="fas fa-users "></i>Test</p>
                                            </div>
                                            <div class="col-1 card-close" id="card-close-<?php echo $i ?>"><i class="fas fa-times-circle"></i></div>
                                        </div>

                                        <p class="card-text mt-2 card-info row justify-content-center" id="card-info-<?php echo $i ?>">Text</p>
                                        <p class="text-right m-1 text-light">
                                            Change Table Number to see names at other tables&nbsp&nbsp
                                            <a data-fancybox="gallery" href="./public/pic/newevent.jpg"><i class="fas fa-utensils"></i>&nbsp&nbspSee Map</a></p>
                                        <!-- <a href="#" class="card-link">Card link</a> -->
                                        <!-- <a href="#" class="card-link">Another link</a> -->
                                    </div>
                                </div>
                                <?php

                                echo "<div class='input-group flex-nowrap'><div class='input-group-prepend'>";
                                echo "<span class='input-group-text form-text' id='addon-wrapping'>Food Preference</span></div>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='*Food Preference / allergies' name='food'
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['food']."'></div>";
                                // echo "<p>Food: ".$ticket['food']."</p>";

                                echo "<div class='input-group flex-nowrap'>";
                                echo "<input disabled type='text' class='form-control form-input disabled-input' placeholder='Ticket Number' disabled
                                aria-label='Username' aria-describedby='addon-wrapping' value='".$ticket['drinking']."'></div>";
                                // echo "<p>Drinking: ".$ticket['drinking']."</p>";

                                echo "<div class='input-group flex-nowrap'><div class='input-group-prepend'>";
                                echo "<span class='input-group-text form-text' id='addon-wrapping'>Bus(Optional)</span></div>";
                                echo "<input type='number' class='form-control form-input disabled-input' placeholder='Depart #' name='depart' disabled
                                aria-label='Username' aria-describedby='addon-wrapping' max='5' min='1' title='Only 1 to 7 allowed'
                                value='".$ticket['bus_depart']."'>";
                                echo "<input type='number' class='form-control form-input disabled-input' placeholder='Return #' name='return' disabled
                                aria-label='Username' aria-describedby='addon-wrapping' max='5' min='1' title='Only 1 to 7 allowed'
                                value='".$ticket['bus_return']."'></div>";
                                // echo "<p>Bus Depart: ".$ticket['bus_depart']."</p>";
                                // echo "<p>Bus Return: ".$ticket['bus_return']."</p>";
                                ?>
                                
                                <div class="card " >
                                    <div class="table-body">
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class='th'>#</th>
                                                    <th scope="col" class='th'>Depart</th>
                                                    <th scope="col" class='th'>Return</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class='th'>1</th>
                                                    <td class='td'>5:45PM</td>
                                                    <td class='td'>11:30PM</td>
                                                </tr>
                                                    <tr>
                                                    <th scope="row" class='th'>2</th>
                                                    <td class='td'>6:00PM</td>
                                                    <td class='td'>12:00AM</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class='th'>3</th>
                                                    <td class='td'>6:15PM</td>
                                                    <td class='td'>12:30AM</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class='th'>4</th>
                                                    <td class='td'>6:30PM</td>
                                                    <td class='td'>12:40AM</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class='th'>5</th>
                                                    <td class='td'>6:45PM</td>
                                                    <td class='td'>1:15AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                // echo "<div class='input-group flex-nowrap'>";
                                // echo "<input type='text' class='form-control form-input' placeholder='Leave us a message (if you wish)' name='comment'
                                // aria-label='Username' aria-describedby='addon-wrapping''></div>";
                                echo "<br>";
                                
                                ?>
                                <button class="btn btn-outline-success btn-custom" type="submit" name="change" disabled>
                                    <i class="far fa-eye"></i>&nbsp&nbspView Only</button>
                                    <div class='text-center text-light'><i class="fas fa-star-of-life"></i>&nbspStop <span class='text-danger'>UPDATING</span> at 6PM &nbspFeb 4th</div>
                                <?php
                                echo "</form>";
                                echo "</div>";
                            }
                            include "./public/sub/bus-info.php";
                        ?>
                        
                        <script>
                            // console.log(depart_bus);
                            tables = [[]] //store all tables info
                            <?php
                                //load table info
                                //Read info from database
                                include('database.php');
                                for ($i = 1; $i <= 30; $i ++) {
                                    $table = $con->query("select * from dinner where table_num='$i';");
                                    echo "table = [];";
                                    while($indiv = $table->fetch_assoc()) {
                                        echo "table.push('".$indiv['display_name']."');";
                                    }
                                    echo "tables.push(table);";
                                }
                                $con->close();
                            ?>
                            // console.log(tables)    

                            <?php
                                for ($i=0; $i < $count; $i++) {
                                    // include 'table_limit.php';
                            ?>
                                id = $("#table-input-<?php echo $i ?>").val();
                                $("#card-badge-<?php echo $i ?>").removeClass()
                                $("#card-badge-<?php echo $i ?>").addClass("align-middle text-center badge badge-pill col-3 p-0 m-0 card-badge")
                                $("#card-title-<?php echo $i ?>").text("Name List @ " + id);
                                if (parseInt(id).toString() == 'NaN' || parseInt(id) > 30 || parseInt(id) < 1) {
                                    //Not a number
                                    $("#card-label-<?php echo $i ?>").text("NaN");
                                    $("#card-info-<?php echo $i ?>").text("Invalid input");
                                } else {
                                    //Is a number
                                    nid = parseInt(id)
                                    table = tables[nid]
                                    $("#card-label-<?php echo $i ?>").html("<i class=\"fas fa-users \"></i>&nbsp"+table.length)

                                    $("#card-badge-<?php echo $i ?>").removeClass("badge-dark");
                                    if (table.length <= 3) 
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-success")
                                    else if (table.length <= 4)
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-info")
                                    else if (table.length <= 6)
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-primary")
                                    else if (table.length <= 8)
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-warning")
                                    else if (table.length < 10)
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-danger")
                                    else if (table.length == 10)
                                        $("#card-badge-<?php echo $i ?>").addClass("badge-secondary")
                                    info = ""
                                    table.forEach(element => {
                                        if (element == "")
                                            info = info + "<span class=\" badge badge-primary ml-1 mb-2 py-2\">&nbspNoName&nbsp</span>"
                                        else 
                                            info = info + "<span class=\" badge badge-primary ml-1 mb-2 py-2 \">&nbsp"+element+"&nbsp</span>"
                                    });
                                    $("#card-info-<?php echo $i ?>").html(info);
                                }

                                $("#table-card-<?php echo $i ?>").removeClass('inv-all')
                                setTimeout(() => {
                                    $("#table-card-<?php echo $i ?>").removeClass('inv')
                                }, 300)
                                console.log("value=",$("#table-input-<?php echo $i ?>").val())

                                $('#table-input-<?php echo $i ?>').change(function(val){
                                    id = $("#table-input-<?php echo $i ?>").val();
                                    $("#card-badge-<?php echo $i ?>").removeClass()
                                    $("#card-badge-<?php echo $i ?>").addClass("align-middle text-center badge badge-pill col-3 p-0 m-0 card-badge")
                                    $("#card-title-<?php echo $i ?>").text("Name List @ " + id);
                                    if (parseInt(id).toString() == 'NaN' || parseInt(id) > 30 || parseInt(id) < 1) {
                                        //Not a number
                                        $("#card-label-<?php echo $i ?>").text("NaN");
                                        $("#card-info-<?php echo $i ?>").text("Invalid input");
                                    } else {
                                        //Is a number
                                        nid = parseInt(id)
                                        table = tables[nid]
                                        $("#card-label-<?php echo $i ?>").html("<i class=\"fas fa-users \"></i>&nbsp"+table.length)

                                        $("#card-badge-<?php echo $i ?>").removeClass("badge-dark");
                                        if (table.length <= 3) 
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-success")
                                        else if (table.length <= 4)
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-info")
                                        else if (table.length <= 6)
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-primary")
                                        else if (table.length <= 8)
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-warning")
                                        else if (table.length < 10)
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-danger")
                                        else if (table.length == 10)
                                            $("#card-badge-<?php echo $i ?>").addClass("badge-secondary")
                                        info = ""
                                        table.forEach(element => {
                                            if (element == "")
                                                info = info + "<span class=\" badge badge-primary ml-1 mb-2 py-2\">&nbspNoName&nbsp</span>"
                                            else 
                                                info = info + "<span class=\" badge badge-primary ml-1 mb-2 py-2 \">&nbsp"+element+"&nbsp</span>"
                                        });
                                        $("#card-info-<?php echo $i ?>").html(info);
                                    }

                                    $("#table-card-<?php echo $i ?>").removeClass('inv-all')
                                    setTimeout(() => {
                                        $("#table-card-<?php echo $i ?>").removeClass('inv')
                                    }, 300)
                                    console.log("value=",$("#table-input-<?php echo $i ?>").val())
                                })

                                $('#card-close-<?php echo $i ?>').click(function(val){
                                    $("#table-card-<?php echo $i ?>").addClass('inv')
                                    setTimeout(() => {
                                        $("#table-card-<?php echo $i ?>").addClass('inv-all')
                                    }, 300)
                                })
                            <?php } ?>
                        </script>
                    </div>
                </div>
            </div>
           
        </div>                
    </div> 

    <?php include './public/sub/footer.php'; ?>
    <script>
    window.scrollTo(0, 1);
    </script>
</body>