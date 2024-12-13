
//displaying airline review table on changing option
let tableContainer = document.querySelector('.airline-review-table');
let manageAirlineSelect = document.getElementById('manageAirline');

manageAirlineSelect.addEventListener('change', (event) => {

    //Hide the airport component if its visible
    let airportComponent = document.getElementsByClassName('airport-management')[0];
    let airportList = document.querySelector('.airport-list-container');
    airportComponent.classList.remove('show-airport-component');
    airportList.classList.remove('show-airports');
    if(event.target.value === 'review-registration'){
        tableContainer.classList.add('show-requests');
    }

    else{
        tableContainer.classList.remove('show-requests');
    }
});


//Displaying adding airport component when clicked
let addAirportBtn = document.getElementById('add-airport-btn');
let airportComponent = document.getElementsByClassName('airport-management')[0];
addAirportBtn.addEventListener('click', (event) => {
    event.preventDefault();

    //hide the airline review table if it's visible
    tableContainer.classList.remove('show-requests');
    manageAirlineSelect.value = '';
    airportComponent.classList.add('show-airport-component');
});

