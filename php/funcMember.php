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
        $bookID = $_SESSION['bookID'];
        $memberID = $_SESSION['loggedInMemberID'];
        $today = date('Y-m-d');
        echo "$today";
        echo "$bookID";
        echo "$memberID";

        $sql = "UPDATE books 
                SET status_id = 2 
                WHERE book_id = '$bookID';";

        //Check if Update was Successful
        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO books_rented (book_id, member_id, rented_date, rented_return_date) 
                    VALUES ('$bookID', '$memberID', '$today', '$today');";

            if ($conn->query($sql) === TRUE) {        
                echo "  <script> 
                            alert('A Book has been Successfully Rented.'); 
                            window.location.href = 'memberAvailable.php';
                        </script>";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }  
    }

    //Return to Rented Books Screen
    if (array_key_exists('btnCancelUpdate', $_POST)) {       
        header("Location: memberRented.php");
    }

    //Update Member's Information
    if (isset($_POST['btnSubmitUpdate'])) { 
        //User Information
        $memberID = $_SESSION['loggedInMemberID'];
        $memberName = $_POST['memberName'];
        $memberSurname = $_POST['memberSurname'];
        $memberEmail = $_POST['memberEmail'];
        $memberDoB = $_POST['memberDob'];
        $memberContact = $_POST['memberContact'];
        $memberPassword = $_POST['memberPassword'];
        $memberReEnterPassword = $_POST['memberReEnterPassword'];

        //Validation
        if ($memberName == "" || $memberSurname == "" || $memberEmail == "" || $memberDoB == "" || $memberContact == "" || $memberPassword == "" || $memberReEnterPassword == "") {
            echo "  <script> 
                        alert('Please Ensure that All Fields have been Filled'); 
                        window.location.href = 'memberAccInfo.php';
                    </script>";
        }
        //Ensure that the Contact Number is 10 Digits
        elseif (strlen($memberContact) !== 10) {
            echo "  <script> 
                        alert('Please Ensure that the Contact Number is Equal to 10 Digits'); 
                        window.location.href = 'memberAccInfo.php';
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
                                $sql = "UPDATE members 
                                        SET member_name = '$memberName', member_surname = '$memberSurname', member_date_of_birth = '$memberDoB', member_email = '$memberEmail', member_contact_number = '$memberContact' 
                                        WHERE member_id = '$memberID'";

                                //Check if Insert was Succesful
                                if ($conn->query($sql) === TRUE) {
                                    echo "  <script> 
                                                alert('Your Account Information Has Been Successfully Updated.'); 
                                                window.location.href = './memberRented.php';
                                            </script>";
                                } else {
                                    echo "spmetinhg went wrong";
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                            else {
                                echo "  <script> 
                                            alert('The Entered Passwords Do Not Match.  Please Try Again.');
                                            window.location.href = './memberAccInfo.php';
                                        </script>";
                            }
                        }
                        else {
                            echo "  <script>  
                                        alert('An Account with this Email Already Exists.  Please Try Again.'); 
                                        window.location.href = './memberAccInfo.php';
                                    </script>";  
                        }                        
                    }
                }
                else {
                    echo "  <script>  
                                alert('No Matching User Information Found.  Please Try Again.'); 
                                window.location.href = './memberAccInfo.php';
                            </script>";   
                }
            }
            else {
                echo "Error selecting table " . $conn->error;
            }        
        }
    }

    //Search Functions
    if (array_key_exists('btnRentedSearch', $_POST)) {
        $memberSearch = $_POST['rentedSearch'];
        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberRentedSearch.php');
        }
        else {
            //Do Nothing
        }
    }

    if (array_key_exists('btnRentedHistorySearch', $_POST)) {
        $memberSearch = $_POST['rentedSearch'];
        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberRentedHistorySearch.php');
        }
        else {
            //Do Nothing
        }
    }

    if (array_key_exists('btnAvailableSearch', $_POST)) {
        $memberSearch = $_POST['availableSearch'];
        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberAvailableSearch.php');
        }
        else {
            //Do Nothing
        }
    }
    
?>