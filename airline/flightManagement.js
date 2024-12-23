document.addEventListener('DOMContentLoaded', () => {
    const returnFlightSection = document.getElementById('returnFlightSection');
    const tripTypeRadioButtons = document.querySelectorAll('input[name="tripType"]');
    
    const toggleReturnFlightSection = () => {
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
        
        if (tripType === 'roundTrip') {
            returnFlightSection.classList.remove('hidden');
        } else {
            returnFlightSection.classList.add('hidden');
        }
    };
    
    toggleReturnFlightSection();
    
    tripTypeRadioButtons.forEach(button => {
        button.addEventListener('change', toggleReturnFlightSection);
    });

    const departureSelect = document.getElementById("departure");
    const destinationSelect = document.getElementById("destination");

    departureSelect.addEventListener("change", function () {
        const selectedDeparture = departureSelect.value;

        for (const destinationOption of destinationSelect.options) {
            if (destinationOption.value === selectedDeparture) {
                destinationOption.style.display = "none";
            } else {
                destinationOption.style.display = "";
            }
        }
    });

    destinationSelect.addEventListener("change", function () {
        const selectedDestination = destinationSelect.value;

        for (const departureOption of departureSelect.options) {
            if (departureOption.value === selectedDestination) {
                departureOption.style.display = "none";
            } else {
                departureOption.style.display = "";
            }
        }
    });
});
