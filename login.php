<?php
include('lib/header.php');

// check if a user is not logged in (ie, has no session loggedIn) send to appropriate dashboard
if(isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Patient"){
    header("location: dashboard.php");
} else if (isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Staff") {
    header("location: staff_dashboard.php");
} else if (isset($_SESSION['loggedin']) && $_SESSION['designation'] == "Admin") {
    header('location: admin/admin_dashboard.php');
}

// if(@$_SESSION['user_info']['designation'] == 'Admin'){
//   header('location: admin/admin_dashboard.php');
// }

?>
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
                <?php if(isset($_SESSION['email_err'])){ echo "<span style='color:red';>". $_SESSION['email_err']. "</span><br>"; unset($_SESSION['email_err']); } ?>
            <br>
            <label for="password">Password:</label>
            <input type="password"  name="password" ><br>
                <?php if(isset($_SESSION['pwd_err'])){ echo "<span style='color:red';>". $_SESSION['pwd_err']. "</span><br>"; unset($_SESSION['pwd_err']); } ?>
            <br>
            <br>
            <input type="submit" name="Submit">
            </form>
        </div>

<?php include('lib/footer.php') ?>
