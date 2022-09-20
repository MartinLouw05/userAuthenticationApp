//Variables
let btnDisplayBooks = document.getElementById("btnDisplayBooks");
let btnDisplayRented = document.getElementById("btnDisplayRented");
let btnDisplayMembers = document.getElementById("btnDisplayMembers");
let btnDisplayAuthors = document.getElementById("btnDisplayAuthors");
let viewBooks = document.getElementById("viewBooks");
let viewRentedBooks = document.getElementById("viewRentedBooks");
let viewMembers = document.getElementById("viewMembers");
let viewAuthors = document.getElementById("viewAuthors");

let btnAddBook = document.getElementById("btnAddBook");
let viewAddBook = document.getElementById("viewAddBook");

let btnUpdateBook = document.getElementById("btnUpdateBook");
let viewUpdateBook = document.getElementById("viewUpdateBook");

let btnDeleteBook = document.getElementById("btnDeleteBook");
/*
//Change to Books Screen
btnDisplayBooks.addEventListener('click', (e) => {
    viewBooks.style.display = "block";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

btnDisplayBooks.addEventListener('click', (e) => {
    let libView = document.getElementById('libView');

    //libView.innerHTML = '<?php include "../librarian/librarianBooks.php"; ?>';
})

//Change to Rented Screen
btnDisplayRented.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "block";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

//Change to Members Screen
btnDisplayMembers.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "block";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

//Change to Authors Screen
btnDisplayAuthors.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "block";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

//Change to Add Book Screen
btnAddBook.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "block";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

//Cancel Book Creation
let btnCancelBook = document.getElementById("btnCancelBook");

btnCancelBook.addEventListener('click', (e) => {
    viewBooks.style.display = "block";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "none";

    clearAddBookInputs();
})

//Clear Book Creation Inputs
function clearAddBookInputs() {
    //Inputs
    let bookName = document.getElementById("bookName");
    let bookGenre = document.getElementById("bookGenre");
    let bookAuthor = document.getElementById("bookAuthor");
    let bookPublishedDate = document.getElementById("bookPublishedDate");
    let bookDesc = document.getElementById("bookDesc");

    //Set Values
    bookName.value = "";
    bookGenre.value = "";
    bookAuthor.value = "";
    bookPublishedDate.value = "";
    bookDesc.value = "";
}

//Change to Book Update Screen
/*btnUpdateBook.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
    viewAddBook.style.display = "none";
    viewUpdateBook.style.display = "block";

    console.log(btnUpdateBook.value)
})*/


