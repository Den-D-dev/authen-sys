<?php
session_start();
////ERROR ARRAY;
$errors= array();

 $email = "";
 $password = "";

// validate login details

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // checking email
  if(empty($_POST['email'])){
    $errors['email_err']='';
    $_SESSION['email_err']='email is required';
    header('location: login.php');
  }else{

    $email=$_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'Email is invalid';
        header('location: login.php');
    } else if(strlen($email) <= 5){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'Email must not be less than 5';
        header('location: login.php');
    } else if(!strpos($email, '.')){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'Email must contain ' . ". " . 'symbol';
        header('location: login.php');}
      }


      // checking password
    if(empty($_POST['password'])){
        $errors['pwd_err'] = '';
        $_SESSION['pwd_err'] = 'password is required';
        header('location: login.php');
    } else{
        $password=$_POST['password'];
        if(strlen($password) <= 7){
            $errors['pwd_err'] = '';
            $_SESSION['pwd_err'] = 'password must atleast be 8 characters';
            header('location: login.php');}

      }


  if (count($errors) > 0) {
      // header('location: login.php');
       // print_r('you have errors');
  }else{

    $data=[
         'email' => $email,
         'password' => $password,
     ];

      $all_users= scandir("db/user/");
      $count_users = count($all_users);
      date_default_timezone_set("Africa/Lagos");
      $login_time =date("h:i:sa");
      $login_date = date("Y-m-d");


      for ($counter=0; $counter < $count_users ; $counter++) {
         $current_user = $all_users[$counter];

         if($current_user == $email.".json"){

            //checking user password from the json content in the get_included_files
            $usercontent = file_get_contents("db/user/".$email.".json");
            $decode_user_content = json_decode($usercontent);
            $user_content_password = $decode_user_content->password;
            $user_password = password_verify($data['password'] , $user_content_password);

              if($user_content_password == $user_password){

                $user_data=[
                    'id'          => $decode_user_content->id,
                    'reg_time'    => $decode_user_content->reg_time,
                    'reg_date'    => $decode_user_content->reg_date,
                    'logout_time' => $decode_user_content->logout_time,
                    'logout_date' => $decode_user_content->logout_date,
                    'login_time'  => $login_time,
                    'login_date'  => $login_date,
                    'firstname'   => $decode_user_content->firstname,
                    'lastname'    => $decode_user_content->lastname,
                    'email'       => $decode_user_content->email,
                    'gender'      => $decode_user_content->gender,
                    'designation' => $decode_user_content->designation,
                    'department'  => $decode_user_content->department,
                    'password'    => $decode_user_content->password
                 ];

                   $_SESSION['user_info']   = $user_data;
                   $_SESSION['email']    = $decode_user_content->email;
                   $_SESSION['loggedin']    = $decode_user_content->id;
                   $_SESSION['designation'] = $decode_user_content->designation;

                   if($decode_user_content->designation == "Admin"){
                       $_SESSION['success'] = 'You are logged in as an - Admin';
                       header('location: admin/admin_dashboard.php');
                   } else if($decode_user_content->designation == "Staff"){
                       $_SESSION['success'] = 'You are logged in as a - Staff';
                       header('location: staff_dashboard.php');
                   } else if($decode_user_content->designation == "Patient") {
                       $_SESSION['success'] = 'You are logged in as a - Patient';
                       header('location: dashboard.php');
                   }
                     die();

                 }
                 else{
                    $_SESSION['error'] = 'Incorrect Password';
                     header('location: login.php'); ////redirect to login if password or email is incorrect
                 }

         } else {
             $_SESSION['error'] = 'Incorrect Email or Password';
             header('location: login.php');
         }
       }
   }
 }
