
document.addEventListener('DOMContentLoaded', (event) => {
    let airportList = document.querySelector('.airport-list-container');
    let showAirportBtn = document.getElementById('showAirportsBtn');
    let hideAirportBtn = document.getElementById('hideAirportsBtn');
    showAirportBtn.addEventListener('click', (e) => {
        airportList.classList.add('show-airports');
    });

    hideAirportBtn.addEventListener('click', (e) => {
        airportList.classList.remove('show-airports');
    });
});