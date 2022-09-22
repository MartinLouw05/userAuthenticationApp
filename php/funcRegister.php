<?php
    session_start();

    include('./connections/connect.php');

    //Return to Sign In Screen
    if (array_key_exists('btnRegisterCancel', $_POST)) {
        header("Location: ./index.php");
    }

    //Create New User
    if (isset($_POST['btnRegisterSubmit'])) {
        //User Information
        $memberName = $_POST['registerName'];
        $memberSurname = $_POST['registerSurname'];
        $memberEmail = $_POST['registerEmail'];
        $memberDoB = $_POST['registerDoB'];
        $memberContact = $_POST['registerNumber'];
        $memberPassword = $_POST['registerPassword'];
        $memberReEnterPassword = $_POST['registerReEnterPassword'];
        $memberRole = 1;    //New Members Are Given the Role of Member by Default
        
        //Validation
        if ($memberName == "" || $memberSurname == "" || $memberEmail == "" || $memberDoB == "" || $memberContact == "" || $memberPassword == "" || $memberReEnterPassword == "") {
            echo "  <script> 
                        alert('Please Ensure that All Fields have been Filled'); 
                        window.location.href = './indexRegister.php';
                    </script>";
        }
        //Ensure that the Contact Number is 10 Digits
        elseif (strlen($memberContact) !== 10) {
            echo "  <script> 
                        alert('Please Ensure that the Contact Number is Equal to 10 Digits'); 
                        window.location.href = './indexRegister.php';
                    </script>";
        }
        //Check if Email Already Exists
        else {
            $sql = "SELECT member_email FROM members";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                        if ($row['member_email'] == $memberEmail) {
                            //Check if Passwords Match
                            if ($memberPassword == $memberReEnterPassword) {
                                $sql = "INSERT INTO members (member_name, member_surname, member_date_of_birth, member_email, member_password, member_contact_number, role_id) 
                                        VALUES ('$memberName', '$memberSurname', '$memberDoB', '$memberEmail', '$memberPassword', '$memberContact', '$memberRole')";
    
                                //Check if Insert was Succesful
                                if ($conn->query($sql) === TRUE) {
                                    echo "  <script> 
                                                alert('Your Account Has Been Successfully Created.  Please Try Signing In.'); 
                                                window.location.href = './index.php';
                                            </script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                            else {
                                echo "  <script> 
                                            alert('The Entered Passwords Do Not Match.  Please Try Again.');
                                            window.location.href = './indexForgotPassword.php';
                                        </script>";
                            }
                        }
                        else {
                            echo "  <script>  
                                        alert('An Account with this Email Already Exists.  Please Try Again.'); 
                                        window.location.href = './indexRegister.php';
                                    </script>";  
                        }                        
                    }
                }
                else {
                    echo "  <script>  
                                alert('No Matching User Information Found.  Please Try Again.'); 
                                window.location.href = './indexRegister.php';
                            </script>";   
                }
            }
            else {
                echo "Error selecting table " . $conn->error;
            }        
        }
    }

?>