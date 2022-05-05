<?php
include_once("./lib/user.php");
include_once('./lib/connect.php');
if(isset($_POST['add'])) {
// connection script

  $receiver = $_POST['receiver']; 
  $title = $_POST['title'];
  $content = $_POST['content'];
  $errors = array();
 // calling function 
$errors = mySelf($receiver,$errors); 
$errors = unKnown($receiver,$errors);
 // errors 
 if(empty($receiver)){
   $errors['receiver'] = 'Enter valid username/E-mail';
 }
 if(empty($title)){
   $errors['title'] = 'Title shoule not be empty';
 }
 if(empty($content)){
   $errors['content'] = 'Please enter description';
 }else if(strlen($content) < 20 ) {
   $errors['content'] = 'content must contain atleast 20 letters';
 }

 if(!$errors){  
  addTask($_SESSION['id'],$title,$content,$receiver);
 }  
}
 include "header.php";
 include "nav.php"; 
?>     
    <div class="rectangle rect--centre">     
      <form class="user__search" action="addtask.php" method="post">      
        <div class="user__heading">
          <div>
            <h3>Task to</h3>
            
            <input type="text" name="receiver"  value="<?php  if(isset($_REQUEST['taskname'])) echo $_REQUEST['taskname']; ?>" placeholder="Search by Username or E-mail.." /></br>
            
            <span class="text-danger"><?php if(isset($errors['receiver'])) echo $errors['receiver']; ?></span>
           
            <h3>Title</h3>
            <input type="text" name="title" placeholder="Enter Title here.." value="<?php if(isset($title)) echo $title; ?>" /></br>
            <span class="text-danger"><?php if(isset($errors['title'])) echo $errors['title']; ?></span>
          </div>         
        </div>
        <div class="comment-container">
          <div class="comment">
            <div class="heading__comment">
              <h3>Description</h3>
            </div>
            <div class="body-content">
              <textarea class="textarea" name="content" placeholder="Add description here.."><?php if(isset($content)) echo $content; ?></textarea></br>
              <span class="text-danger"><?php if(isset($errors['content'])) echo $errors['content']; ?></span>            
            </div>
            <div class="last-content bottom__gap addbutton">
              <input type="submit" class="comment__submit btn" name="add" value="add">
            </div>
          </div>
        </div>        
</form>
</div>
<?php include "footer.php"; ?>
   