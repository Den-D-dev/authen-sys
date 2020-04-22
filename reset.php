<?php
include('lib/header.php');

//check if token user does not possess a generated token redirect the user to the login oage instead
if(!isset($_SESSION['loggedin']) && !isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error'] = "You are not authorized to view that page";
    header("location: login.php");
}
?>


<h1>Reset Password</h1>
<p>Email associated with your account:</p>

<form action ='processreset.php' method ='POST'>
    <p>
    <?php
        if(isset($_SESSION['reset_error']) && !empty($_SESSION['reset_error'])){
            echo "<span style ='color: red'>" . $_SESSION['error'] . "</span> ";
            session_destroy();
        }
    ?>
    </p>

    <?php if (!isset($_SESSION['loggedin'])) { ?>
    <input
    <?php
        if (isset($_SESSION['token'])) {
            echo "value='" .$_SESSION['token']. "'";
        } else {
            echo "value='" .$_GET['token']. "'";
        }
    ?>
    type="hidden" name="token" />
    <?php } ?>

    <label for="email">Email:</label><br>
    <input
    <?php
        if (isset($_SESSION['email'])) {
            echo "value=" .$_SESSION['email'];
        }
    ?>
    type="email" name="email"><br>
        <?php if(isset($_SESSION['email_err'])){ echo "<span style='color:red';>". $_SESSION['email_err']. "</span><br>"; unset($_SESSION['email_err']); } ?>
    <br>
    <label for="password">New Password:</label><br>
    <input type="password"  name="password" ><br>
        <?php if(isset($_SESSION['pwd_err'])){ echo "<span style='color:red';>". $_SESSION['pwd_err']. "</span><br>"; unset($_SESSION['pwd_err']); } ?>
    <br>
    <br>
    <input type="submit" name="Submit">

</form><br>

<?php echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>"; ?>
