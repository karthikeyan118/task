<?php
include_once("./lib/user.php");
// connection script
include_once('./lib/connect.php');
include_once("./lib/helper.php");
include "header.php";
include "nav.php";
?>      
  <form class="form--mytask" method="post" action="mytask.php">   
    <div class="container">
      <div class="rectangle rect2">     
<?php
myLists($_SESSION['id']);
?>
      </div>
    </div>
</form>
<?php include "footer.php"; ?>