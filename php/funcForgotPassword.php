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
                    //forgotPasswordEmail($row['member_name'], $row['member_surname'], $row['member_email']);						
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

    //THIS FUNCTION IS CREATED AS A PLACEHOLDER AND IS NOT FUNCTIONAL
    //Send Email
    function forgotPasswordEmail($memberName, $memberSurname, $memberEmail) {
        try {
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //Server settings
            //Add your own personal information below
            $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                     // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '';                                     // SMTP username
            $mail->Password   = '';                                     // SMTP password
            $mail->SMTPSecure = false;                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 2525;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($memberEmail, $memberName);               // Add a recipient

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Hotel Reservation';
            $mail->Body    = 'Dear ' . $memberName. ' ' . $memberSurname . '<br>
                            <br>
                            A request to change your password on Global Books has been submitted to us.
                            <br>
                            Please follow the link provided to change tour password: <br>
                            https://www.globalbooks.tv/passwordchange#123456789
                            <br>
                            Please contact our customer support if you did not submit this request or if you encounter any problems.
                            <br>
                            Tel: 012 345 6789<br>
                            Email: notAReal@email.com<br>
                            <br>
                            Thank you for your ongoing support<br>
                            Gloobal Books Management';

            $mail->send();
        } 
        catch (Exception $e) {
            echo "  <script>
                        alert('There was an Error while trying to Send the Email.  Please Try Again. {$mail->ErrorInfo}');
                        window.location.href = './indexForgotPassword.php';
                    </script>";
        }
    }

?>