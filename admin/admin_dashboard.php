<?php session_start();
if($_SESSION['user_info']['designation'] !== 'Admin'){
  header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h3> WELCOME ADMIN</h3>

        <?php
        if(isset($_SESSION['success'])){
            echo "<span style='color:green';>". $_SESSION['success']. "</span><br>";
            unset($_SESSION['success']);
        }
        ?>

        <p> Name:<?php echo $_SESSION['user_info']['firstname']."<br>"; ?> </p>
        <p> Designation:<?php echo $_SESSION['user_info']['designation']."<br>"; ?> </p>
        <p> Registration time:<?php echo  $_SESSION['user_info']['reg_time']."<br>"; ?> </p>
        <p> Registration Date:<?php echo  $_SESSION['user_info']['reg_date']."<br>"; ?> </p>
        <p> Login Time:<?php echo $_SESSION['user_info']['login_time']."<br>"; ?> </p>
        <p> Login Date:<?php echo $_SESSION['user_info']['login_date']."<br>"; ?> </p>
        <p> Last Login Time:<?php echo $_SESSION['user_info']['logout_time']."<br>"; ?> </p>
        <p> Last Login Date:<?php echo $_SESSION['user_info']['logout_date']."<br>"; ?> </p>

        <h3><a href="Admin_register.php">Add User</a></h3>

        <br>
           <p><a href='../logout.php'>LOGOUT</a></p>
    </body>
</html>
