<?php
include('lib/header.php');

if(isset($_SESSION['user_info']) && !empty($_SESSION['user_info']['firstname'])){
    header('location: dashboard.php');
}

if(@$_SESSION['designation'] == 'Admin'){
    header('location: admin/admin_dashboard.php');
}
?>

        <h2>Welcome! Please register</h2>
        <div>
            <form action="processreg.php" method="POST">
                <label for="fname">First name:</label>
                <input
                <?php
                    if(isset($_SESSION['fname'])){
                    echo "Value =" . $_SESSION['fname'];
                    }
                ?>
                 type="text" name="fname"><br>
                    <?php if(isset($_SESSION['f_name_err'])){ echo "<span style='color:red';>". $_SESSION['f_name_err']. "</span><br>"; unset($_SESSION['f_name_err']); } ?>
                <br>

                <label for="lname">Last name:</label>
                <input
                <?php
                    if(isset($_SESSION['lname'])){
                    echo "Value =" . $_SESSION['lname'];
                    }
                ?>
                type="text"  name="lname" ><br>
                    <?php if(isset($_SESSION['l_name_err'])){ echo "<span style='color:red';>". $_SESSION['l_name_err']. "</span><br>"; unset($_SESSION['l_name_err']); } ?>
                <br>

                    <label for="email">Email:</label>
                    <input
                    <?php
                        if(isset($_SESSION['email'])){
                        echo "Value =" . $_SESSION['email'];
                        }
                    ?>
                     type="email"  name="email" ><br>
                    <?php if(isset($_SESSION['email_err'])){ echo "<span style='color:red';>". $_SESSION['email_err']. "</span><br>"; unset($_SESSION['email_err']); } ?>
                    <?php if(isset($_SESSION['user_err'])){ echo "<span style='color:red';>". $_SESSION['user_err']. "</span><br>";unset($_SESSION['user_err']);} ?>
                <br>

                <label for="password">Password:</label>
                <input type="password"  name="password" ><br>
                    <?php if(isset($_SESSION['pwd_err'])){ echo "<span style='color:red';>". $_SESSION['pwd_err']. "</span><br>"; unset($_SESSION['pwd_err']); } ?>
                <br>

                <label for="gender">Gender:</label>
                <select  name="gender">
                    <option value=" ">please select</option>
                    <option
                    <?php
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                        echo "selected" ;
                        }
                    ?>
                     value="Male">Male</option>

                    <option
                    <?php
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                        echo "selected" ;
                        }
                    ?>
                     value="Female">Female</option>
                </select>
                <br>
                <?php if(isset($_SESSION['gender_err'])){ echo "<span style='color:red';>". $_SESSION['gender_err']. "</span><br>"; unset($_SESSION['gender_err']); } ?>
                <br>

                <label for="designation">Designation:</label>
                    <select  name="designation">
                    <option value=" ">please select</option>
                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Admin'){
                        echo "selected";
                        }
                    ?>
                     value="Admin">Admin</option>

                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Staff'){
                        echo "selected" ;
                        }
                    ?>
                     value="Staff">Staff</option>

                    <option
                    <?php
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){
                        echo "selected";
                        }
                    ?>
                     value="Patient">Patient</option>
                </select><br>
                <?php if(isset($_SESSION['desig_err'])){ echo "<span style='color:red';>". $_SESSION['desig_err']. "</span><br>"; unset($_SESSION['desig_err']); } ?>
                <br>

                <label for="department">Department:</label>
                <input
                <?php
                    if(isset($_SESSION['department'])){
                    echo "Value =" . $_SESSION['department'];
                    }
                ?>
                 type="text"  name="department" ><br>
                    <?php if(isset($_SESSION['dept_err'])){ echo "<span style='color:red';>". $_SESSION['dept_err']. "</span><br>"; unset($_SESSION['dept_err']); } ?>
                <br>

                <br>
                <input type="submit" name="Submit">
            </form>
        </div>

<?php include('lib/footer.php') ?>
