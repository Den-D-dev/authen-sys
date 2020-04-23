<?php
session_start();
////ERROR ARRAY;
$errors= array();

if (!isset($_SESSION['loggedin'])) { // this is to check is the user is not logged in run the token then but if user is logged in skip the token
    $token = $_POST['token'];
    $_SESSION ['token'] = $token;
}

$email = $_POST['email'] != '' ?  $_POST['email'] : $errorCount++;
$password = $_POST['password'] != '' ?  $_POST['password'] : $errorCount++;


//store session for input
$_SESSION ['email'] = $email;
$_SESSION ['password'] = $password;


// validate login details

  // checking email
  if(empty($_POST['email'])){
    $errors['email_err']='';
    $_SESSION['email_err']='email is required';
    header('location: reset.php');
  }else{
    $email=$_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'Email is invalid';
        header('location: reset.php');}
    }

      // checking password
    if(empty($_POST['password'])){
        $errors['pwd_err'] = '';
        $_SESSION['pwd_err'] = 'password is required';
        header('location: reset.php');
    } else{
        $password=$_POST['password'];
        if(strlen($password) <= 7){
            $errors['pwd_err'] = '';
            $_SESSION['pwd_err'] = 'password must atleast be 8 characters';
            header('location: reset.php');}
      }


  if (count($errors) > 0) {
      // header('location: login.php');
     // print_r('you have errors');
    // die();
  }else{

    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);

    for($counter = 0; $counter < $countAllUserTokens; $counter++ ){
        $currentTokenFile = $allUserTokens[$counter];

        if($currentTokenFile == $email.".json"){

            $tokenContent = file_get_contents("db/tokens/".$currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            $tokenFromDB = $tokenObject->token;

            //  if user is not logged in look for his token permission but user is logged in we assume that
            // he is authorized to change the password
            if (isset($_SESSION['loggedin'])) {
                $checkToken = true;
            } else {
                $checkToken = $tokenFromDB == $token;
            }


            if ($checkToken) {
                // echo "user can update the password";
                // die();
                $all_users= scandir("db/user/");
                $count_users = count($all_users);

                for ($counter=0; $counter < $count_users ; $counter++) {
                   $current_user = $all_users[$counter];

                   if($current_user == $email.".json") {

                      //checking user password from the json content in the get_included_files
                      $userContent = file_get_contents("db/user/".$current_user);
                      $decode_user_content = json_decode($userContent);
                      $decode_user_content->password = password_hash($password, PASSWORD_DEFAULT);

                      unlink("db/user/".$current_user);
                      // go ahead and add user
                      file_put_contents("db/user/".$email.".json" , json_encode($decode_user_content));

                      /*
                      * INFORM USER OF PASSWORD RESET
                      */
                      $reset_time = date("h:i:sa");
                      $reset_date = date("Y-m-d");

                      $subject = "Password Reset Successful";
                      $message = "The password of your account with SNG-hospital was recently changed on ". $reset_date . " at ". $reset_time ."\n If you did not initiate this please visit SNG-hospital.org to reset your password immediately";
                      $headers = "From: no-reply@mail.org" . "\r\n" .
                      "CC: dennis@mail.com";

                       $try = mail($email,$subject,$message,$headers);
                      /*
                      * INFORM USER OF PASSWORD RESET ends
                      */

                      header('location:  login.php');
                      $_SESSION['message'] = "Password reset successfully, you can now login";

                   }
                 }

            } // if token was right, process user and save the new password
        }

        $_SESSION['reset_error'] = "Password Reset Failed token/email invalid" . '' . $first_name;
        header("location: login.php");
    }
  }
