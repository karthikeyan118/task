<?php
include_once("./lib/user.php");
// connection script
include_once('./lib/connect.php');
include_once("./lib/helper.php");
include "header.php";
include "nav.php"; 
?>              
<div class="container">
<div class="rectangle rect2"> 
 <?php 
$searchValue = $_POST['SearchValue'];
$errors = array();
$errors = searchError($searchValue,$errors);

 if (isset($errors['SearchValue'])) echo $errors['SearchValue']; 

if(!$errors) {  
findVal($searchValue,$_SESSION['id']);
}
?>
 </div>
</div>
<?php include "footer.php"; ?>


