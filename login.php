<?php
include('lib/header.php');
require_once('functions/alert.php');

// check if a user is not logged in (ie, has no session loggedIn) send to appropriate dashboard
if(isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Patient"){
    header("location: dashboard.php");
} else if (isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Medical Team") {
    header("location: staff_dashboard.php");
} else if (isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Admin") {
    header('location: admin/admin_dashboard.php');
}

// if(@$_SESSION['user_info']['designation'] == 'Admin'){
//   header('location: admin/admin_dashboard.php');
// }

?>

        <div class="reg-container login-form">
            <h3>Login Here</h3>
            <p> <?php //success_msg(); error_msg(); ?> </p>
            <p><?php print_err_msg('error', 'red'); print_err_msg('message', 'green'); ?></p>

            <form class="reg-form" action="processlogin.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input
                    <?php if(isset($_SESSION['email'])){ echo "Value =" . $_SESSION['email']; unset($_SESSION['email']); } ?>
                    type="email" name="email" class="form-control">
                    <p><?php print_err_msg('email_err', 'red'); ?></p>
                </div><br>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password"  name="password" class="form-control">
                    <p><?php print_err_msg('pwd_err', 'red'); ?></p>
                </div><br>
                <button type="submit" name="Submit" class="btn btn-success btn-lg btn-block" onclick="toast()">Submit</button>
            </form>
        </div>

<?php include('lib/footer.php') ?>
