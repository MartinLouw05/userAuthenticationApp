<?php
    session_start();

    include('./connections/connect.php');

    //Return to Sign In Screen
    if (array_key_exists('btnRegisterCancel', $_POST)) {
        header("Location: ./index.php");
    }

?>