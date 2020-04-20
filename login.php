<?php session_start();

if(@$_SESSION['user_info']['designation'] == 'Admin'){
  header('location: admin/admin_dashboard.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h2>Login Here</h2>
        <div>
            <p>
                <?php
                if(isset($_SESSION['message'])) {
                echo "<span style='color:green';>". $_SESSION['message']. "</span><br>";
                unset($_SESSION['message']);
                }
                ?>
            </p>
            <p>
                <?php
                if(isset($_SESSION['error'])) {
                echo "<span style='color:red';>". $_SESSION['error']. "</span><br>";
                unset($_SESSION['error']);
                }
                ?>
            </p>

            <form action="processlogin.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email"><br>
                <?php if(isset($_SESSION['email'])){ echo "<span style='color:red';>". $_SESSION['email']. "</span><br>"; unset($_SESSION['email']); } ?>
            <br>
            <label for="password">Password:</label>
            <input type="password"  name="password" ><br>
                <?php if(isset($_SESSION['password'])){ echo "<span style='color:red';>". $_SESSION['password']. "</span><br>"; unset($_SESSION['password']); } ?>
            <br>
            <br>
            <input type="submit" name="Submit">
            </form>
            <p><a href="register.php">Click here to register</a></p>
        </div>
    </body>
</html>
