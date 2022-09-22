<?php
    session_start();

    include('../connections/connect.php');

    //Ensure that a Member is Still Logged In
    /*if ($_SESSION['loggedInMemberID'] == "") {
        header("Location: ../index.php");
    }*/

    //Log Out User and Return to Sign In Screen
    if (array_key_exists('btnLogOut', $_POST)) {    
        $_SESSION['loggedInMemberID'] = "";         
        header("Location: ../index.php");  
    }

    //Change to Available Books Screen
    if (array_key_exists('btnRentedBooks', $_POST)) {       
        header("Location: memberRented.php");
    }

    //Change to Rented Books Screen
    if (array_key_exists('btnAvailableBooks', $_POST)) {       
        header("Location: memberAvailable.php");
    }

    //Change to Account Information Screen
    if (array_key_exists('btnAccInfo', $_POST)) {
        header("Location: memberAccInfo.php");
    }

    //Change to Rented History Screen
    if (array_key_exists('btnRentedHistory', $_POST)) {       
        header("Location: memberRentedHistory.php");
    }

    //Change to Outstanding (Rented) Screen
    if (array_key_exists('btnRented', $_POST)) {       
        header("Location: memberRented.php");
    }

    //Change to Book Info Screen
    if (array_key_exists('btnMoreInfo', $_POST)) {
        $bookID = $_POST['btnMoreInfo'];
        $_SESSION['bookID'] = $bookID;
        
        header("Location: memberBookInfo.php");
    }

    //Return to Available Books Screen
    if (array_key_exists('btnCancelRentBook', $_POST)) {       
        header("Location: memberAvailable.php");
    }

    //Rent Book
    if (isset($_POST['btnRentBook'])) { 

    }

    //Return to Rented Books Screen
    if (array_key_exists('btnCancelUpdate', $_POST)) {       
        header("Location: memberRented.php");
    }

    //Update Member's Information
    if (isset($_POST['btnSubmitUpdate'])) { 

    }
    
?>