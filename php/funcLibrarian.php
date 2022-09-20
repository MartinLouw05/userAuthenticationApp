<?php
    session_start();

    include('../connections/connect.php');
    
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
        $sql = "INSERT INTO books (book_name, book_desc, book_published_date, genre_id, status_id, author_id)
                VALUES ('$bookName', '$bookDesc', '$bookPublishedDate', '$bookGenre', '$bookStatus', '$bookAuthor');";

        //Check if Insert was Succesful
        if ($conn->query($sql) === TRUE) {
            echo "<script> console.log('New Book Created Successfully'); </script>";
            echo "<script> alert('New Book Created Successfully'); </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    //Update Book
    if (array_key_exists('btnUpdateBook', $_POST)) {
        $bookID = $_POST['btnUpdateBook'];
        $_SESSION['bookID'] = $bookID;
        
        header("Location: librarianUpdateBook.php");
    }

    //Delete Book
    if (array_key_exists('btnDeleteBook', $_POST)) {
        $bookID = $_POST['btnDeleteBook'];
        
        $sql = "DELETE FROM books WHERE book_id = $bookID";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script> console.log('Book Deleted Successfully'); </script>";
        } 
        else {
            echo "Error deleting book: " . $conn->error;
        }
    }
?>