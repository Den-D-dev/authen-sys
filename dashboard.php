<?php
include('lib/header.php');
require_once('functions/alert.php');
require_once('functions/user.php');


if(!isset($_SESSION['user_info']['firstname'])){
  header('location: login.php');
}
if($_SESSION['user_info']['designation'] == 'Admin'){
  header('location: admin/admin_dashboard.php');
}

// check if a user is not logged in (ie, has no session loggedIn) send them back to the login page
if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
};
// auth_user_logIn();

?>


<div class="container-fluid">

    <h5> WELCOME TO PATIENT DASHBOARD</h5>
    <p> <?php print_msg('success', 'green'); ?> </p>

    <div class="profile-section">
        <div class="profile-avartar">
            <img src="resources/img/person.jpg" alt="">
        </div>
        <div class="profile-data">
            <p> Name: <?php echo $_SESSION['user_info']['firstname']; echo ' ' .$_SESSION['user_info']['lastname']."<br>";?> </p>
            <p>User Id: <?php echo " SNH-nb" .$_SESSION['loggedin']."<br>"?></p>
            <p> Designation: <?php echo $_SESSION['user_info']['designation']."<br>";?> </p>
        </div>

        <div class="">
            <div class="card card-green">
                <p> Registration Time: <?php echo  $_SESSION['user_info']['reg_time']."<br>"; ?> </p>
            </div>
            <div class="card card-green">
                <p> Registration Date: <?php echo   $_SESSION['user_info']['reg_date']."<br>"; ?> </p>
            </div>

        </div>
    </div>






    <p> Login Time: <?php echo $_SESSION['user_info']['login_time']."<br>"; ?> </p>
    <p> Login Date: <?php echo $_SESSION['user_info']['login_date']."<br>"; ?> </p>
    <p>Last Login Time: <?php echo $_SESSION['user_info']['logout_time']."<br>"; ?> </p>
    <p>Last Login Date: <?php echo $_SESSION['user_info']['logout_date']."<br>"; ?> </p>
</div>

<?php include('lib/footer.php') ?>
