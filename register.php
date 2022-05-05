<?php
include_once("./lib/guest.php");
// connection script
include_once('./lib/connect.php');
if(isset($_POST['Register'])){
  $name = $_POST['username'];
  $email = $_POST['email'];
  $user_password = $_POST['password'];
  $second_password = $_POST['passwordtwo'];  
  $passencrypt = md5($user_password);  
  $errors = array();
// validations
if(empty($name)){
  $errors['username'] = 'user name should not be empty';
}

if(empty($email)) {
  $errors['email'] = 'Enter valid email';
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = 'enter valid email';
}

if(empty($user_password)) {
  $errors['password'] = 'Enter password!';
}else if(strlen($user_password) < 5 ) {
  $errors['password'] = 'password must contain atleast 5 letters';
}

if($user_password !== $second_password) {
  $errors['password'] = 'passwords does not match';
}

if (!preg_match("/^[a-zA-z]*$/", $name)) {
  $errors['username'] = 'only alphabets and space allowed';
}
// function for username and email already exist or not
$errors = register($name,$email, $errors);
if(!$errors) {  
 insertVal($name,$email,$passencrypt); 
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>register</title>
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
      <div class="txt_field txt_fieldgap">        
        <div class="header">
          <h2 class="heading">Register Account</h2>
          <p class="para">Get your free Minible account Now.</p>
        </div>
        <form action="register.php" method="POST" enctype="multipart/form-data" class="form" id="myform1"> 
                  
        <div class="first-text">
            <p>Username</p>
            <input type="text" class="input" id="text-danger1" placeholder="Enter username" name="username" value="<?php  if(isset($name)) echo $name; ?>" />
            <span class="text-danger" id="t__d"><?php if(isset($errors['username'])) echo $errors['username']; ?></span>
          </div>
          <div class="first-text">
            <p class="danger__gap">Email</p>
            <input type="email" class="input" id="text-danger2" placeholder="Enter E-mail" name="email" value="<?php  if(isset($email)) echo $email;?>"/>
            <span class="text-danger" id="t__d1"><?php if(isset($errors['email'])) echo $errors['email']; ?></span>
          </div>         
          <div class="first-text">
            <p class="danger__gap">Password</p>
            <input type="password" class="input" id="text-danger3" placeholder="Enter password" name="password" />
            <span class="text-danger" id="t__d2"><?php if(isset($errors['password'])) echo $errors['password']; ?></span>
          </div>
          <div class="first-text">
            <p class="danger__gap">Re-Enter password</p>
            <input type="password" class="input" id="text-danger4" placeholder="Re-Enter password" name="passwordtwo" />
            <span class="text-danger" id="t__d3"><?php if(isset($errors['password'])) echo $errors['password']; ?></span>
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
          <label class="form-check-input">I accept terms and condition</label>
</div>
        </div>    
          <div class="submit">
        <input type="submit" id="submit" name="Register" value="Register" />
      </div>
        </form>         
                <div class="another-acc">
            <p class="two">Already have an account?</p>
            <a href="login.php" class="link">login</a>
          </div>       
</div>   
      <div><p class="copy">&copy; 2022 minible crafted by Themesland.</p></div>

    </div> 
</div>
</body>
</html>
