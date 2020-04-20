<?php session_start();
if(!isset($_SESSION['user_info']['firstname'])){
  header('location: login.php');
}
if($_SESSION['user_info']['designation'] == 'Admin'){
  header('location: admin/admin_dashboard.php');
}

 ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>

    <body>

    <h2> WELCOME TO PATIENT DASHBOARD</h2>
    <p>
        <?php
            if(isset($_SESSION['success'])) {
                echo "<span style='color:green';>". $_SESSION['success']. "</span><br>";
                unset($_SESSION['success']);
            }
        ?>
    </p>

    <p> Name:<?php echo $_SESSION['user_info']['firstname']; echo ' ' .$_SESSION['user_info']['lastname']."<br>";?> </p>
    <p> Designation:<?php echo $_SESSION['user_info']['designation']."<br>"; ?> </p>
    <p> Registration Time: <?php echo  $_SESSION['user_info']['reg_time']."<br>"; ?> </p>
    <p> Registration Date: <?php echo   $_SESSION['user_info']['reg_date']."<br>"; ?> </p>
    <p> Login Time:<?php echo $_SESSION['user_info']['login_time']."<br>"; ?> </p>
    <p> Login Date:<?php echo $_SESSION['user_info']['login_date']."<br>"; ?> </p>
    <p>Last Login Time:<?php echo $_SESSION['user_info']['logout_time']."<br>"; ?> </p>
    <p>Last Login Date:<?php echo $_SESSION['user_info']['logout_date']."<br>"; ?> </p>
    <br>
    <p><a href='logout.php'>LOGOUT</a></p>
    </body>
</html>
