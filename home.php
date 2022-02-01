<?php
session_start();
include('./config/config.php');

$user_data = check_login($con);

if (!isset($_SESSION['success'])) {
    header('location: ./login');
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['success']['user_id'])) {
                echo ("@" . $_SESSION['success']['user_name']  . " | " . $name);
            } else {
                echo ($name . "| ");
            }      ?></title>
            <link rel="stylesheet" href="<?php echo($css);?>">
            <link rel="stylesheet" href="./includes//css//index.css">
</head>

<body>
    <nav class="">

        <ul class="  w3-navbar w3-border w3-light-blue">
            <li><a href="./message" class="">
                    <img src="./uploads//pictures/<?php echo($user_data['image']) ?>" alt="" style=" width:70px;">
                </a></li>
            <ul class="w3-container www">
                <li><a class="w3-hover-red" href="./home">Home</a></li>
                <li><a class="w3-hover-blue" href="./profile">Profie</a></li>
                <li><a class="w3-hover-green" href="./chat">Chat</a></li>
                <li><a class="w3-hover-teal" href="./login">Login</a></li>
            </ul>

        </ul>

    </nav>

</body>

</html>