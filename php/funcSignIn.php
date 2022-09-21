<?php
    session_start();

    include('./connections/connect.php');

    if(isset($_POST['btnLogIn'])) {
        //User Input
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Validation
        
    }

    //Change to Create New Account Screen
    if (array_key_exists('btnRegister', $_POST)) {
        header("Location: indexRegister.php");
    }

    //Change to Forgot Password Screen
    if (array_key_exists('btnForgotPassword', $_POST)) {     
        header("Location: indexForgotPassword.php");  
    }

    
?>