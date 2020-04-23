<?php

// function error_msg() {
//     if(isset($_SESSION['error'])) {
//         echo "<span style='color:red';>". $_SESSION['error']. "</span><br>";
//         unset($_SESSION['error']);
//     }
// }

// function f_name_err() {
//     if(isset($_SESSION['f_name_err'])){
//         echo "<span style='color:red';>". $_SESSION['f_name_err']. "</span><br>";
//         unset($_SESSION['f_name_err']);
//     }
// }


function print_err_msg ($err_type = 'error', $color = 'red') {
    if(isset($_SESSION[$err_type])) {
    echo "<span style='color:".$color."';>". $_SESSION[$err_type]. "</span><br>";
    unset($_SESSION[$err_type]);
    }
}

function print_msg($msg_type = 'message', $color = 'green') {
    if(isset($_SESSION[$msg_type]) && !empty($_SESSION[$msg_type])){
        echo "<span style ='color:".$color."'>" . $_SESSION[$msg_type] . "</span> ";
        session_destroy();
    }
}
