<?php session_start();

if(isset($_SESSION['user_info']) && !empty($_SESSION['user_info']['firstname'])){
    header('location: dashboard.php');
}

if(@$_SESSION['designation'] == 'Admin'){
    header('location: admin/admin_dashboard.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title></title>
    </head>
    <body>
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
                    <?php if(isset($_SESSION['firstname'])){ echo "<span style='color:red';>". $_SESSION['firstname']. "</span><br>"; unset($_SESSION['firstname']); } ?>
                <br>

                <label for="lname">Last name:</label>
                <input
                <?php
                    if(isset($_SESSION['lname'])){
                    echo "Value =" . $_SESSION['lname'];
                    }
                ?>
                type="text"  name="lname" ><br>
                    <?php if(isset($_SESSION['lastname'])){ echo "<span style='color:red';>". $_SESSION['lastname']. "</span><br>"; unset($_SESSION['lastname']); } ?>
                <br>
                
                    <label for="email">Email:</label>
                    <input
                    <?php
                        if(isset($_SESSION['email'])){
                        echo "Value =" . $_SESSION['email'];
                        }
                    ?>
                     type="email"  name="email" ><br>
                    <?php if(isset($_SESSION['email'])){ echo "<span style='color:red';>". $_SESSION['email']. "</span><br>"; unset($_SESSION['email']); } ?>
                    <?php if(isset($_SESSION['user'])){ echo "<span style='color:red';>". $_SESSION['user']. "</span><br>";unset($_SESSION['user']);} ?>
                <br>

                <label for="password">Password:</label>
                <input type="password"  name="password" ><br>
                    <?php if(isset($_SESSION['password'])){ echo "<span style='color:red';>". $_SESSION['password']. "</span><br>"; unset($_SESSION['password']); } ?>
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
                <?php if(isset($_SESSION['gender'])){ echo "<span style='color:red';>". $_SESSION['gender']. "</span><br>"; unset($_SESSION['gender']); } ?>
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
                <?php if(isset($_SESSION['designation'])){ echo "<span style='color:red';>". $_SESSION['designation']. "</span><br>"; unset($_SESSION['designation']); } ?>
                <br>

                <label for="department">Department:</label>
                <input
                <?php
                    if(isset($_SESSION['department'])){
                    echo "Value =" . $_SESSION['department'];
                    }
                ?>
                 type="text"  name="department" ><br>
                    <?php if(isset($_SESSION['department'])){ echo "<span style='color:red';>". $_SESSION['department']. "</span><br>"; unset($_SESSION['department']); } ?>
                <br>

                <br>
                <input type="submit" name="Submit">
            </form>
        </div>
    </body>
</html>
