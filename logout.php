<?php
session_start();


date_default_timezone_set("Africa/Lagos");
$last_login_time = date("h:i:sa");
$last_login_date = date("Y-m-d");

$email=$_SESSION['user_info']['email'];


$all_users= scandir("db/user/");
$count_users = count($all_users);
date_default_timezone_set("Africa/Lagos");
$login_time =date("h:i:sa");
$login_date = date("Y-m-d");


for ($counter=0; $counter < $count_users ; $counter++) {
    $current_user = $all_users[$counter];


    if($current_user ==$email.".json"){
        //checking user password from the jason content in the get_included_files
        $usercontent= file_get_contents("db/user/".$email.".json");

        $decode_user_content= json_decode($usercontent);
        $decode_user_content->logout_date=$last_login_date;
        $decode_user_content->logout_time=$last_login_time;

        unlink("db/user/".$email.".json");
        file_put_contents("db/user/".$email.".json" , json_encode($decode_user_content));
    }

}

session_destroy();
header('location: login.php');

?>
