<?php
include_once("./lib/user.php");
// connection script
include_once('./lib/connect.php');
include "header.php";
include "nav.php";
$comment = $_REQUEST['task'];
$result = getTask($comment);
?>
    <div class="chat">
      <div class="chat__user">
        <div>
          <div class="single__user">         
        <?php while ($res = $result->fetch()) { ?>
         <div class="title-reply"> <?php echo $res['title'];?></div><br/>
        <textarea class="textarea description-para" name="descrip"> <?php echo $res['description'];?></textarea>
        <?php } ?>
          </div>           
          <?php
          if(isset($_POST['send'])) {
            $reply = $_POST['text'];
            $errors = array();
          $text = $_POST['text'];
          if(empty($text)) {
            $errors['text'] = 'Enter messge';
          }
          if(!$errors){          
             insertChat($comment,$reply,$_SESSION['id']);
           }           
          }
twoChat($comment,$_SESSION['id']);
?>
        </div>
        <div class="msg__box">      
          <form method="post" class="same-line">    
          <div class="long">
            <textarea              
              placeholder="Type Your Message Here..."
              class="msg__txtbox"
              name="text"
            ></textarea></br>
            <span class="text-danger mesg-danger"><?php if(isset($errors['text'])) echo $errors['text']; ?></span>
          </div> 
          <div class="msg__send">
          <input type="submit" class="btn" name="send" value="send">
        </div>  
</form>
</div>
      </div>
    </div>
    <?php include "footer.php"; ?>

