<?php
// function to get date
function formatDate($date) {    
    return date( 'd-m-Y', strtotime($date));
}
// function for tasks
function taskBox($record,$page) {
    $result = "";
    if($record["photo"] == null) { 
        $result .= " <div class='body_img profile__peter'>
        <div>
            <img src=./assets/te1.jpg class='profile' />
        </div>";
        }else {
            $result .= "<div class='body_img profile__peter'>
            <div>
                <img src=./assets/".$record["photo"]." class='profile' />
            </div>";
        }
        $result .= "<div class='img_text'>
      <p class='user-name'>".ucfirst($record["username"])."</p>
      <h3 class='date'>".formatDate($record["created_at"])."</h3>  
    </div>
    <div class='title grow'>";
    if($page == "mytask"){
      $result .= "<p class='t-para'>".ucfirst($record["title"])."<span class='stat__update'>".$record["status"]."</span></p>";
    } else {
        $result .= "<p class='t-para'>".ucfirst($record["title"])."</p>";
    }
     $result.=" <textarea readonly class='textarea textarea__task' name='content'> ".$record["description"]."</textarea>
      <div class='button'>";     
      if($page == "mytask") {          
        $result .= "<a href='delete.php?task=".$record["id"]."' class='comment__submit btn btn-green'>Delete</a>        
      <a href='edit.php?task=".$record["id"]."' class='btn btn-green'>Edit</a>
        <a href='commentj.php?task=".$record["id"]."' class='btn'>Reply</a>        
        </div>
    </div>
    </div>";
      } else { 
        if($record['status'] == 'inprogress'){
            $result .= " <a href='status.php?tasknum=".$record["id"]."&status=completed' class='btn dull'>inprogress</a>";
          }   else {
            $result .= " <a href='status.php?tasknum=".$record["id"]."&status=inprogress' class='btn bright'>completed</a>"; 
          }         
        $result .= " <a href='view.php?task=".$record["id"]."' class='btn'>view</a>
        <a href='commentj.php?task=".$record["id"]."' class='btn right-move'>Reply</a>      
      </div>
    </div>
    </div>";
      } 
      return $result;
    }
// function for users
function userBox($record){
$result = "";
if($record["photo"] == null) { 
    $result .=  " <div class='body_img profile__peter'id='body_img'>
    <div id='user_img'>
      <img src=./assets/te1.jpg class='profile' />
    </div>";
      }else{
        $result .= "<div class='body_img profile__peter'id='body_img'>
        <div id='user_img'>
          <img src=./assets/".$record["photo"]." class='profile' />
        </div>";
      }
    $result .= "<div class='title' id='title'>
    <div class ='move__left'>
      <p class='t-para'>".ucfirst($record["username"])."</p>
      <p class='t-para d-para'>
      ".formatDate($record["created_at"])."
      </p>
      </div>
      <div class='button'>
      <a href='addtask.php?taskname=".$record['username']."' class='comment__submit btn btn-green'>Add task</a>  
      </div>
    </div>
    </div>";
    return $result;
    }
