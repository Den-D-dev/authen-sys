<?php
include('lib/header.php');
?>


<h1>Forgot Password</h1>
<p>Provide the email associated with your account:</p>

<form action ='processforgot.php' method ='POST'>
    <p>
    <?php
        if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
            echo "<span style ='color: green'>" . $_SESSION['message'] . "</span> ";
            session_destroy();
        }
    ?>
    </p>
    <p>
    <?php
        if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<span style ='color: red'>" . $_SESSION['error'] . "</span> ";
            session_destroy();
        }
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
