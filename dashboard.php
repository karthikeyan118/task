<?php
include_once("./lib/user.php");
// connection script
include_once("./lib/connect.php");
include_once('./lib/helper.php');
include "header.php";
include "nav.php";
?>    
    <p class="wel">Welcome back! Admin</p>
    <div class="status">
        <div class="t__user stat">
            <p>Total Task</p>
            <span><?php echo totalTasks(); ?></span>
        </div>
        <div class="t__task stat">
            <p>Received Task</p>
            <span><?php echo receivedTasks($_SESSION['id']);?></span>
        </div>
        <div class="t__pending stat">
            <p>Inprogress</p>
            <span><?php echo progressTasks('inprogress',$_SESSION['id']);?></span>
        </div>
        <div class="t__completed stat">
            <p>Completed Task</p>
            <span><?php echo completedTasks('completed',$_SESSION['id']);?></span>
        </div>
    </div>
    <div class="view__users">
        <a href="users.php" class="users--link btn">View total users</a>
</div>
    <div class="container">
        <div class="rectangle">           
<?php 
incomingTask($_SESSION['id']);
?>
</div>
</div>
<?php include "footer.php"; ?>
