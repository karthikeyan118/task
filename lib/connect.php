<?php
function connectSql() {
$host = 'localhost';
$user = 'root';
$password = '135798438336612345';
$dbname = 'task_management';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
$pdo = new PDO($dsn,$user,$password);
$pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;
}
$pdo = connectSql();
//function for dashboard queries
function totalTasks(){   
    $pdo = connectSql();    
    $totalTask = $pdo->query("SELECT COUNT(*) FROM task");
    return $totalTask->fetchColumn();
}
function completedTasks($comp,$userId) {
    $pdo = connectSql();
    $getCompleted = $pdo->query("SELECT COUNT(*) FROM task WHERE status = '".$comp."' AND to_id='".$userId."'");
    return $getCompleted->fetchColumn();
}
function progressTasks($comp,$userId) {
    $pdo = connectSql();
    $getProgress = $pdo->query("SELECT COUNT(*) FROM task WHERE status = '".$comp."' AND to_id='".$userId."'");
    return $getProgress->fetchColumn();
}
function receivedTasks($userId) {
    $pdo = connectSql();
    $getReceived = $pdo->query("SELECT COUNT(*) FROM task WHERE to_id='".$userId."'");
    return $getReceived->fetchColumn();
}
function incomingTask($userId){
    $pdo = connectSql();
    $stmt = $pdo->query("SELECT t.id,u.username,t.created_at,t.title,t.description,t.status,u.photo FROM task t JOIN user u ON t.from_id = u.id WHERE to_id='".$userId."'");
    $records = $stmt->fetchAll();
    foreach($records as $row) {   
        echo taskBox($row,"dashboard");     
      }
      if(!$records) {
        echo "<p class='alert-dash'>sorry! no task assigned currently</p>";
    }
    return $records;
}
//functions for login queries
function loggingIn($name,$pin) {
$pdo = connectSql();
$sql = $pdo->query("SELECT * FROM user WHERE username = '".$name."' AND password='".$pin."' LIMIT 1");
$row = $sql->fetch();
if($row){ 
  $_SESSION['username'] = $row['username']; 
  $_SESSION['id'] = $row['id'];
  $_SESSION['password'] = $row['password'];  
  header ('location:dashboard.php');    
}
return $row;
}
//function for register validation
function register($name,$mail,$err){
$pdo = connectSql();
$qry = $pdo->query("SELECT * FROM user WHERE username = '".$name."' OR email = '".$mail."'");
$rows = $qry->fetchAll();
foreach($rows as $row) { 
  if($name ==  $row['username']) {
    $err['username'] = 'Username already taken!';
  }
  if($mail ==  $row['email'] ){
    $err['email'] = 'email already taken!';
  }
}
return $err;
}
// function to insert user details
function insertVal($name,$mail,$pin){
$pdo = connectSql();
$sql ="INSERT INTO user(username,email,password) VALUES(?,?,?)";
 $insert = $pdo->prepare($sql);
 $result = $insert->execute([$name,$mail,$pin]); 
 $_SESSION['id'] = $pdo->lastInsertId(); 
 $_SESSION['username'] = $name;
 header('location:dashboard.php');
 return $result;
}
// function for add task
function mySelf($name,$err) {
    $pdo = connectSql();
    $qrys=$pdo->query("SELECT * FROM user WHERE username ='" .$name."'");
    $rows=$qrys->fetch();
    if($rows){      
      if($name == $_SESSION['username']) {
        $err['receiver'] = 'You cannot assign task yourself';
      }    
   }
   return $err;     
}

function unKnown($name,$err) {
    $pdo = connectSql();
    $unknown = $pdo->query("SELECT count(*) FROM user WHERE username ='" .$name."'");
  $row = $unknown->fetchColumn();
  if($row == 0) {    
      $err['receiver'] = 'unknown user!';    
}
return $err;
}
function addTask($id,$sub,$desc,$name) {
   $pdo = connectSql();
   $qry =  $pdo->query("SELECT * FROM user WHERE username ='" .$name."'");
   $rows=$qry->fetch();
   if($rows) {
    $sql ='INSERT INTO task(from_id,to_id,title,description) VALUES(?,?,?,?)';
    $insert = $pdo->prepare($sql);
    $result = $insert->execute([$id,$rows['id'],$sub,$desc]); 
    header ('location:mytask.php'); 
   }
    return $result;
   }
//function for mytask
function myLists($userId) {
$pdo = connectSql();
$sql = $pdo->query("SELECT t.id,u.username,t.status,t.created_at,t.title,t.description,u.photo FROM task t JOIN user u ON t.to_id = u.id WHERE from_id = '".$userId."'");
$records = $sql->fetchAll();
foreach ($records as $row ) {  
  echo taskbox($row,"mytask");
}
return $records;
}
//function for chat 
function getTask($des){
    $pdo = connectSql();
    $result = $pdo->query("SELECT * FROM task WHERE id ='".$des."' ");
return $result;
}
function insertChat($id,$comm,$commid){
    $pdo = connectSql();
    $sql ='INSERT INTO comment(task_id,user_comment,commenter_id) VALUES(?,?,?)';
            $insert = $pdo->prepare($sql);
            $results = $insert->execute([$id,$comm,$commid]);
}
function twoChat($des,$userid){
    $pdo = connectSql();
    $qry = $pdo->query("SELECT c.user_comment,c.commenter_id,u.photo FROM comment c join task t on t.id = c.task_id join user u on u.id = c.commenter_id WHERE c.task_id='" .$des."'");
while ($row = $qry->fetch()) {
if($userid == $row["commenter_id"]) {  
  echo " <div class='user__pic'>
  <div>   
    <img src=./assets/".$row["photo"]." class='chat__img' />
    <div>
    <textarea class='chat__area chat__area2' readonly>".$row["user_comment"]."</textarea>
    </div>
  </div>
</div>";
} elseif($userid != $row["commenter_id"]) {
echo "<div class='user__pic user__pic2'>
  <div>
    <div>
      <textarea class='chat__area' readonly>".$row["user_comment"]."</textarea>
    </div>
    <img src=./assets/".$row["photo"]." class='chat__img' />
  </div>
</div>";
}
}
}
// functions for edit task
function getId($id){
    $pdo = connectSql();
    $result = $pdo->query("SELECT title,description FROM task WHERE id='".$id."'");
return $result;
}
function editTask($id,$sub,$des){
    $pdo = connectSql();
    $sql = "UPDATE task SET title=?,description=? WHERE id ='".$id."'";
  $pdo->prepare($sql)->execute([$sub, $des]); 
 echo "<script>window.location.href='mytask.php';</script>";
}
//function for view
function viewTask($id){
    $pdo = connectSql();
    $result = $pdo->query("SELECT description FROM task WHERE id='".$id."'");
    return $result;
}
//function for users
function allUser($id){
    $pdo = connectSql();
    $allUsers = $pdo->query("SELECT * FROM user WHERE id !='".$id."'");
$records = $allUsers->fetchAll();
foreach ($records as $row ) {
  echo userBox($row);
}
}
//function for search
function searchError($val,$err){
    $pdo = connectSql();
    $qry = $pdo->query("SELECT title FROM task WHERE title = '".$val."'");
$rowValue = $qry->fetchColumn();
    if($val != $rowValue) {
  $err['SearchValue'] = "<p class='title--err'>Title is no match!</p>";  
}
return $err;
}
function findVal($val,$id){
    $pdo = connectSql();
    $sql =  $pdo->query("SELECT t.id,t.from_id,u.username,t.status,t.created_at,t.title,t.description,u.photo FROM task t JOIN user u ON t.to_id = u.id WHERE title LIKE '%".$val."%'");
    $records = $sql->fetchAll();    
    foreach ($records as $row ) { 
        if($id == $row["from_id"])   {
           echo taskBox($row,"mytask");
}
        if($id != $row["from_id"]) {
          echo taskBox($row,"search");
}
}
}
//functions for profile 
function addPic($id){
    $pdo = connectSql();   
  $userPhoto ="UPDATE user SET photo = ? WHERE id = '".$id."'";
 $insert = $pdo->prepare($userPhoto);
 return $insert;
}
function showDetail($id){
    $pdo = connectSql();    
    $sql = $pdo->query("SELECT photo,email FROM user WHERE id = '".$id."'");
    return $sql;
}
?>





