<?php session_start();
if($_SESSION['user_info']['designation'] !== 'Admin'){
  header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h2>Register As An Admin</h2>
        <div>
            <form action="processadminreg.php" method="POST">
                <label for="fname">First name:</label>
                <input type="text" name="fname"><br>
                    <?php if(isset($_SESSION['firstname'])){ echo "<span style='color:red';>". $_SESSION['firstname']. "</span><br>"; unset($_SESSION['firstname']); } ?>
                    <?php if(isset($_SESSION['firstname1'])){ echo "<span style='color:red';>". $_SESSION['firstname1']. "</span><br>";unset($_SESSION['firstname1']);} ?>
                    <?php if(isset($_SESSION['firstname2'])){ echo "<span style='color:red';>". $_SESSION['firstname2']. "</span><br>";unset($_SESSION['firstname2']);} ?>
                    <?php if(isset($_SESSION['firstname3'])){ echo "<span style='color:red';>". $_SESSION['firstname3']. "</span><br>";unset($_SESSION['firstname3']);} ?>
                <br>
                <label for="lname">Last name:</label>
                <input type="text"  name="lname" ><br>
                    <?php if(isset($_SESSION['lastname'])){ echo "<span style='color:red';>". $_SESSION['lastname']. "</span><br>"; unset($_SESSION['lastname']); } ?>
                    <?php if(isset($_SESSION['lastname1'])){ echo "<span style='color:red';>". $_SESSION['lastname1']. "</span><br>";unset($_SESSION['lastname1']);} ?>
                    <?php if(isset($_SESSION['lastname2'])){ echo "<span style='color:red';>". $_SESSION['lastname2']. "</span><br>";unset($_SESSION['lastname2']);} ?>
                    <?php if(isset($_SESSION['lastname3'])){ echo "<span style='color:red';>". $_SESSION['lastname3']. "</span><br>";unset($_SESSION['lastname3']);} ?>
                <br>

                <label for="gender">Gender:</label>
                <select  name="gender">
                    <option value=" ">please select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br>
                <?php if(isset($_SESSION['gender'])){ echo "<span style='color:red';>". $_SESSION['gender']. "</span><br>"; unset($_SESSION['gender']); } ?>
                <br>

                <label for="department">Department:</label>
                <input type="text"  name="department" ><br>
                    <?php if(isset($_SESSION['department'])){ echo "<span style='color:red';>". $_SESSION['department']. "</span><br>"; unset($_SESSION['department']); } ?>
                <br>

                <label for="designation">Designation:</label>
                <select  name="designation">
                    <option value=" ">please select</option>
                    <option value="Staff">Staff</option>
                    <option value="Patient">Patient</option>
                </select><br>
                <?php if(isset($_SESSION['designate'])){ echo "<span style='color:red';>". $_SESSION['designate']. "</span><br>"; unset($_SESSION['designate']); } ?>

                <br>


                <label for="email">Email:</label>
                <input type="email"  name="email" ><br>
                    <?php if(isset($_SESSION['email'])){ echo "<span style='color:red';>". $_SESSION['email']. "</span><br>"; unset($_SESSION['email']); } ?>
                    <?php if(isset($_SESSION['email01'])){ echo "<span style='color:red';>". $_SESSION['email01']. "</span><br>";unset($_SESSION['email01']);} ?>
                    <?php if(isset($_SESSION['email02'])){ echo "<span style='color:red';>". $_SESSION['email02']. "</span><br>";unset($_SESSION['email02']);} ?>
                    <?php if(isset($_SESSION['email03'])){ echo "<span style='color:red';>". $_SESSION['email03']. "</span><br>";unset($_SESSION['email03']);} ?>
                    <?php if(isset($_SESSION['user1'])){ echo "<span style='color:red';>". $_SESSION['user1']. "</span><br>";unset($_SESSION['user1']);} ?>
                <br>

                <label for="password">Password:</label>
                <input type="password"  name="password" ><br>
                    <?php if(isset($_SESSION['password1'])){ echo "<span style='color:red';>". $_SESSION['password1']. "</span><br>"; unset($_SESSION['password1']); } ?>
                    <?php if(isset($_SESSION['password2'])){ echo "<span style='color:red';>". $_SESSION['password2']. "</span><br>"; unset($_SESSION['password2']); } ?>

                <br>
                </select><br>
                <input type="submit" name="Submit">
            </form>
        </div>
    </body>
</html>
