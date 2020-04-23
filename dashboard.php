<?php
include('lib/header.php');
// require_once('functions/alert.php');


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

?>


<div class="container-fluid">

    <h5 class="page-header">PATIENT DASHBOARD</h5>
    <p>
        <?php
        if(isset($_SESSION['error'])) {
            echo "<span style='color:red';>". $_SESSION['error']. "</span><br>";
            unset($_SESSION['error']);
        }
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

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary book-btn" data-toggle="modal" data-target="#exampleModal">
              Book An Appointment
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                      <form action='processappointment.php' method='POST'>
                          <div class="form-group">
                              <label for="full_name">Full name:</label>
                              <input
                              <?php //if(isset($_SESSION['full_name'])){ echo "Value =" . $_SESSION['full_name']; unset($_SESSION['full_name']);} ?>
                              type="text" name="full_name" class="form-control">
                          </div><br>

                          <div class="form-group">
                              <label class="control-label" for="email">Email:</label>
                              <input
                              <?php //if(isset($_SESSION['email'])){ echo "Value =" . $_SESSION['email']; unset($_SESSION['email']);} ?>
                              type="email" name="email" class="form-control" required>
                          </div><br>


                     <div class="form-group">
                         <label  class="control-label">Date Of Appointment</label>
                         <input type="date" class="form-control input-lg" name="appointment_date">
                     </div><br>

                     <div class="form-group">
                         <label class="control-label">Time Of Appointment</label>
                         <input type="time" class="form-control input-lg" name="appointment_time" id='datetimepicker3'>
                     </div>

                     <div class="form-group">
                         <label class="control-label" for='nature of appointment'>Nature Of Appointment</label>
                         <select class="form-control input-lg" name="appointment_nature">
                             <option></option>
                             <option
                             <?php //if(isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'consultation'){ echo "selected"; } ?>
                             > Consultation </option>
                             <option
                             <?php //if(isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Follow-Up'){ echo "selected"; } ?>
                             >Follow-Up
                            </option>
                        </select>
                     </div>

                     <div class="form-group">
                         <label for='department' class="control-label"> Department</label>
                         <select class="form-control input-lg" name="appointment_department">
                             <option></option>
                             <option
                             <?php //if(isset($_SESSION['appointment_department']) && $_SESSION['appointment_department'] == 'General medicine'){echo "selected"; } ?>
                             > General medicine
                            </option>
                             <option
                             <?php //if(isset($_SESSION['appointment_department']) && $_SESSION['appointment_department'] == 'Laboratory'){ echo "selected"; } ?>
                             > Laboratory
                            </option>
                             <option
                             <?php //if(isset($_SESSION['appointment_department']) && $_SESSION['appointment_department'] == 'Dentistry'){ echo "selected";} ?>
                             > Dentistry
                            </option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label class="control-label">Initial Complaint</label>
                         <textarea
                             <?php //if(isset($_SESSION['complaint'])){ echo "Value =" . $_SESSION['complaint']; unset($_SESSION['complaint']);} ?>
                         name="complaint" class="form-control" placeholder='Enter Complaint here...' required></textarea>
                     </div>
                     </div>

                     <!-- Modal footer -->
                     <div class="modal-footer">
                       <button type="submit" name="Submit" class="btn btn-primary btn-lg btn-block">Book</button>
                     </div>
                     </form>
                  </div><!-- end of modal body-->
                </div>
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
            <h6> Logged Out :</h6>
            <p><?php echo $_SESSION['user_info']['logout_date']. " "; echo $_SESSION['user_info']['logout_time']; ?></p>
        </div>
    </div>
<hr>



<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Id</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Appointment Time</th>
      <th scope="col">Nature Of Appointment</th>
      <th scope="col">Department</th>
      <th scope="col">Registration date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Apm-1</td>
      <td>2020-04-27</td>
      <td>12:00 AM</td>
      <td>Consultation</td>
      <td>Laboratory</td>
      <td>23-04-2020</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Apm-2</td>
      <td>2020-04-27</td>
      <td>12:00 AM</td>
      <td>Follow</td>
      <td>General Medicine</td>
      <td>23-04-2020</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Apm-3</td>
      <td>2020-04-27</td>
      <td>12:00 AM</td>
      <td>Consultation</td>
      <td>Dentistry</td>
      <td>23-04-2020</td>
    </tr>
  </tbody>
</table>




</div>

<?php include('lib/footer.php') ?>
