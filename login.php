<?php
include_once("./lib/guest.php");
include_once('./lib/connect.php');
// login process
if(isset($_POST['Login'])) {
$name = $_POST['username'];
$password = $_POST['password'];
$pass_encrypt = md5($password);
$errors = array();
//validations
if(empty($name)) {
  $errors['username'] = 'username should not be empty';
}
if(empty($password)) {
  $errors['password'] = 'incorrect username/password';
}
if(!$errors) {
// calling function  
loggingIn($name,$pass_encrypt);
} 
$errors['password'] = 'incorrect username/password';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
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
    <div class="outer--blue">
    <div class="outer">
      <div class="txt_field">
        <div class="header">
          <h2 class="heading">Welcome Back!</h2>
          <p class="para">Sign in to continue minible.</p>
        </div>       
        <form method="POST" class="form">                  
        <div class="first-text">
            <p>Username</p>
            <input type="text" class="input" placeholder="Enter username" name="username" value="<?php  if(isset($name)) echo $name; ?>" />
            <span class="text-danger"><?php if(isset($errors['username'])) echo $errors['username']; ?></span>            

          </div>                 
          <div class="first-text">         
            <div class="forgot">
              <p class="danger__gap">Password</p>
              <a href="forgot.php" class="pass-link">Forgot Password?</a>
            </div>
            <input type="password" class="input" placeholder="Enter password" name="password" />
            <span class="text-danger"><?php if(isset($errors['password'])) echo $errors['password']; ?></span>

          </div>         
          <div class="form-check">
            <div>
            <input
            type="checkbox"
            class="form-check-input"
            id="check"
            value="check"
          />
</div>
<div>
          <label class="form-check-input">Remember Me</label>
</div>
        </div>    
          <div class="submit">
        <input type="submit" name="Login" value="Login" />
      </div>
        </form>       
        <div class="another-acc">
          <p class="two">Don't have an account?</p>
          <a href="register.php" class="link">SignUp Now</a>
        </div>
      </div>
      <div><p class="copy">&copy; 2022 minible crafted by Themesland.</p></div>
    </div>
</div>
  </body>
</html>
