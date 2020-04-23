<?php
session_start();
$errors = array();


// Validate form fileds

if($_SERVER["REQUEST_METHOD"] == "POST"){

 //Validate first name
      if(empty($_POST['fname'])){
            $errors['f_name_err']= "";
            $_SESSION['f_name_err']='Name is required';
           header('location: admin_add_user.php');
      }else{
        $firstname=$_POST['fname'];
        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $firstname)){
            $errors['f_name_err'] = '';
            $_SESSION['f_name_err'] = 'Numbers not required in name field';
            header('location: admin_add_user.php');
        } else if(strlen($firstname) <= 2){
            echo $errors['f_name_err'] = '';
            $_SESSION['f_name_err'] = 'Name must not be short';
            header('location: admin_add_user.php');
        } else if(is_numeric($firstname )){
            echo $errors['f_name_err'] = '';
            $_SESSION['f_name_err'] = 'Numbers not required in name field';
            header('location: admin_add_user.php');
        }
      }

      // Validation last name
      if(empty($_POST['lname'])){
         $errors['l_name_err']="";
         $_SESSION['l_name_err']='LastName is required';
         header('location: admin_add_user.php');
      }else{
        $lastname=$_POST['lname'];

        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $lastname)){
            $errors['l_name_err'] = '';
            $_SESSION['l_name_err'] = 'Numbers not required in lastname field';
            header('location: admin_add_user.php');
        } else if(strlen($lastname) <= 2){
            $errors['l_name_err'] = '';
            $_SESSION['l_name_err'] = 'LastName must not be short';
            header('location: admin_add_user.php');
        } else if(is_numeric($lastname )){
            $errors['l_name_err'] = '';
            $_SESSION['l_name_err'] = 'Numbers not required in lastname field';
            header('location: admin_add_user.php');
        }

      }


    //Validate Gender
    if($_POST['gender'] == " "){
        $errors['gender_err'] = '';
        $_SESSION['gender_err'] = 'Gender is required';
        header('location: admin_add_user.php');
    }else{
        $gender=$_POST['gender'];
    }


    //Validate Dept
    if(empty($_POST['department'])){
        echo $errors['dept_err'] = "";
        $_SESSION['dept_err'] = 'department is required';
        header('location: admin_add_user.php');
    }else{
        $department=$_POST['department'];
    }

    //Validate Designation
    if($_POST['designation'] == " "){
        $errors['desig_err'] = '';
        $_SESSION['desig_err'] = 'designation is required';
        header('location: admin_add_user.php');
    }else{
        $designation=$_POST['designation'];
    }

    //Validate password
    if(empty($_POST['password'])){
        $errors['pwd_err'] = '';
        $_SESSION['pwd_err'] = 'password is required';
        header('location: admin_add_user.php');
    }else{
        $password=$_POST['password'];
        if(strlen($password) <= 7){
            $errors['pwd_err'] = ''."<br>";
            $_SESSION['pwd_err'] = 'paasword must atleast be 8 characters';
            header('location: admin_add_user.php');
        }
    }


      //Validate email
    if(empty($_POST['email'])){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'email is required';
        header('location: admin_add_user.php');
    }else{
        $email=$_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Email is invalid';
            header('location: admin_add_user.php');
        } else if(strlen($email) <= 5){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Email must not be less than 5';
            header('location: admin_add_user.php');
        } else if(!strpos($email, '.')){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Email must contain ' . "." . 'symbol';
            header('location: admin_add_user.php');
        }
    }

//store session for input
$_SESSION ['fname'] = $firstname;
$_SESSION ['lname'] = $lastname;
$_SESSION ['email'] = $email;
$_SESSION ['gender'] = $gender;
$_SESSION ['designation'] = $designation;
$_SESSION ['department'] = $department;

//checking for errors and iserting into database;

if (count($errors) > 0) {
    header('location: admin_add_user.php');
   // 'you have  errors';
}else{

//counting users in the db/users folder adn auto incrementing user_id
$all_users= scandir("../db/user/");
$count_users = count($all_users);
$user_id = $count_users-1;
 date_default_timezone_set("Africa/Lagos");
 $reg_time = date("h:i:sa");
 $reg_date = date("Y-m-d");

//putting user info into an array object for proper storage in the file system
    $data = [
      'id'           => $user_id,
      'reg_time'     => $reg_time,
      'reg_date'     => $reg_date,
       'firstname'   => $firstname,
       'lastname'    => $lastname,
       'email'       => $email,
       'gender'      => $gender,
       'designation' => $designation,
       'department'  => $department,
       'password'    => password_hash($password, PASSWORD_DEFAULT)
     ];

     $_SESSION['data'] = $data;

     //checking to see if user already exist in the database before storage.

     for ($counter = 0; $counter < $count_users ; $counter++) {
        $current_user = $all_users[$counter];

        if($current_user == $email.".json"){
          echo $errors['user_err'] = '';
          $_SESSION['user_err']='User already exist';
         header('location: admin_add_user.php');
          die();
      } else {
          $_SESSION['success'] = "User Registered Successfully";
          file_put_contents("../db/user/".$email.".json" , json_encode($data));
          header('location:  admin_dashboard.php');
      }
   }

}

}else{

  echo 'NO form have been submitted';
}

 ?>
