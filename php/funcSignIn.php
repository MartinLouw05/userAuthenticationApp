<?php
    session_start();

    include('./connections/connect.php');

    //Log Out any Member when this Screen is Loaded
    $_SESSION['loggedInMemberID'] = "";

    //Change Book Status if Overdue
    $sql = "SELECT * FROM books_rented 
            WHERE NOT books_rented_status_id = '2'";

    $result = $conn->query($sql);

    $today = date('Y-m-d');

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['rented_return_date'] < $today) {
                    $rentalID = $row['rented_id'];
                    $rentalStatus = 4;  //Set Status to Overdue

                    $sql = "UPDATE books_rented 
                            SET books_rented_status_id = '$rentalStatus' 
                            WHERE rented_id = '$rentalID'";

                    if ($conn->query($sql) === TRUE) { 
                        //Books Rented Status Successfully Updated                        
                    }
                    else {
                        //Something Went Wrong While Attempting to Update Status                        
                    }                    
                }
            }
        }
    }
    else {
        echo "Error selecting table " . $conn->error;
    }
    
    //Change to Create New Account Screen
    if (array_key_exists('btnRegister', $_POST)) {
        header("Location: indexRegister.php");
    }

    //Change to Forgot Password Screen
    if (array_key_exists('btnForgotPassword', $_POST)) {     
        header("Location: indexForgotPassword.php");  
    }

    //Log In
    if(isset($_POST['btnLogIn'])) {
        //User Input
        $email = $_POST['email'];
        $password = $_POST['password'];

        $logInAttempt = array();

        //Validation
        $sql = "SELECT * FROM members";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 							
                    if ($email == $row['member_email'] && $password == $row['member_password']) {
                        array_push($logInAttempt, "success");
                        $memberRole = $row['role_id'];
                        $memberID = $row['member_id'];
                        $_SESSION['loggedInRoleID'] = $memberRole;
                        $_SESSION['loggedInMemberID'] = $memberID;
                    }
                    else {
                        array_push($logInAttempt, "failure");
                    }                    
               	}
            }
            matchingUser($logInAttempt);
        }
        else {
            echo "Error selecting table " . $conn->error;
        } 
    }

    //Check for Matching User
    function matchingUser($logInAttempt) {
        if (in_array("success", $logInAttempt)) {
            roleValidation();
        }
        else {
            echo "  <script>  
                        alert('Email or Password is Incorrect.  Please Try Again.'); 
                        window.location.href = './index.php';
                    </script>";
        }
    }

    //Check User Role
    function roleValidation() {
        if ($_SESSION['loggedInRoleID'] == "1") {
            header("Location: ./member/memberRented.php");
        }
        elseif ($_SESSION['loggedInRoleID'] == "2") {
            header("Location: ./librarian/librarianRented.php");
        }
        else {
            echo "  <script> 
                        alert('Something Went Wrong while Attempting to Retrieve the User's Role.  Returning to Sign In Page.'); 
                        window.location.href = './index.php';   
                    </script>";
        }
    }
?>