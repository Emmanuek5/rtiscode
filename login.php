<?php
session_start();
include('./config/config.php');

if (isset($_POST['email'])) {

$email = $_POST['email'];
$password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $check = mysqli_query($con, $sql);
    

    if (mysqli_num_rows($check) < 1) {
   $msg['error'] = "User Does Not Exist";

    }else {
       
        $row = mysqli_fetch_assoc($check);
        $password1 = $row['password'];
        if ($row['is_verified'] == "0") {

            $otp = rand(0, 99999);
            $_SESSION['otp'] = $otp;
            $subject = "Webwonder Verification for " . $row['user_name'];
            $body = '
                     <div style="width:100px; height:50px;  ">
                     <img src="https://emmanuelserver12398.000webhostapp.com/upload/uploads/2801221643387203logo.png">
                    <div>
                    <h1 >
                    Hello ' . $row['user_name'] . ' Your Verification Code is : <span style="color:light-green;" >' . $otp . '</span>
                    </h1>
                    <p>Thanks For Joining The community</p>
                    
                    
                    </div>

                     </div>
                     ';
            mailer($email, $subject, $body);
            $msg['error'] = "You've Not Been Verified";


        
        }
        if (password_verify($password,$password1)) {
            $row1 = json_encode($row,JSON_PRETTY_PRINT); 
            $user_id = $row['user_id'];
        
            $_SESSION['success'] = $row;
            $sql = "UPDATE `users` SET `status`='online' WHERE `user_id` = '$user_id'";
            mysqli_query($con,$sql);
            header('location: home');
            

        }else {

            $msg['error']  = "Password Incorrect";
            
        }
    }




}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($css); ?>">
    <link rel="stylesheet" href="./includes//css//index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title><?php
            echo ($name);
            ?> | Login</title>
</head>

<body>
    <nav class="">

        <ul class="  w3-navbar w3-border w3-light-blue">
            <li><a href="./" class="">
                    <img src="./includes/images//logo.png" alt="" style=" width:70px;">
                </a></li>
            <ul class="w3-container www">
                <li><a class="w3-hover-red" href="./home">Home</a></li>
                 li>
                 li>
                <li><a class="w3-hover-green" href="./chat">Chat</a></li>

            </ul>

        </ul>

    </nav>
    <div class="w3-container  w3-card-4  w3-light-grey w3-round-xxlarge login w3-animate-zoom w3-hover-shadow">
        <header class="w3-container w3-center w3-">
            <h2 class="w3-text-blue">Login</h2>
            <div class="w3-container">

            </div>
        </header>
        <form action="" class="w3-container" method="post">
            <div class="w3-container w3-pale-red w3-leftbar w3-border-red">
                <?php
                if (isset($msg['error'])) {
                    # code...

                ?><p class="w3-text-red"><?php echo $msg['error']; ?></p>
                    </p><?php } ?></div>

            <label class="w3-label">Email</label>
            <input type="email" name="email" id="" class="w3-input" autocomplete="off" required>
            <label for="" class="w3-label">Password</label>
            <input type="password" name="password"  id="pass" class="w3-input" required><i class="fa fa-eye " onclick="togle()" id="eyeer" aria-hidden="true"></i>
            <input type="checkbox" class="w3-check" name="" id="re" >
            <label for="re" class="w3-label">Remember This Device</label>
            <br>
            <button type="submit" class="w3-btn w3-teal">Login</button>

            <p> <a href="./signup" rel="noopener noreferrer"><span class="w3-text-red">Signup</span></a></p>


        </form>
    </div>
    <script>
        var state = false;

        let form = document.querySelector("form");

        function togle() {
            let pass = document.querySelector("#eyeer")
            if (state) {
                document.getElementById("pass").setAttribute("type", "password");
                pass.classList.remove("blue")
                state = false;
            } else {
                document.getElementById("pass").setAttribute("type", "text");
                state = true;

                pass.classList.add("blue")
                state = true;
            }

        }
    </script>
</body>

</html>