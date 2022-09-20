<?php
    session_start();

    include('../connections/connect.php');

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

        //Save Book Information
        if ($bookName == "" || $bookGenre == "" || $bookAuthor == "" || $bookPublishedDate == "" || $bookDesc == "") {
            echo "<script> alert('Please Ensure that All Fields have been Filled'); </script>";
        }
        else {
            $sql = "UPDATE books 
                    SET book_name = '$bookName', book_desc = '$bookDesc', book_published_date = '$bookPublishedDate', genre_id = '$bookGenre', author_id = '$bookAuthor' 
                    WHERE book_id = '$bookID'";

            //Check if Insert was Succesful
            if ($conn->query($sql) === TRUE) {
                echo "  <script> 
                            alert('Book Information Updated Successfully'); 
                            window.location.href = 'librarianBooks.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    //Cancel Book Update
    if (array_key_exists('btnCancelUpdateBook', $_POST)) { 
        header("Location: librarianBooks.php");
    }

    //Delete Book
    if (array_key_exists('btnDeleteBook', $_POST)) {
        $bookID = $_POST['btnDeleteBook'];
        
        $sql = "DELETE FROM books WHERE book_id = $bookID";
        
        if ($conn->query($sql) === TRUE) {
            echo "  <script> 
                        alert('Book Successfully Deleted');
                        window.location.href = 'librarianBooks.php';
                    </script>";            
        } 
        else {
            echo "Error deleting book: " . $conn->error;
        }
    }
?>