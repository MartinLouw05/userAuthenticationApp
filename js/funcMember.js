
//Media Queries
let firstMediaQuery = window.matchMedia('(max-width: 860px)');

let btnAccInfo = document.getElementById('btnAccInfo');
let btnRentedHistory = document.getElementById('btnRentedHistory');
let btnRented = document.getElementById('btnRented');

function firstScreenTest(e) {
    if (e.matches) {
        btnAccInfo.innerHTML = "Acc Info";
        if (btnRentedHistory) {
            btnRentedHistory.innerHTML = "History";
        }
        
        if (btnRented) {
            btnRented.innerHTML = "Active";
        }        
    }
    else {
        btnAccInfo.innerHTML = "Account Information";

        if (btnRentedHistory) {
            btnRentedHistory.innerHTML = "Rented History";
        }
        
        if (btnRented) {
            btnRented.innerHTML = "Active Rentals";
        }        
    }
}

firstMediaQuery.addEventListener('change', firstScreenTest);
