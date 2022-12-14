<?php
    session_start();

    include('../connections/connect.php');

    //Ensure that a Member is Still Logged In
    if ($_SESSION['loggedInMemberID'] == "") {
        header("Location: ../index.php");
    }

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
        $rentedStatus = '3';    //Set Rented Status to Reserved
        $bookStatus = '2';      //Set Book Status to Unavailable

        //Calculate Return Date
        $today = date('Y-m-d');
        $returnDate = date_add(date_create($today), date_interval_create_from_date_string("30 days"));
        $returnDate = date_format($returnDate, 'Y-m-d');

        $sql = "UPDATE books 
                SET status_id = '$bookStatus' 
                WHERE book_id = '$bookID'";

        //Check if Update was Successful
        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO books_rented (book_id, member_id, rented_date, rented_return_date, books_rented_status_id) 
                    VALUES ('$bookID', '$memberID', '$today', '$returnDate', '$rentedStatus');";

            if ($conn->query($sql) === TRUE) {        
                echo "  <script> 
                            alert('A Book has been Successfully Rented.  Please Collect the Book from the Library within the Next 3 Days.'); 
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
                        //Check if Passwords Match
                        if ($memberPassword == $memberReEnterPassword) {
                            //Hash Password
                            $memberPassword = password_hash($memberPassword, PASSWORD_DEFAULT);

                            $sql = "UPDATE members 
                                    SET member_name = '$memberName', member_surname = '$memberSurname', member_date_of_birth = '$memberDoB', member_email = '$memberEmail', member_contact_number = '$memberContact', member_password = '$memberPassword' 
                                    WHERE member_id = '$memberID'";

                            //Check if Insert was Succesful
                            if ($conn->query($sql) === TRUE) {
                                echo "  <script> 
                                            alert('Your Account Information Has Been Successfully Updated.'); 
                                            window.location.href = './memberRented.php';
                                        </script>";
                            } else {
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

    //Rented Search Function
    if (array_key_exists('btnRentedSearch', $_POST)) {
        $memberSearch = $_POST['rentedSearch'];

        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberRentedSearch.php');
        }
        else {
            header('Location: memberRented.php');
        }
    }

    //Rented History Search Function
    if (array_key_exists('btnRentedHistorySearch', $_POST)) {
        $memberSearch = $_POST['rentedSearch'];

        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberRentedHistorySearch.php');
        }
        else {
            header('Location: memberRentedHistory.php');
        }
    }

    //Available Books Search Function
    if (array_key_exists('btnAvailableSearch', $_POST)) {
        $memberSearch = $_POST['availableSearch'];
        
        if ($memberSearch) {
            $_SESSION['memberSearch'] = $memberSearch;
            header('Location: memberAvailableSearch.php');
        }
        else {
            header('Location: memberAvailable.php');
        }
    }
    
?>