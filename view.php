<?php
include_once("./lib/user.php");
// connection script
include_once('./lib/connect.php');
if(isset($_POST['ok'])) {
    header ('location:dashboard.php');
}
include "header.php";
include "nav.php";
$taskId = $_REQUEST['task'];
$result = viewTask($taskId);
?>  
<form method="post">
    <div class="john">
      <p>Description</p>
      <div class="total__des">
        <h3>User Total Description</h3>
        <?php while ($res = $result->fetch()) { ?>
        <textarea class="textarea description-para" name="descrip" readonly><?php echo $res['description'];?></textarea>
        <?php } ?>
        <div>
        <input type="submit" name="ok" value="ok" class="btn btn__ok">
        </div>
      </div>
    </div>
</form>
<?php include "footer.php"; ?>
