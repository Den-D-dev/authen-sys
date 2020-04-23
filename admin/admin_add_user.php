<?php
include('../lib/header.php');
require_once('../functions/alert.php');

if($_SESSION['user_info']['designation'] !== 'Admin'){
  header('location: ../login.php');
}
?>

        <a href="admin_dashboard.php">Go back</a><br>
        <h2>Register A New User</h2>
        <div>
            <form action="processadminreg.php" method="POST">
                <label for="fname">First name:</label>
                <input
                <?php
                    if(isset($_SESSION['fname'])){
                    echo "Value =" . $_SESSION['fname'];
                    unset($_SESSION['fname']);
                    }
                ?>
                 type="text" name="fname"><br>
                    <?php print_err_msg('f_name_err', 'red'); ?>
                <br>

                <label for="lname">Last name:</label>
                <input
                <?php
                    if(isset($_SESSION['lname'])){
                    echo "Value =" . $_SESSION['lname'];
                    unset($_SESSION['lname']);
                    }
                ?>
                type="text"  name="lname" ><br>
                    <?php print_err_msg('l_name_err', 'red'); ?>
                <br>

                    <label for="email">Email:</label>
                    <input
                    <?php
                        if(isset($_SESSION['email'])){
                        echo "Value =" . $_SESSION['email'];
                        unset($_SESSION['email']);
                        }
                    ?>
                     type="email"  name="email" ><br>
                    <?php print_err_msg('email_err', 'red'); ?>
                    <?php print_err_msg('user_err', 'red'); ?>
                <br>

                <label for="password">Password:</label>
                <input type="password"  name="password" ><br>
                    <?php print_err_msg('pwd_err', 'red'); ?>
                <br>

                <label for="gender">Gender:</label>
                <select  name="gender">
                    <option></option>
                    <option
                    <?php
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                        echo "selected" ;
                        unset($_SESSION['gender']);
                        }
                    ?>
                     value="Male">Male</option>

                    <option
                    <?php
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                        echo "selected" ;
                        unset($_SESSION['gender']);
                        }
                    ?>
                     value="Female">Female</option>
                </select>
                <br>
                <?php print_err_msg('gender_err', 'red'); ?>
                <br>

                <label for="designation">Designation:</label>
                    <select  name="designation">
                    <option></option>
                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Admin'){
                        echo "selected";
                        unset($_SESSION['designation']);
                        }
                    ?>
                     value="Admin">Admin</option>

                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team'){
                        echo "selected" ;
                        unset($_SESSION['designation']);
                        }
                    ?>
                     value="Medical Team">Medical Team</option>

                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){
                        echo "selected";
                        unset($_SESSION['designation']);
                        }
                    ?>
                     value="Patient">Patient</option>
                </select><br>
                <?php print_err_msg ('desig_err', 'red'); ?>
                <br>

                <label for="department">Department:</label>
                <input
                <?php
                    if(isset($_SESSION['department'])){
                    echo "Value =" . $_SESSION['department'];
                    unset($_SESSION['department']);
                    }
                ?>
                 type="text"  name="department" ><br>
                    <?php print_err_msg ('dept_err', 'red'); ?>
                <br>

                <br>
                <input type="submit" name="Submit">
            </form>
        </div>

<?php include('../lib/footer.php') ?>
