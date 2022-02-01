<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="./includes//js//pass.js"></script>
    <?php
    session_start();
    include('./config/config.php');




    if (isset($_POST['username'])) {

        $username = $_POST['username'];
        $pass = $_POST['password'];
        $conf = $_POST['confirm'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $check = mysqli_query($con, $sql);

        $sql1 = "SELECT * FROM `users` WHERE `user_name` = '$username'";
        $check1 = mysqli_query($con, $sql1);


        $filename = $_FILES['pic']['name'];
        $filenewname =  rand(0, 99999) . md5($filename) . $_FILES['pic']['name'];
        $filetmp = $_FILES['pic']['tmp_name'];
        $size =  $_FILES['pic']['size'];

        $un = array(
            '@',
            '#',
            '!'
        );


        if (empty($username) && empty($pass) && empty($conf) && empty($email)) {
            $msg['error'] = " Input Valid Information";
        } else {
            # code...

            if (
                strpos($username, "@") !== false &&
                strpos($username, "$") !== false &&
                strpos($username, "#") !== false
            ) {
                $msg['error'] = "Username must not Contain " . "@" . "$" . "#";
            } else {
                if ($size > 5242880) {

                    $msg['error'] = "File too Big " . $size;
                } else {

                    if (mysqli_num_rows($check1) > 0) {
                        $msg['error'] = "The Username " . $username . " is in use ";
                    } else {
                        # code...

                        if (mysqli_num_rows($check) > 0) {

                            $msg['error'] = "The email " . $email . " is in use ";
                        } else {
                            if ($pass == $conf) {

                                $str = rand();
                                $result = md5($str);
                                $verified = "0";
                                $user_id = rand(0,99999999999999);
                                $otp = rand(0, 99999);
                                $_SESSION['otp'] = $otp;
                                $conf1 = password_hash($conf, PASSWORD_BCRYPT);

                                $sql = "INSERT INTO `users`( `user_id`, `user_name`, `password`, `email`, `image`, `is_verified`, `is_pro`) 
                    VALUES ('$user_id','$username','$conf1','$email','$filenewname','$verified','$verified')";
                                $query = mysqli_query($con, $sql);

                                $location = "./uploads/pictures/" . $filenewname;

                                if ($query) {
                                    move_uploaded_file($filetmp, $location);
                                    $subject = "Webwonder Verification for " . $username;
                                    $body = '
                     <div style="width:100px; height:50px;  ">
                     <img src="https://emmanuelserver12398.000webhostapp.com/upload/uploads/2801221643387203logo.png">
                    <div>
                    <h1 >
                    Hello ' . $username . ' Your Verification Code is : <span style="color:light-green;" >' . $otp . '</span>
                    </h1>
                    <p>Thanks For Joining The community</p>
                    
                    
                    </div>

                     </div>
                     ';
                                    mailer($email, $subject, $body);
                                    echo ("<script>opener();</script>");
                                }
                            } else {
                                $msg['error'] = "Psswords Do Not Match ";
                            }
                        }
                    }
                }
            }
        }
    }

    if (isset($_POST['code'])) {
     $code = mysqli_real_escape_string($con , $_POST['code']);
if ($code == $_SESSION['otp']) {
   
    $sql =  "UPDATE `users` SET `is_verified`= '1' WHERE `user_id` = '$user_id'";
    mysqli_query($con,$sql);
 
    header('location: login');
}else {
    $msg['error'] = "Otp Code Incorrect";
}
    }




    ?>
    </script>
    <link rel="stylesheet" href="<?php echo ($css); ?>">
    <title><?php
            echo ($name);
            ?> Signup</title>
    <link rel="stylesheet" href="./includes/css/index.css">
    <?php echo($css1);?>
</head>

<nav class="">

    <ul class="  w3-navbar w3-border w3-light-blue">
        <li><a href="./" class="">
                <img src="./includes/images//logo.png" alt="" style=" width:70px;">
            </a></li>
        <ul class="w3-container www">
            <li><a class="w3-hover-red" href="#">Home</a></li>
            <li><a class="w3-hover-blue" href="#">Link 1</a></li>
            <li><a class="w3-hover-green" href="#">Link 2</a></li>
            <li><a class="w3-hover-teal" href="#">Link 3</a></li>
        </ul>

    </ul>

</nav>


<div class="w3-container  w3-card-4  w3-light-grey w3-round-xxlarge signup w3-animate-zoom w3-hover-shadow  ">
    <header class="w3-container w3-center w3-">
        <h2 class="w3-text-blue">Signup</h2>
        <div class="w3-container">

        </div>
    </header>

    <form action="" method="POST" class="w3-container form" enctype="multipart/form-data" onsubmit="opener()">

        <div class="w3-container error w3-pale-red w3-leftbar w3-border-red">
            <?php
            if (isset($msg['error'])) {
                # code...

            ?><p class="w3-text-red"><?php echo $msg['error']; ?></p>
                </p><?php } ?></div>
        <div class="w3-container w3-pale-green w3-leftbar w3-border-green">
            <?php
            if (isset($msg['success'])) {
                # code...S

            ?><p class="w3-text-green"><?php echo $msg['success']; ?></p>
                </p><?php } ?></div>

        <label for="" class="w3-label">Username</label>
        <input type="text" name="username" id="" class="w3-input" required>
        <label for="" class="w3-label">Email</label>
        <input type="email" name="email" id="" class="w3-input" autocomplete="off" required>
        <label for="" class="w3-label">Password</label><i class="fa fa-eye " onclick="togle()" id="eye" aria-hidden="true"></i>
        <input type="password" name="password" id="pass" class="w3-input" required>
        <label for="" class="w3-label">Password Confirm</label><i class="fa fa-eye " onclick="toggle()" id="eyeq" aria-hidden="true"></i>
        <input type="password" name="confirm" id="passw" class="w3-input" required>

        <input type="file" name="pic" accept=".png,.jpg,.jpeg,.gif" class="w3-input file" id="actual-btn" hidden required />

       
        <div class="">
            <button type="submit" class="w3-btn btn" style="margin-top: 15px;"> Signup
            </button>


        </div>
        <?php
        if (isset($_SESSION['otp'])) {



        ?>
            <div class=" w3-teal nexter">
                <button class="w3-btn w3-teal" type="button" onclick="opener()">Next</button><i class="fa fa-hand-o-right fa-3" aria-hidden="true"></i>
            </div>
        <?php     } ?>
    </form>

</div>

<div class="pop w3-container ">
    <div class=" w3-pale-green   w3-center w3-leftbar w3-border-green" style="width: 500px;">
        <h2 class="w3-text-blue">A Verification email has been sent to your inbox</h2>
    </div>
    <form action="" class="w3-container  verify w3-light-grey w3-round-xxlarge w3-animate-zoom w3-hover-shadow" method="post" autocomplete="off">
        <br>
        <label for="code" class="w3-label">Verification Code</label>
        <br>

        <input type="password" name="code" id="code" class="w3-input" required>
        <br>
        <button type="submit" class="w3-btn w3-teal" style="margin-top: 10px;">Verify</button>

    </form>
</div>



<body>
 <!--<script src="./includes//js/signup.js"> 

    </script> -->

</body>

</html>