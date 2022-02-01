<?php
session_start();
include('./config/config.php');

$user = $_GET['name'];


$sql = "SELECT  * FROM `users` WHERE `user_name` = '$user'";

$check = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($check);

$user_data = check_login($con);











?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($css); ?>">
    <link rel="stylesheet" href="./includes//css//user.css">
    <link rel="stylesheet" href="./includes//css//index.css">
    <title><?php
            echo ("@" . $user);
            ?></title>
</head>

<body>
    <?php


    if (mysqli_num_rows($check) < 1) {


        echo ($sorry);
    }
    ?>
    <nav class="">

        <ul class="  w3-navbar w3-border w3-light-blue">
            <li><a href="./" class="">
                    <img src="./includes/images//logo.png" alt="" style=" width:70px;">
                </a></li>
            <ul class="w3-container www">
                <li><a class="w3-hover-red" href="./home">Home</a></li>
                <li><a class="w3-hover-blue" href="./profile">Profie</a></li>
                <li><a class="w3-hover-green" href="./chat">Chat</a></li>
                <li><a class="w3-hover-teal" href="./logout">Logout</a></li>
            </ul>

        </ul>

    </nav>
    <div class="w3-container"><img class="w3-hover-shadow  back  " src="./uploads//pictures/<?php echo ($row['background']) ?>" alt="">
        <div class="w3-display-topleft w3-container d">
            <div class="w3-dropdown-hover ">
                <button class="w3-btn w3-red">Hover Me!</button>
                <div class="w3-dropdown-content w3-border">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
        </div>

    </div>
    <div class="w3-container w3-center firt">
        <img src="./uploads/pictures/<?php echo ($row['image']) ?>" class="w3-image  w3-round-xlarge " style="width:100px; height:100px;  border-radius: 50%;" alt="./uploads/pictures/9939315614239bfb6be2b4a1459bdd0f92e52incognito.png">
        <div class="w3-container">
            <h2 class="w3-text-white"><?php echo ($row['user_name']) ?></h2>
        </div>
    </div>


</body>

</html>