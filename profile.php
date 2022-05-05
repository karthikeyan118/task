<?php
include_once("./lib/user.php");
include_once('./lib/connect.php');
if(isset($_POST['Upload'])) {
 $file = $_FILES['File'];
 $fileName = $_FILES['File']['name'];
 $fileTmpName = $_FILES['File']['tmp_name'];
 $filesize = $_FILES['File']['size'];
 $filetype = $_FILES['File']['type'];
 $fileError = $_FILES['File']['error']; 
 $fileExt = explode(".",$fileName);
 $fileActualExt = strtolower(end($fileExt));
 $allowed = array('jpg','jpeg','png','pdf');
 $errors = array();
 if(!in_array($fileActualExt,$allowed)){
  $errors['File'] = 'you cannot upload files of this type!';
}
if($filesize > 200000){
  $errors['File'] = 'your file is too large';
}
if($fileError !== 0){
  $errors['File'] = 'error in uploading';
}


if(!$errors) {
 $filenamenew = uniqid('',true).'.'.$fileActualExt;
  $fileDestination = "assets/".$filenamenew;
  move_uploaded_file($fileTmpName,$fileDestination); 
 $insert = addPic($_SESSION['id']);
$result = $insert->execute([$filenamenew]);
}
}
include "header.php";
include "nav.php";
 ?>     
    
<div class="user__profile">
      <div class="user__profilecenter">
        <div class="user__profilecenter1">
          <?php
$sql = showDetail($_SESSION['id']); 
$records = $sql->fetch(); 
if($records["photo"] == null) {
        echo" <div class='sub-1'>         
            <img src=./assets/te1.jpg class='imaage' alt='user with specs' />            
          </div>";  
} else {
  echo" <div class='sub-1'>         
  <img src=./assets/".$records["photo"]." class='imaage' alt='user with specs' />            
</div>"; 
}    
     echo"<div class='sub-2'>
            <h3>About Me</h3>
            <p class='about__para1'>A Lead UI Designer based in India</p>
            <p class='about__para2'>
              I design and develop services for customers of all sizes,
              specializing in creating stylish, modern websites, web services
              and online stores. My passion is to design digital user
              experiences through the bold interface and meaningful
              interactions.
            </p>
            <form class='img__upload' method='post' enctype = 'multipart/form-data' action='profile.php'>
            <p>Upload Image</p>
            <div id='flat__line'>
            <div>
            <input type='file' class='input-img' id='text-danger5' name='File' /><br/>
            <span class='text-danger'>";if(isset($errors['File'])) echo $errors['File'];echo"</span>
 </div>
            <div>
            <input type='submit' class='btn upload__btn' id='submit' name='Upload' value='Upload' />           
 </div>
</div>
</form>
            <div class='sub-3'>
              <div class='detail__one'>
                <p class='birth'>
                  Date of birth<span> / 24th april 1995</span>
                </p>
                <p class='birth'>Age<span> / 26</span></p>
                <p class='birth'>Residence<span> / india</span></p>
                <p class='birth'>Address<span> / bangalore</span></p>
              </div>
              <div class=detail__two>               
              <p class='birth'>E-Mail<span> / ".$records["email"]."</span></p>";
                ?>
                <p class="birth">Skype<span> / skype.0404</span></p>
                <p class="birth">Phone<span> / 75559743</span></p>
                <p class="birth">Projects<span> / 5</span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="sub__card">
                <h4>500</h4>
                <p>Happy Clients</p>
            </div>
            <div class="sub__card">
                <h4>150</h4>
                <p>Project Completed</p>
            </div>
            <div class="sub__card">
                <h4>850</h4>
                <p>Tasks</p>
            </div>
            <div class="sub__card">
                <h4>150</h4>
                <p>Telephonic Talk</p>
            </div>
        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>