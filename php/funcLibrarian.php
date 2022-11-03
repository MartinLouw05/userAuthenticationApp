<?php
    session_start();

    include('../connections/connect.php');

    //Ensure that a Librarian is Still Logged In
    if ($_SESSION['loggedInMemberID'] == "") {
        header("Location: ../index.php");
    }

    //Return to Librarian Home
    if (array_key_exists('btnHome', $_POST)) {            
        header("Location: librarianRented.php");  
    }

    //Log Out User and Return to Sign In Screen
    if (array_key_exists('btnLogOut', $_POST)) {    
        $_SESSION['loggedInMemberID'] = "";         
        header("Location: ../index.php");  
    }

    //Change to Books Screen
    if (array_key_exists('btnDisplayBooks', $_POST)) {       
        header("Location: librarianBooks.php");
    }

    //Change to Rented Books Screen
    if (array_key_exists('btnDisplayRented', $_POST)) {       
        header("Location: librarianRented.php");
    }

    //Change to Members Screen
    if (array_key_exists('btnDisplayMembers', $_POST)) {       
        header("Location: librarianMembers.php");
    }

    //Change to Authors Screen
    if (array_key_exists('btnDisplayAuthors', $_POST)) {       
        header("Location: librarianAuthors.php");
    }

    //Change to Add Book Screen
    if (array_key_exists('btnAddBook', $_POST)) {       
        header("Location: librarianAddBook.php");
    }

    //Change to Add Author Screen
    if (array_key_exists('btnAddAuthor', $_POST)) {       
        header("Location: librarianAddAuthor.php");
    }

    //Change to Rented History Screen
    if (array_key_exists('btnRentedHistory', $_POST)) {       
        header("Location: librarianRentedHistory.php");
    }

    //Change to Outstanding (Rented) Screen
    if (array_key_exists('btnRented', $_POST)) {       
        header("Location: librarianRented.php");
    }

    //Change to Collections Screen
    if (array_key_exists('btnCollections', $_POST)) {       
        header("Location: librarianCollections.php");
    }

    //Change to Member Rented History Screen
    if (array_key_exists('btnMemberHistory', $_POST)) {  
        $memberID = $_POST['btnMemberHistory'];
        $_SESSION['memberHistoryID'] = $memberID;   

        header("Location: librarianMemberHistory.php");
    }

    //Change to Book's History Screen
    if (array_key_exists('btnBookHistory', $_POST)) {  
        $bookID = $_POST['btnBookHistory'];
        $_SESSION['bookHistoryID'] = $bookID;   

        header("Location: librarianBookHistory.php");
    }

    //Create New Book
    if (isset($_POST['btnSubmitBook'])) {
        //Book Information
        $bookName = $_POST['bookName'];
        $bookGenre = $_POST['bookGenre'];
        $bookAuthor = $_POST['bookAuthor'];
        $bookPublishedDate = $_POST['bookPublishedDate'];
        $bookDesc = $_POST['bookDesc'];

        $bookStatus = 1;  //Book Status will be Available by Default

        //Save Book Information
        if ($bookName == "" || $bookGenre == "" || $bookAuthor == "" || $bookPublishedDate == "" || $bookDesc == "") {
            echo "<script> alert('Please Ensure that All Fields have been Filled'); </script>";
        }
        else {
            $sql = "INSERT INTO books (book_name, book_desc, book_published_date, genre_id, status_id, author_id)
            VALUES ('$bookName', '$bookDesc', '$bookPublishedDate', '$bookGenre', '$bookStatus', '$bookAuthor');";

            //Check if Insert was Succesful
            if ($conn->query($sql) === TRUE) {
                echo "  <script> 
                            alert('New Book Created Successfully'); 
                            window.location.href = 'librarianBooks.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel New Book Creation
    if (array_key_exists('btnCancelBook', $_POST)) { 
        header("Location: librarianBooks.php");
    }

    //Update Book
    if (array_key_exists('btnUpdateBook', $_POST)) {
        $bookID = $_POST['btnUpdateBook'];
        $_SESSION['bookID'] = $bookID;
        
        header("Location: librarianUpdateBook.php");
    }

    //Save Updated Book
    if (isset($_POST['btnSubmitUpdateBook'])) {
        //Book Information
        $bookID = $_SESSION['bookID'];
        $bookName = $_POST['bookName'];
        $bookGenre = $_POST['bookGenre'];
        $bookAuthor = $_POST['bookAuthor'];
        $bookPublishedDate = $_POST['bookPublishedDate'];
        $bookDesc = $_POST['bookDesc'];
        $bookDesc = preg_replace("/[^A-Za-z0-9 ]/", '', $bookDesc);

        //Save Book Information
        if ($bookName == "" || $bookGenre == "" || $bookAuthor == "" || $bookPublishedDate == "" || $bookDesc == "") {
            echo "<script> alert('Please Ensure that All Fields have been Filled'); </script>";
        }
        else {
            $sql = "UPDATE books 
                    SET book_name = '$bookName', book_published_date = '$bookPublishedDate', genre_id = '$bookGenre', author_id = '$bookAuthor', book_desc = '$bookDesc'
                    WHERE book_id = '$bookID'";

            //Check if Update was Successful
            if ($conn->query($sql) === TRUE) {
                echo "  <script> 
                            alert('Book Information Updated Successfully'); 
                            window.location.href = 'librarianBooks.php';
                        </script>";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel Book Update
    if (array_key_exists('btnCancelUpdateBook', $_POST)) { 
        header("Location: librarianBooks.php");
    }

    //Book Lost
    if (array_key_exists('btnDeleteBook', $_POST)) {
        $bookID = $_POST['btnDeleteBook'];
        $bookStatus = 3; //Set Book Status to Inactive
        
        $sql = "UPDATE books 
                SET status_id = '$bookStatus' 
                WHERE book_id = '$bookID'";
        
        //Check if Update was Successful
        if ($conn->query($sql) === TRUE) {
            echo "  <script> 
                        alert('Book Successfully Marked as Inactive');
                        window.location.href = 'librarianBooks.php';
                    </script>";            
        } 
        else {
            echo "Error deleting book: " . $conn->error;
        }
    }

    //Update Member
    if (array_key_exists('btnUpdateMember', $_POST)) {
        $memberID = $_POST['btnUpdateMember'];
        $_SESSION['memberID'] = $memberID;
        
        header("Location: librarianUpdateMember.php");
    }

    //Save Updated Member Information
    if (isset($_POST['btnSubmitUpdateMember'])) {
        //Member Information
        $memberID = $_SESSION['memberID'];
        $memberName = $_POST['memberName'];
        $memberSurname = $_POST['memberSurname'];
        $memberDob = $_POST['memberDob'];
        $memberEmail = $_POST['memberEmail'];
        $memberContact = $_POST['memberContact'];
        $memberRole = $_POST['memberRole'];

        //Save Member Information
        if ($memberName == "" || $memberSurname == "" || $memberDob == "" || $memberEmail == "" || $memberContact == "") {
            if (strlen($memberContact) == 10) {
                echo "<script> alert('Please Ensure that All Fields have been Filled'); </script>";
            }
            else {
                echo "<script> alert('Please Ensure that All Fields have been Filled and that the Contact Number is Equal to 10 Digits'); </script>";
            }            
        }
        elseif (strlen($memberContact) !== 10) {
            echo "<script> alert('Please Ensure that the Contact Number is Equal to 10 Digits'); </script>";
        }
        else {
            $sql = "UPDATE members 
                    SET member_name = '$memberName', member_surname = '$memberSurname', member_date_of_birth = '$memberDob', member_email = '$memberEmail', member_contact_number = '$memberContact' 
                    WHERE member_id = '$memberID'";

            //Check if Update was Succesful
            if ($conn->query($sql) === TRUE) {
                echo "  <script> 
                            alert('Member Information Updated Successfully'); 
                            window.location.href = 'librarianMembers.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel Member Information Update
    if (array_key_exists('btnCancelUpdateMember', $_POST)) { 
        header("Location: librarianMembers.php");
    }

    //Create New Author
    if (isset($_POST['btnSubmitAuthor'])) {
        //Author Information
        $authorName = $_POST['authorName'];
        $authorSurname = $_POST['authorSurname'];
        $authorDob = $_POST['authorDob'];

        //Add Author Genres
        $authorGenre = array();

        if (!empty($_POST['authorGenre']) && is_array($_POST['authorGenre'])) {
            foreach ($_POST['authorGenre'] as $selectedGenre) {
                $authorGenre[] = $selectedGenre;
            }            
        }

        //Save Author Information
        if ($authorName == "" || $authorSurname == "" || $authorDob == "" || count($authorGenre) == 0) {
            echo "  <script> 
                        alert('Please Ensure that All Fields have been Filled'); 
                        window.location.href = 'librarianAddAuthor.php';
                    </script>";
        }
        else {            
            $sql = "INSERT INTO authors (author_name, author_surname, author_dob)
                    VALUES ('$authorName', '$authorSurname', '$authorDob');";

            //Check if Insert was Successful
            if ($conn->query($sql) === TRUE) {
                $lastID = $conn->insert_id;

                for ($i = 0; $i < count($authorGenre); $i++) {
                    $sql = "INSERT INTO authors_genre (author_id, genre_id) 
                    VALUES ('$lastID', '$authorGenre[$i]')";

                    if ($conn->query($sql) === TRUE) { 
                        //Author Genre Added Successfully
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                echo "  <script> 
                            alert('New Author Created Successfully'); 
                            window.location.href = 'librarianAuthors.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel New Author Creation
    if (array_key_exists('btnCancelAuthor', $_POST)) { 
        header("Location: librarianAuthors.php");
    }

    //Update Author
    if (array_key_exists('btnUpdateAuthor', $_POST)) {
        $authorID = $_POST['btnUpdateAuthor'];
        $_SESSION['authorID'] = $authorID;
        
        header("Location: librarianUpdateAuthor.php");
    }

    //Save Updated Author Information
    if (isset($_POST['btnSubmitUpdateAuthor'])) {
        //Author Information
        $authorID = $_SESSION['authorID'];
        $authorName = $_POST['authorName'];
        $authorSurname = $_POST['authorSurname'];
        $authorDob = $_POST['authorDob'];

        //Add Author Genres
        $authorGenre = array();

        if (!empty($_POST['authorGenre']) && is_array($_POST['authorGenre'])) {
            foreach ($_POST['authorGenre'] as $selectedGenre) {
                $authorGenre[] = $selectedGenre;
            }            
        }

        //Save Updated Author Information
        if ($authorName == "" || $authorSurname == "" || $authorDob == "" || count($authorGenre) == 0) {
            echo "<script> alert('Please Ensure that All Fields have been Filled'); </script>";
        }
        else {           
            $sql = "UPDATE authors 
                    SET author_name = '$authorName', author_surname = '$authorSurname', author_dob = '$authorDob' 
                    WHERE author_id = '$authorID'";

            //Check if Update was Successful
            if ($conn->query($sql) === TRUE) {

                //Add and Delete Genres
                $sql = "DELETE FROM authors_genre
                        WHERE author_id = $authorID";

                if ($conn->query($sql) === TRUE) { 
                    //Author Genre Removed Successfully
                    for ($i = 0; $i < count($authorGenre); $i++) {
                        $sql = "INSERT INTO authors_genre (author_id, genre_id) 
                                VALUES ('$authorID', '$authorGenre[$i]')";
    
                        if ($conn->query($sql) === TRUE) { 
                            //Author Genre Added Successfully
                            echo "  <script> 
                                        alert('Author Information Updated Successfully'); 
                                        window.location.href = 'librarianAuthors.php';
                                    </script>";
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel Author Information Update
    if (array_key_exists('btnCancelUpdateAuthor', $_POST)) { 
        header("Location: librarianAuthors.php");
    }

    //Book Collected
    if (array_key_exists('btnCollectBook', $_POST)) { 
        $rentedID = $_POST['btnCollectBook'];
        $rentedStatus = 1; //Set Rented Status to Active

        $sql = "UPDATE books_rented 
                SET books_rented_status_id = '$rentedStatus' 
                WHERE rented_id = '$rentedID'";
        
        //Check if Update was Successful
        if ($conn->query($sql) === TRUE) { 
            echo "  <script> 
                        alert('A Book has been Successfully Collected.'); 
                        window.location.href = 'librarianRented.php';
                    </script>";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    //Book Returned
    if (array_key_exists('btnReturnBook', $_POST)) {
        $rentedID = $_POST['btnReturnBook'];
        $rentedStatus = 2;  //Set Rental Status as Completed
        $today = date('Y-m-d');

        $sql = "UPDATE books_rented 
                SET books_rented_status_id = '$rentedStatus', rented_date_returned = '$today' 
                WHERE rented_id = '$rentedID'";       

        //Check if Update was Successful
        if ($conn->query($sql) === TRUE) {
            //Retrieve Book ID to Update its Status
            $sql = "SELECT * FROM books_rented 
                    WHERE rented_id = '$rentedID'";

            $bookIdResult = $conn->query($sql);

            if ($bookIdResult) {
                if ($bookIdResult->num_rows > 0) {
                    while ($row = $bookIdResult->fetch_assoc()) { 
                        //Update Book Status
                        $bookID = $row['book_id'];
                        $bookStatus = 1; //Set Book Status as Available

                        $sql = "UPDATE books 
                                SET status_id = '$bookStatus' 
                                WHERE book_id = '$bookID'";
                        
                        //Check if Update was Successful
                        if ($conn->query($sql) === TRUE) { 
                            echo "  <script> 
                                        alert('A Book has been Successfully Returned.'); 
                                        window.location.href = 'librarianRented.php';
                                    </script>";
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            }
            else {
                echo "Error selecting table " . $conn->error;
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }             
    }

    //Books Search Functions
    if (array_key_exists('btnBookSearch', $_POST)) {
        $searchCriteria = $_POST['searchSelect'];
        $librarianSearch = $_POST['searchInput'];

        if ($searchCriteria == "book") {
            if ($librarianSearch) {
                $_SESSION['librarianSearch'] = $librarianSearch;
                header('Location: librarianBooksSearch.php');
            }
            else {
                header('Location: librarianBooks.php');
            }
        }
        elseif ($searchCriteria == "author") {
            if ($librarianSearch) {
                $_SESSION['librarianSearch'] = $librarianSearch;
                header('Location: librarianBooksAuthorSearch.php');
            }
            else {
                header('Location: librarianBooks.php');
            }
        }
        else {
            //Do Nothing
        }
    }

    //Rented Search Functions
    if (array_key_exists('btnRentedSearch', $_POST)) {
        $librarianSearch = $_POST['rentedSearch'];

        if ($librarianSearch) {
            $_SESSION['librarianSearch'] = $librarianSearch;
            header('Location: librarianRentedSearch.php');
        }
        else {
            header('Location: librarianRented.php');
        }
    }

    //Rented History Search
    if (array_key_exists('btnRentedHistorySearch', $_POST)) {
        $librarianSearch = $_POST['rentedHistorySearch'];

        if ($librarianSearch) {
            $_SESSION['librarianSearch'] = $librarianSearch;
            header('Location: librarianRentedHistorySearch.php');
        }
        else {
            header('Location: librarianRentedHistory.php');
        }
    }

    //Members Search Functions
    if (array_key_exists('btnMemberSearch', $_POST)) {
        $librarianSearch = $_POST['memberSearch'];

        if ($librarianSearch) {
            $_SESSION['librarianSearch'] = $librarianSearch;
            header('Location: librarianMembersSearch.php');
        }
        else {
            header('Location: librarianMembers.php');
        }
    }

    //Authors Search Functions
    if (array_key_exists('btnAuthorSearch', $_POST)) {
        $librarianSearch = $_POST['authorSearch'];

        if ($librarianSearch) {
            $_SESSION['librarianSearch'] = $librarianSearch;
            header('Location: librarianAuthorsSearch.php');
        }
        else {
            header('Location: librarianAuthors.php');
        }
    }

?>