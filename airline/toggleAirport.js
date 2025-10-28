document.addEventListener('DOMContentLoaded', () => {
    const departureSelect = document.getElementById("departure");
    const destinationSelect = document.getElementById("destination");
    const returnSourceInput = document.getElementById("returnSource");
    const returnDestinationInput = document.getElementById("returnDestination");
    
    const updateReturnFlightDetails = () => {
        const departureId = departureSelect.value;
        const destinationId = destinationSelect.value;

        if (departureId && destinationId) {
            const departureName = departureSelect.querySelector(`option[value="${departureId}"]`).textContent;
            const destinationName = destinationSelect.querySelector(`option[value="${destinationId}"]`).textContent;

            returnSourceInput.value = destinationName;
            returnDestinationInput.value = departureName;
        }
    };

    departureSelect.addEventListener("change", updateReturnFlightDetails);
    destinationSelect.addEventListener("change", updateReturnFlightDetails);
});
