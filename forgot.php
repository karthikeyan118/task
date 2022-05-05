<?php
session_start();
if(isset($_SESSION['username'])) {
    header('location:dashboard.php');
}
// connection script
include_once('./lib/connect.php');
if(isset($_POST['reset'])) {
  $email = $_POST['email'];
  $errors = array();
  if(empty($email)){
    $errors['email'] = 'Enter valid E-mail';
  }  
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>forgot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/normalize.css" />
  </head>
  <body>
    <div class="forgot__page">
    <div class="outer">
      <div class="txt_field">
        <div class="header">
          <h2 class="heading">Reset Password</h2>
          <p class="para">Reset password with minible.</p>
        </div>  
        <div class="instruct">
            <p>Enter your E-mail and code will be sent to you.</p>
        </div>  
        <form method="post" action="forgot.php" class="forgot-form">    
        <div class="user__heading">
          <div>
            <p class="forgot--heading">E-mail</p>
            <input type="email" name="email" class="forgot-mail" placeholder="enter E-mail.." /></br>
            <span class="text-danger"><?php if(isset($errors['email'])) echo $errors['email']; ?></span>
                 </div>         
        </div>
        <div class="last-content bottom__gap reset">           
            <input type="submit" class="comment__submit btn" name="reset" value="Reset"/>
            </div>
</form>
        <div class="another-acc">
          <p class="two">Remember It?</p>
          <a href="login.php" class="link">SignIn</a>
        </div>
      </div>
      <div><p class="copy">&copy; 2022 minible crafted by Themesland.</p></div>
    </div>
</div>
  </body>
</html>
