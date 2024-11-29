// Get modal elements
const passengerModal = document.getElementById('passengerModal');
const airlineModal = document.getElementById('airlineModal');

// Get button elements
const openPassengerModal = document.getElementById('openPassengerModal');
const openAirlineModal = document.getElementById('openAirlineModal');

// Get close button elements
const closeButtons = document.getElementsByClassName('close');

// Open passenger modal
openPassengerModal.onclick = function() {
    passengerModal.style.display = 'block';
}

// Open airline modal
openAirlineModal.onclick = function() {
    airlineModal.style.display = 'block';
}

// Close modals when clicking on close button
for (let i = 0; i < closeButtons.length; i++) {
    closeButtons[i].onclick = function() {
        passengerModal.style.display = 'none';
        airlineModal.style.display = 'none';
    }
}

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target == passengerModal) {
        passengerModal.style.display = 'none';
    }
    if (event.target == airlineModal) {
        airlineModal.style.display = 'none';
    }
}

// Handle form submissions
document.getElementById('passengerForm').onsubmit = function(e) {
    e.preventDefault();
    // Add your passenger signup logic here
    console.log('Passenger form submitted');
    // You can access form data using e.target elements
}

document.getElementById('airlineForm').onsubmit = function(e) {
    e.preventDefault();
    // Add your airline company signup logic here
    console.log('Airline form submitted');
    // You can access form data using e.target elements
}