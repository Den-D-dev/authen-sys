<?php
session_start();
////ERROR ARRAY;
$errors= array();

//input variable///////
$firstname   = "";
$lastname    = "";
$gender      = "";
$dapartment  = "";
$email       = "";
$designation = "";
$password    = "";


// Validate form fields
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //store session for input
    $_SESSION ['fname'] = $firstname;
    $_SESSION ['lname'] = $lastname;
    $_SESSION ['email'] = $email;
    $_SESSION ['gender'] = $gender;
    $_SESSION ['designation'] = $designation;
    $_SESSION ['department'] = $department;

     // Validate first name
    if(empty($_POST['fname'])){
        $errors['firstname'] = "";
        $_SESSION['firstname'] = 'Name is required';
       header('location: register.php');

    } else {
    $firstname=$_POST['fname'];
     if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $firstname)){
         $errors['firstname'] = "";
         $_SESSION['firstname'] = 'Numbers not required in name field';
         header('location: register.php');
     } else if(strlen($firstname) <= 2){
         $errors['firstname'] = "";
         $_SESSION['firstname'] = 'Name must not be short';
         header('location: register.php');
     } else if(is_numeric($firstname )){
         $errors['firstname'] = "";
         $_SESSION['firstname'] = 'Numbers not required in name field';
         header('location: register.php');
      }
    }


    // Validate last name
    if(empty($_POST['lname'])){
        $errors['lastname'] = "";
        $_SESSION['lastname'] = 'LastName is required';
        header('location: register.php');
    } else {
    $lastname=$_POST['lname'];
        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $lastname)){
            $errors['lastname'] = "";
            $_SESSION['lastname'] = 'Numbers not required in lastname field';
            header('location: register.php');
        } else if(strlen($lastname) <= 2){
            $errors['lastname'] = "";
            $_SESSION['lastname'] = 'LastName must not be short';
            header('location: register.php');
        } else if(is_numeric($lastname )){
            $errors['lastname'] = "";
            $_SESSION['lastname'] = 'Numbers not required in lastname field';
            header('location: register.php');
        }
    }


      //Validate gender
    if($_POST['gender'] == " "){
        $errors['gender'] = '';
        $_SESSION['gender'] = 'Gender is required';
        header('location: register.php');
    }else{
        $gender=$_POST['gender'];

    }

        //Validate dept
    if(empty($_POST['department'])){
        echo $errors['department'] = "";
        $_SESSION['department'] = 'department is required';
        header('location: register.php');
    }else{
        $department=$_POST['department'];

    }

    //Validate Designation
    if($_POST['designation'] == " "){
        $errors['designation'] = '';
        $_SESSION['designation'] = 'designation is required';
        header('location: register.php');
    }else{
        $designation=$_POST['designation'];
    }

    //Validate Password
    if(empty($_POST['password'])){
        $errors['password'] = '';
        $_SESSION['password'] = 'password is required';
        header('location: register.php');
    }else{
        $password = $_POST['password'];
        if(strlen($password) <= 7){
            $errors['password'] = '';
            $_SESSION['password'] = 'paasword must atleast be 8 characters';
            header('location: register.php');
        }
    }


      //Validate Email
    if(empty($_POST['email'])){
        $errors['email'] = '';
        $_SESSION['email'] = 'email is required';
        header('location: register.php');
    }else{
        $email=$_POST['email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = '';
            $_SESSION['email'] = 'Invalid email';
            header('location: register.php');
        } else if(strlen($email) <= 5){
            $errors['email'] = '';
            $_SESSION['email'] = 'Email must not contain more than 5 characters';
            header('location: register.php');
        } else if(!strpos($email, '.')){
            $errors['email'] = '';
            $_SESSION['email'] = 'Email must contain ' . "." . 'symbol';
            header('location: register.php');
        }
    }


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
        $reg_time = date("h:i:sa");
        $reg_date = date("Y-m-d");

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
            echo $errors['user'] = '';
            $_SESSION['user'] = 'User with the same email already exist';
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
