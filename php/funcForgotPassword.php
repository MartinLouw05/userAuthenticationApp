<?php
    session_start();

    include('./connections/connect.php');

    //Return to Sign In Screen
    if (array_key_exists('btnForgotCancel', $_POST)) {
        header("Location: ./index.php");
    }

    //Forgot Password Validatiom
    if (isset($_POST['btnForgotSubmit'])) {
        //User Information
        $forgotEmail = $_POST['forgotEmail'];
        $forgotDoB = $_POST['forgotDoB'];

        $sql = "SELECT * FROM members 
                WHERE member_email = '$forgotEmail' 
                AND member_date_of_birth = '$forgotDoB'";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 							
                    echo "  <script>  
                                alert('An Mail has been Sent to your Email.  Please Check Your Inbox.'); 
                                window.location.href = './indexForgotPassword.php';
                            </script>";                   
               	}
            }
            else {
                echo "  <script>  
                            alert('No Matching User Information Found.  Please Try Again.'); 
                            window.location.href = './indexForgotPassword.php';
                        </script>";   
            }
        }
        else {
            echo "Error selecting table " . $conn->error;
        } 
    }
?>