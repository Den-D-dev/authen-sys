<?php
include('../lib/header.php');

if($_SESSION['user_info']['designation'] !== 'Admin'){
  header('location: ../login.php');
}
?>

        <a href="admin_dashboard.php">Go back</a><br>
        <h2>Register A New User</h2>
        <div>
            <form action="processadminreg.php" method="POST">
                <label for="fname">First name:</label>
                <input type="text" name="fname"><br>
                    <?php if(isset($_SESSION['f_name_err'])){ echo "<span style='color:red';>". $_SESSION['f_name_err']. "</span><br>"; unset($_SESSION['f_name_err']); } ?>
                <br>
                <label for="lname">Last name:</label>
                <input type="text"  name="lname" ><br>
                    <?php if(isset($_SESSION['l_name_err'])){ echo "<span style='color:red';>". $_SESSION['l_name_err']. "</span><br>"; unset($_SESSION['l_name_err']); } ?>
                <br>

                <label for="gender">Gender:</label>
                <select  name="gender">
                    <option value=" ">please select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br>
                <?php if(isset($_SESSION['gender_err'])){ echo "<span style='color:red';>". $_SESSION['gender_err']. "</span><br>"; unset($_SESSION['gender_err']); } ?>
                <br>

                <label for="department">Department:</label>
                <input type="text"  name="department" ><br>
                    <?php if(isset($_SESSION['dept_err'])){ echo "<span style='color:red';>". $_SESSION['dept_err']. "</span><br>"; unset($_SESSION['dept_err']); } ?>
                <br>

                <label for="designation">Designation:</label>
                <select  name="designation">
                    <option value=" ">please select</option>
                    <option value="Staff">Staff</option>
                    <option value="Patient">Patient</option>
                </select><br>
                <?php if(isset($_SESSION['desig_err'])){ echo "<span style='color:red';>". $_SESSION['desig_err']. "</span><br>"; unset($_SESSION['desig_err']); } ?>

                <br>

                <label for="email">Email:</label>
                <input type="email"  name="email" ><br>
                    <?php if(isset($_SESSION['email_err'])){ echo "<span style='color:red';>". $_SESSION['email_err']. "</span><br>"; unset($_SESSION['email_err']); } ?>
                    <?php if(isset($_SESSION['user_err'])){ echo "<span style='color:red';>". $_SESSION['user_err']. "</span><br>";unset($_SESSION['user_err']);} ?>
                <br>

                <label for="password">Password:</label>
                <input type="password"  name="password" ><br>
                  <?php if(isset($_SESSION['pwd_err'])){ echo "<span style='color:red';>". $_SESSION['pwd_err']. "</span><br>"; unset($_SESSION['pwd_err']); } ?>
                <br>
                </select><br>
                <input type="submit" name="Submit">
            </form>
        </div>

<?php include('lib/footer.php') ?>
