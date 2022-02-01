<?php
session_start();
include('./config/config.php');
if (!isset($_SESSION['success'])) {
  header("location: login");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/rtis/style.css">
  <title> <?php
          echo ($name);
          ?> | Chat</title>
</head>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($con, $_GET['user']);
        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `user_id` = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
        echo("User Not Found");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="/rtis/uploads//pictures/<?php echo $row['image']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['user_name'] . " " . $row['name'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="/rtis/includes//js//chat.js"></script>
</body>

</html>