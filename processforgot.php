<?php
    session_start();

    //Data collection / validation
    $errorCount = 0;

    $email = $_POST['email'] != '' ?  $_POST['email'] : $errorCount++;
    $_SESSION ['email'] = $email;


    // checking email
    if(empty($_POST['email'])){
      $errors['email_err']='';
      $_SESSION['email_err']='email is required';
      header('location: forgot.php');
    }else{
      $email=$_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email_err'] = '';
          $_SESSION['email_err'] = 'Please enter a valid email';
          header('location: forgot.php');}
      }


    //check for error before submission
if ($errorCount > 0) {
    //display accurate message
    // $_SESSION['error'] = 'Please enter a valid email';
    // header("location: forgot.php");
} else {

    //count all Users
    $allUsers = scandir("db/user/");
    $countAllUsers = count($allUsers);


    for($counter = 0; $counter < $countAllUsers; $counter++ ){
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
            // send  email

            /**
             * Generating token starts Here
             */
            $token= '';
            $alphabets = ['a','b','d','e','f','g','h' ,'i','j','k','l','m',"n",
             'A','B','C', 'D','E','E', 'F','G','H', 'I','J', 'K','L','M', 'N','O',
             'P','Q','R', 'S','T','U','V','W', 'o','p','.', 'q','r','s', 't'];

            for($i=0; $i < 22 ; $i++ ){
                $index = mt_rand(0, count($alphabets));
                $token .= $alphabets[$index];
            }

            /**
             * Sendimg email to user to reset password through a link
             */

            $subject = "Password Reset";                                                                                                                       // localhost/sng_hosp/reset.php?token=
            $message = "A password reset has been initiated from your account. If you did not initiate this reset, please ignore this message, otherwise, visit: localhost:9090/authen-sys/reset.php?token=" . $token;
            $headers = "From: no-reply@mail.org" . "\r\n" .
            "CC: dennis@mail.com";

            //save token in folder
            file_put_contents("db/tokens/". $email . ".json", json_encode(['token' => $token]));

           $try = mail($email,$subject,$message,$headers);


           if($try){
               //display a success message
               $_SESSION['message'] = "Password reset has been Sent to:" . " - " . $email;
               header("location: login.php");
           } else {
               //display error message if the email entered is not registered on the datatabase
               $_SESSION['error'] = "Oops! something went wrong, password reset not sent to:" . " " . $email;
               header("location: forgot.php");
           }

            die();
        }

    }
    $_SESSION['error'] = "Email not Found ERR:" . " " . $email;
    header("location: forgot.php");
}
?>
