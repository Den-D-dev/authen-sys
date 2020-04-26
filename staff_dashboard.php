<?php
include('lib/header.php');

if($_SESSION['user_info']['designation'] !== 'Medical Team'){
  header('location: login.php');
}

// check if a user is not logged in (ie, has no session loggedIn) send them back to the login page
if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
};
?>

        <div class="container-fluid">

            <h5 class="page-header">STAFF DASHBOARD</h5>
            <p>
                <?php
                // if(isset($_SESSION['error'])) {
                //     echo "<span style='color:red';>". $_SESSION['error']. "</span><br>";
                //     unset($_SESSION['error']);
                // }
                ?>
            </p>
            <p>
                <?php
                if(isset($_SESSION['success'])) {
                    echo "<span style='color:green';>". $_SESSION['success']. "</span><br>";
                    unset($_SESSION['success']);
                }
                ?>
            </p>
            <!-- <p><?php //print_err_msg('error', 'red'); print_err_msg('message', 'green'); ?></p> -->

            <div class="profile-section">
                <div class="profile-avartar">
                    <img src="resources/img/person.jpg" alt="">
                </div>
                <div class="profile-data">
                    <p>User Id: <?php echo " SNH-nb" .$_SESSION['loggedin']; ?></p>
                    <p> Name: <?php echo $_SESSION['user_info']['firstname']; echo ' ' .$_SESSION['user_info']['lastname']; ?> </p>
                    <p>Gender: <?php echo $_SESSION['user_info']['gender']; ?></p>
                    <p>Designation: <?php echo $_SESSION['user_info']['designation']; ?> </p>
                </div>

                <div class="right-col">
                    <div class="right-col-email">
                        <p>Email: <?php echo $_SESSION['user_info']['email']; ?></p>
                    </div>

                    </div>
                </div>
            </div>
            <div class="time-cards">
                <div class="card-set card-blue">
                    <h6> Registration Date :</h6>
                    <p><?php echo $_SESSION['user_info']['reg_date']. " "; echo $_SESSION['user_info']['reg_time']; ?></p>
                </div>

                <div class="card-set card-green">
                    <h6> Logged In :</h6>
                    <p><?php echo $_SESSION['user_info']['login_date']. " "; echo $_SESSION['user_info']['login_time']; ?></p>
                </div>

                <div class="card-set card-orange">
                    <h6> Last Time You Logged Out :</h6>
                    <p><?php echo $_SESSION['user_info']['logout_date']. " "; echo $_SESSION['user_info']['logout_time']; ?></p>
                </div>
            </div>
        <hr>

<?php include('lib/footer.php') ?>
