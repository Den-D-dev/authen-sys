<?php
include('lib/header.php');
require_once('functions/alert.php');
require_once('functions/user.php');


//check if token user does not possess a generated token redirect the user to the login oage instead
if(!is_user_loggedIn() && !is_token_set()){
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

    <?php if (!is_user_loggedIn()) { ?>
    <input
    <?php
        if (is_token_set_in_session()) {
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
        <?php print_err_msg('email_err', 'red'); ?>
    <br>
    <label for="password">New Password:</label><br>
    <input type="password"  name="password" ><br>
        <?php print_err_msg('pwd_err', 'red'); ?>
    <br>
    <br>
    <input type="submit" name="Submit">

</form><br>

<?php echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>"; ?>
