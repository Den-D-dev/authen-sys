<?php
include('lib/header.php');
require_once('functions/alert.php');
?>


<h1>Forgot Password</h1>
<p>Provide the email associated with your account:</p>

<form action ='processforgot.php' method ='POST'>
    <p>
    <?php
        print_msg('message', 'green');
        print_msg('error', 'red');
    ?>
    </p>

    <label for="email">Email:</label><br>
    <input
    <?php
        if ( isset( $_SESSION['email'] ) ) {
        echo 'Value = ' . $_SESSION['email'];
        }
    ?>
     type="email" name="email"><br>
    <br>
    <button type="submit">Send Reset Code</button>

</form><br>

<?php echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>"; ?>
