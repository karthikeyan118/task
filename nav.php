<?php
$searchValue = "";
if(isset($_REQUEST['SearchValue'])) {
$searchValue = $_REQUEST['SearchValue'];
}
?>
<div class="nav">
        <form class="menu-bar" name="myform" action="search.php" onsubmit="return validation()" id="my__form" method="post" >
            <div class="position_1">
                <img src="assets/minible.png" class="img1" />
            </div>
            <div class="search_border">
            <div class="position_3">                   
                        <svg class="icon icon--color">
                            <use xlink:href="assets/sprite (25).svg#search_black_24dp (3)"></use>
                        </svg>                   
                </div>
                <div class="position_2">
                    <input type="text" class="form-control" id="Searchvalue" name="SearchValue" value="<?php echo $searchValue;?>" placeholder="search task.." />
                </div>                
            </div>           
</form>
        <div class="position_two">
            <div class="widgets">
                <a href="#">
                    <svg class="icon widget icon--color">
                        <use xlink:href="assets/sprite (25).svg#widgets_black_24dp"></use>
                    </svg>
                </a>
            </div>
            <div class="widgets">
                <a href="#">
                    <svg class="icon widget icon--color">
                        <use xlink:href="assets/sprite (25).svg#home_black_24dp (1)"></use>
                    </svg>
                </a>
            </div>
            <div class="widgets">
                <a href="#">
                    <svg class="icon widget icon--color">
                        <use xlink:href="assets/sprite (25).svg#notifications_black_24dp"></use>
                    </svg>
                </a>
            </div>
            <div class="widgets imglink">                
                <a href="#" class="link" id="link">
                    <div class="horizontal">                        
                            <?php
                            $getPic = $pdo->query("SELECT photo FROM user WHERE id='".$_SESSION['id']."'");
                            $result = $getPic->fetch();
                            if($result["photo"] == null){
                            echo "<div class='h1'>
                            <img src=./assets/te1.jpg class='img2' />
                            </div>";
                            } else {
                                echo "<div class='h1'>
                            <img src=./assets/".$result["photo"]." class='img2' />
                            </div>";
                            }
                            ?>                        
                        <div class="h2">
                            <span class="word"><?php echo ucfirst($_SESSION['username']);?></span>
                        </div>
                        <div class="h3">
                            <svg class="icon widget icon-small">
                                <use xlink:href="assets/sprite (25).svg#arrow_drop_down_black_24dp (1)"></use>
                            </svg>
                        </div>
                    </div>
                </a>  
                </div>          
            <div class="widgets">
                <a href="#">
                    <svg class="icon widget last-icon icon--color">
                        <use xlink:href="assets/sprite (25).svg#settings_black_24dp (3)"></use>
                    </svg>
                </a>
            </div>
</div>            
</div>
    <div class="unorder">
        <div class="sub-menu-1" id="sub-menu-1">
            <div class="list_cont">
                <a href="profile.php" class="sub_link">
                    <div class="second-menu second-top">
                        <div class="menu-style">
                            <div class="ml">
                                <svg class="icon inner-icon">
                                    <use xlink:href="assets/sprite (26).svg#account_circle_black_24dp (1)"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="inner-para">View Profile</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="list_cont">
                <a href="addtask.php" class="sub_link sl3">
                    <div class="second-menu">
                        <div class="menu-style">
                            <div class="ml">
                                <svg class="icon inner-icon">
                                    <use xlink:href="assets/sprite (28).svg#add_task_black_24dp (1)"></use>
                                </svg>
                            </div>
                            <div class="add__task" id="collapsible">
                                <p class="inner-para">Add Task</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="list_cont">
                <a href="mytask.php" class="sub_link sl3">
                    <div class="second-menu">
                        <div class="menu-style">
                            <div class="ml">
                                <svg class="icon inner-icon">
                                    <use xlink:href="assets/sprite (27).svg#task_black_24dp"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="inner-para">My Task</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="list_cont">
                <a href="dashboard.php" class="sub_link sl3">
                    <div class="second-menu">
                        <div class="menu-style">
                            <div class="ml">
                                <svg class="icon inner-icon">
                                    <use xlink:href="assets/sprite (27).svg#task_black_24dp"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="inner-para">Dashboard</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="list_cont">
                <a href="logout.php" class="sub_link sl4">
                    <div class="second-menu">
                        <div class="menu-style">
                            <div class="ml">
                                <svg class="icon inner-icon">
                                    <use xlink:href="assets/sprite (26).svg#logout_black_24dp"></use>
                                </svg>
                            </div>
                            <div>
                            <p class="inner-para">logout</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
</div>

