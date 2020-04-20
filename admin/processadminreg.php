<?php
session_start();
$errors = array();


$firstname   = "";
$lastname    = "";
$gender      = "";
$dapartment  = "";
$email       = "";
$designation = "";
$password    = "";

// Validate form fileds

if($_SERVER["REQUEST_METHOD"] == "POST"){

 //Validate first name
      if(empty($_POST['fname'])){
            $errors['firstname']= "";
            $_SESSION['firstname']='Name is required';
           header('location: admin_add_user.php');
      }else{
        $firstname=$_POST['fname'];
        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $firstname)){
            $errors['firstname'] = '';
            $_SESSION['firstname'] = 'Numbers not required in name field';
            header('location: admin_add_user.php');
        } else if(strlen($firstname) <= 2){
            echo $errors['firstname'] = '';
            $_SESSION['firstname'] = 'Name must not be short';
            header('location: admin_add_user.php');
        } else if(is_numeric($firstname )){
            echo $errors['firstname'] = '';
            $_SESSION['firstname'] = 'Numbers not required in name field';
            header('location: admin_add_user.php');
        }
      }

      // Validation last name
      if(empty($_POST['lname'])){
         $errors['lastname']="";
         $_SESSION['lastname']='LastName is required';
         header('location: admin_add_user.php');
      }else{
        $lastname=$_POST['lname'];

        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $lastname)){
            $errors['lastname'] = '';
            $_SESSION['lastname'] = 'Numbers not required in lastname field';
            header('location: admin_add_user.php');
        } else if(strlen($lastname) <= 2){
            $errors['lastname'] = '';
            $_SESSION['lastname'] = 'LastName must not be short';
            header('location: admin_add_user.php');
        } else if(is_numeric($lastname )){
            $errors['lastname'] = '';
            $_SESSION['lastname'] = 'Numbers not required in lastname field';
            header('location: admin_add_user.php');
        }

      }


    //Validate Gender
    if($_POST['gender'] == " "){
        $errors['gender'] = '';
        $_SESSION['gender'] = 'Gender is required';
        header('location: admin_add_user.php');
    }else{
        $gender=$_POST['gender'];
    }


    //Validate Dept
    if(empty($_POST['department'])){
        echo $errors['department'] = "";
        $_SESSION['department'] = 'department is required';
        header('location: admin_add_user.php');
    }else{
        $department=$_POST['department'];
    }

    //Validate Designation
    if($_POST['designation'] == " "){
        $errors['designation'] = '';
        $_SESSION['designate'] = 'designation is required';
        header('location: admin_add_user.php');
    }else{
        $designation=$_POST['designation'];
    }

    //Validate password
    if(empty($_POST['password'])){
        $errors['password'] = '';
        $_SESSION['password'] = 'password is required';
        header('location: admin_add_user.php');
    }else{
        $password=$_POST['password'];
        if(strlen($password) <= 7){
            $errors['password'] = ''."<br>";
            $_SESSION['password'] = 'paasword must atleast be 8 characters';
            header('location: admin_add_user.php');
        }
    }


      //Validate email
    if(empty($_POST['email'])){
        $errors['email'] = '';
        $_SESSION['email'] = 'email is required';
        header('location: admin_add_user.php');
    }else{
        $email=$_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = '';
            $_SESSION['email'] = 'Email is invalid';
            header('location: admin_add_user.php');
        } else if(strlen($email) <= 5){
            $errors['email'] = '';
            $_SESSION['email'] = 'Email must not be less than 5';
            header('location: admin_add_user.php');
        } else if(!strpos($email, '.')){
            $errors['email'] = '';
            $_SESSION['email'] = 'Email must contain ' . "." . 'symbol';
            header('location: admin_add_user.php');
        }
    }

//checking for errors and iserting into database;

if (count($errors) > 0) {
    header('location: admin_add_user.php');
   // 'you have  errors';
}else{

    echo 'success'. "<br>";
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
          echo $errors['user'] = '';
          $_SESSION['user']='User already exist';
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
