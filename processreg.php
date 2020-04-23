<?php
session_start();
////ERROR ARRAY;
$errors= array();



// Validate form fields
if($_SERVER["REQUEST_METHOD"] == "POST"){

     // Validate first name
    if(empty($_POST['fname'])){
        $errors['f_name_err'] = "";
        $_SESSION['f_name_err'] = 'First name is required';
       header('location: register.php');

    } else {
    $firstname=$_POST['fname'];
     if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $firstname)){
         $errors['f_name_err'] = "";
         $_SESSION['f_name_err'] = 'Numbers not required in name field';
         header('location: register.php');
     } else if(strlen($firstname) <= 2){
         $errors['f_name_err'] = "";
         $_SESSION['f_name_err'] = 'First name must not be short';
         header('location: register.php');
     } else if(is_numeric($firstname )){
         $errors['f_name_err'] = "";
         $_SESSION['f_name_err'] = 'Numbers not required in name field';
         header('location: register.php');
      }
    }


    // Validate last name
    if(empty($_POST['lname'])){
        $errors['l_name_err'] = "";
        $_SESSION['l_name_err'] = 'last name is required';
        header('location: register.php');
    } else {
    $lastname=$_POST['lname'];
        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $lastname)){
            $errors['l_name_err'] = "";
            $_SESSION['l_name_err'] = 'Numbers not required in lastname field';
            header('location: register.php');
        } else if(strlen($lastname) <= 2){
            $errors['l_name_err'] = "";
            $_SESSION['l_name_err'] = 'Last name must not be short';
            header('location: register.php');
        } else if(is_numeric($lastname )){
            $errors['l_name_err'] = "";
            $_SESSION['l_name_err'] = 'Numbers not required in lastname field';
            header('location: register.php');
        }
    }


      //Validate gender
    if(empty($_POST['gender'])){
        $errors['gender_err'] = '';
        $_SESSION['gender_err'] = 'Gender is required';
        header('location: register.php');
    }else{
        $gender=$_POST['gender'];

    }

        //Validate dept
    if(empty($_POST['department'])){
        echo $errors['dept_err'] = "";
        $_SESSION['dept_err'] = 'Department is required';
        header('location: register.php');
    }else{
        $department=$_POST['department'];

    }

    //Validate Designation
    if(empty($_POST['designation'])){
        $errors['desig_err'] = '';
        $_SESSION['desig_err'] = 'Designation is required';
        header('location: register.php');
    }else{
        $designation=$_POST['designation'];
    }

    //Validate Password
    if(empty($_POST['password'])){
        $errors['pwd_err'] = '';
        $_SESSION['pwd_err'] = 'Password is required';
        header('location: register.php');
    }else{
        $password = $_POST['password'];
        if(strlen($password) <= 7){
            $errors['pwd_err'] = '';
            $_SESSION['pwd_err'] = 'Password must atleast be 8 characters';
            header('location: register.php');
        }
    }


      //Validate Email
    if(empty($_POST['email'])){
        $errors['email_err'] = '';
        $_SESSION['email_err'] = 'Email is required';
        header('location: register.php');
    }else{
        $email=$_POST['email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Invalid email';
            header('location: register.php');
        } else if(strlen($email) <= 5){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Email must not contain more than 5 characters';
            header('location: register.php');
        } else if(!strpos($email, '.')){
            $errors['email_err'] = '';
            $_SESSION['email_err'] = 'Email must contain ' . "." . 'symbol';
            header('location: register.php');
        }
    }

    //store session for input
    $_SESSION ['fname'] = $firstname;
    $_SESSION ['lname'] = $lastname;
    $_SESSION ['email'] = $email;
    $_SESSION ['gender'] = $gender;
    $_SESSION ['designation'] = $designation;
    $_SESSION ['department'] = $department;


    //checking for errors before iserting into database;

    if (count($errors) > 0) {
    // header('location: register.php');
     // print_r('you have  errors');
    }else{
        echo 'success'. "<br>";
        //counting users in the db/users folder and auto incrementing user_id
        $all_users = scandir("db/user/");
        $count_users = count($all_users);
        $user_id = $count_users-1;
        date_default_timezone_set("Africa/Lagos");
        $reg_time = date("h:i A");
        $reg_date = date("F\, jS Y ");

    //putting user info into an array object for proper storage in the file system
        $data=[
            'id'          => $user_id,
            'reg_time'    => $reg_time,
            'reg_date'    => $reg_date,
            'logout_date' => "",
            'logout_time' => "",
            'firstname'   => $firstname,
            'lastname'    => $lastname,
            'email'       => $email,
            'gender'      => $gender,
            'designation' => $designation,
            'department'  => $department,
            'password'    => password_hash($password, PASSWORD_DEFAULT)
        ];

        $_SESSION['data'] = $data;

    //checking if user already exist in db
    for ($counter=0; $counter < $count_users ; $counter++) {
        $current_user = $all_users[$counter];

        if($current_user == $email.".json"){
            echo $errors['user_err'] = '';
            $_SESSION['user_err'] = 'User with the same email already exist';
            header('location: register.php');
            die();
        }
    }

    // go ahead and add user
    file_put_contents("db/user/".$email.".json" , json_encode($data));
    header('location:  login.php');
    $_SESSION['message'] = "Registration was successful!, you can now login - " .$firstname;
    }

}else{

    echo 'NO form have been submitted';
}

?>
