

//hiding return date field if selected one way
const returnDate = document.getElementById("returnDateField");
const roundTrip = document.getElementById("roundTrip");
const oneWayTrip = document.getElementById("oneWay");

roundTrip.addEventListener('change', () => {
    returnDate.classList.remove("returnDate-hidden");
});

oneWayTrip.addEventListener('change', () => {
   returnDate.classList.add("returnDate-hidden")
});




function generateAirports() {
    const fromSelect = document.getElementById("from-location");
    const toSelect = document.getElementById("to-location");
    const fromLocation = document.getElementById("demoPlaceDepart");
    const toLocation = document.getElementById("demoPlaceDest");

    //clear already existing airport options
    fromSelect.innerHTML = '';
    toSelect.innerHTML = '';

    //looping through airports and generating both departure and destination airports
    airports.forEach((airport) => {

        //For departure(FROM) dropdown
        const optionFrom = document.createElement("option");
        optionFrom.value = airport.airport_id;
        optionFrom.textContent = `${airport.location}, ${airport.area_code}`;
        fromSelect.appendChild(optionFrom);


        //For destination(TO) dropdown
        const optionTo = document.createElement("option");
        optionTo.value = airport.airport_id;
        optionTo.textContent = `${airport.location}, ${airport.area_code}`;
        toSelect.appendChild(optionTo);
    });

    //Disabled the destination airport selected in departure
    fromSelect.addEventListener('change', (event) => {
        const selectedAirportId = event.target.value;

        let selectedAirport;
        let i;
        for(i = 0; i < airports.length; i++){
            if(airports[i].airport_id === selectedAirportId){
                selectedAirport = airports[i]; //get full airport object
                break;
            }
        }

        fromLocation.textContent = selectedAirport.airport_name;
        toSelect.querySelectorAll("option").forEach(option => {
            if(option.value === selectedAirportId){
                option.style.display = "none";
            }

            else{
                option.style.display = "block";
            }
        })
    });

    //Disabled the departure airport selected in destination
    toSelect.addEventListener('change', (event) => {
        const selectedAirportId = event.target.value;

        let selectedAirport;
        let i;
        for(i = 0; i < airports.length; i++){
            if(airports[i].airport_id === selectedAirportId){
                selectedAirport = airports[i]; //get full airport object
                break;  //stop the loop
            }
        }

        toLocation.textContent = selectedAirport.airport_name;
        fromSelect.querySelectorAll("option").forEach(option => {
            if(option.value === selectedAirportId){
                option.style.display = "none";
            }

            else{
                option.style.display = "block";
            }
        })
    });

}

document.addEventListener('DOMContentLoaded', generateAirports);