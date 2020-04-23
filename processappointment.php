<?php
session_start();

$errorCount = 0;

$full_name = $_POST['full_name'] != ''   ?  $_POST['full_name']  : $errorCount++  ;
$email = $_POST['email'] != ''  ? $_POST['email'] :  $errorCount++ ;
$appointment_date = $_POST['appointment_date'] != '' ?  $_POST['appointment_date'] : $errorCount++;
$appointment_time = $_POST['appointment_time'] != '' ?  $_POST['appointment_time'] : $errorCount++;
$appointment_nature = $_POST['appointment_nature'] != '' ?  $_POST['appointment_nature'] : $errorCount++;
$appointment_department = $_POST['appointment_department'] != '' ?  $_POST['appointment_department'] : $errorCount++;
$initial_complaint = $_POST['complaint'] != '' ?  $_POST['complaint'] : $errorCount++;

//store session for input
$_SESSION ['full_name'] = $full_name;
$_SESSION ['email'] = $email;
$_SESSION ['appointment_date'] = $appointment_date;
$_SESSION ['appointment_time'] = $appointment_time;
$_SESSION ['appointment_nature'] = $appointment_nature;
$_SESSION['appointment_department'] = $appointment_department;
$_SESSION['complaint'] = $initial_complaint;


if ($errorCount > 0) {
    header('location: dashboard.php');
    $_SESSION['error'] = "You have " .$errorCount. " unfilled fields. Please fill all input fields";
}else{

    //counting users in the db/users folder adn auto incrementing user_id
    $allAppointments = scandir("db/appointments/");
    $countAppointments = count($allAppointments);
    $appointment_id = $countAppointments-1;

    date_default_timezone_set("Africa/Lagos");
    $book_time = date("h:i A");
    $book_date = date("d-m-Y");

    //putting user info into an array object for proper storage in the file system
        $apponitment_data = [
          'id'           => $appointment_id,
          'reg_time'     => $book_time,
          'reg_date'     => $book_date,
          'full_name' => $full_name,
          'email' => $email,
          'appointment_date' => $appointment_date,
          'appointment_time' => $appointment_time,
          'appointment_nature' => $appointment_nature,
          'appointment_department' => $appointment_department,
          'complaint' => $initial_complaint
         ];

         $_SESSION['appointment_data'] = $appointment_data;

        file_put_contents("db/appointments/".$email.".json" , json_encode($apponitment_data));
        header('location: dashboard.php');
        $_SESSION['success'] = "Appointment booked Successfully";
}
