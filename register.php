<?php
include('lib/header.php');
require_once('functions/alert.php');

if(isset($_SESSION['user_info']) && !empty($_SESSION['user_info']['firstname'])){
    header('location: dashboard.php');
}

if(@$_SESSION['designation'] == 'Admin'){
    header('location: admin/admin_dashboard.php');
}
?>

        <div class="reg-container">
            <h2>Welcome! Please register</h2>
            <form class="reg-form" action="processreg.php" method="POST">
                <div class="form-group">
                    <label for="fname">First name:</label>
                    <input
                    <?php if(isset($_SESSION['fname'])){ echo "Value =" . $_SESSION['fname']; unset($_SESSION['fname']);} ?>
                    type="text" name="fname" class="form-control">
                    <p><?php print_err_msg('f_name_err', 'red'); ?></p>
                </div><br>

                <div class="form-group">
                    <label for="lname">Last name:</label>
                    <input
                    <?php if(isset($_SESSION['lname'])){ echo "Value =" . $_SESSION['lname']; unset($_SESSION['lname']);} ?>
                    type="text" name="lname" class="form-control">
                    <p><?php print_err_msg('l_name_err', 'red'); ?></p>
                </div><br>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input
                    <?php if(isset($_SESSION['email'])){ echo "Value =" . $_SESSION['email']; unset($_SESSION['email']); } ?>
                    type="email" name="email" class="form-control">
                    <p><?php print_err_msg('email_err', 'red'); ?></p>
                    <p><?php print_err_msg('user_err', 'red'); ?></p>
                </div><br>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password"  name="password" class="form-control">
                    <p><?php print_err_msg('pwd_err', 'red'); ?></p>
                </div><br>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select  name="gender" class="form-control">
                        <option></option>
                        <option
                        <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){ echo "selected"; unset($_SESSION['gender']);}?>
                         value="Male">
                         Male
                        </option>

                        <option
                        <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){ echo "selected"; unset($_SESSION['gender']);} ?>
                         value="Female">
                         Female
                        </option>
                    </select>
                    <p><?php print_err_msg('gender_err', 'red'); ?></p>
                </div>

                <div class="form-group">
                   <label for="designation">Designation:</label>
                   <select  name="designation" class="form-control">
                       <option></option>
                       <option
                       <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Admin'){ echo "selected"; unset($_SESSION['designation']); } ?>
                        value="Admin">
                        Admin
                       </option>

                       <option
                       <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team'){ echo "selected"; unset($_SESSION['designation']); } ?>
                        value="Medical Team">
                        Medical Team
                       </option>

                       <option
                       <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){ echo "selected"; unset($_SESSION['designation']); } ?>
                        value="Patient">
                        Patient
                       </option>
                   </select>
                   <p><?php print_err_msg ('desig_err', 'red'); ?></p>
                 </div>

                 <div class="form-group">
                     <label for="department">Department:</label>
                     <input
                     <?php if(isset($_SESSION['department'])){ echo "Value =" . $_SESSION['department']; unset($_SESSION['department']);} ?>
                     type="text"  name="department" class="form-control">
                     <p><?php print_err_msg ('dept_err', 'red'); ?></p>
                 </div><br>

                 <button type="submit" name="Submit" class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>

<?php include('lib/footer.php') ?>
