//Variables
let btnDisplayBooks = document.getElementById("btnDisplayBooks");
let btnDisplayRented = document.getElementById("btnDisplayRented");
let btnDisplayMembers = document.getElementById("btnDisplayMembers");
let btnDisplayAuthors = document.getElementById("btnDisplayAuthors");
let viewBooks = document.getElementById("viewBooks");
let viewRentedBooks = document.getElementById("viewRentedBooks");
let viewMembers = document.getElementById("viewMembers");
let viewAuthors = document.getElementById("viewAuthors");

//Change to Books Screen
btnDisplayBooks.addEventListener('click', (e) => {
    viewBooks.style.display = "block";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
})

//Change to Rented Screen
btnDisplayRented.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "block";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "none";
})

//Change to Members Screen
btnDisplayMembers.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "block";
    viewAuthors.style.display = "none";
})

//Change to Authors Screen
btnDisplayAuthors.addEventListener('click', (e) => {
    viewBooks.style.display = "none";
    viewRentedBooks.style.display = "none";
    viewMembers.style.display = "none";
    viewAuthors.style.display = "block";
})
