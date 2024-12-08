
let tableContainer = document.querySelector('.airline-review-table');
let manageAirlineSelect = document.getElementById('manageAirline');

manageAirlineSelect.addEventListener('change', (event) => {
    if(event.target.value === 'review-registration'){
        tableContainer.classList.add('show-requests');
    }

    else{
        tableContainer.classList.remove('show-requests');
    }
});