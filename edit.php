<?php
include_once("./lib/user.php");
// connection script
include_once('./lib/connect.php');
// edit proecss
include "header.php";
include "nav.php";
$taskId = $_REQUEST['task'];
$result = getId($taskId);
if(isset($_POST['update'])) {
 $title = $_POST['title'];
 $content = $_POST['content'];
$errors = array();
if(empty($title)){
  $errors['title'] = 'Title shoule not be empty';
}
if(empty($content)){
  $errors['content'] = 'Please enter description';
} else if(strlen($content) < 30 ) {
  $errors['content'] = 'content must contain atleast 30 letters';
}
if(!$errors) {  
 editTask($taskId,$title,$content);
  }
}
?>
<div class="rectangle rect--centre">
    <form method="post" action="edit.php?task=<?php echo $taskId; ?>" class="user__search">        
      <div class="user__heading">
        <div>           
          <?php while ($res = $result->fetch()) { ?>            
          <h3>Title</h3>
          <input type="text" name="title" value="<?php echo $res['title']; ?>" placeholder="Enter Title here.." /></br>
          <span class="text-danger"><?php if(isset($errors['title'])) echo $errors['title']; ?></span>
        </div>         
      </div>
      <div class="comment-container">
        <div class="comment">
          <div class="heading__comment">
            <h3>Write your comments here</h3>
          </div>
          <div class="body-content">
            <textarea class="textarea" name="content" placeholder="Comments..."><?php echo $res['description']; ?></textarea>
            <span class="text-danger"><?php if(isset($errors['content'])) echo $errors['content']; ?></span>
          </div>
          <div class="last-content bottom__gap">           
          <input type="submit" class="comment__submit btn" name="update" value="update">
          </div>
        </div>
      </div>
      <?php } ?>
</form>
    </div>
    <?php include "footer.php"; ?>  
   