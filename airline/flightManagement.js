document.addEventListener('DOMContentLoaded', () => {
    const returnFlightSection = document.getElementById('returnFlightSection');
    const tripTypeRadioButtons = document.querySelectorAll('input[name="tripType"]');
    
    const toggleReturnFlightSection = () => {
        const tripType = document.querySelector('input[name="tripType"]:checked').value;
        
        if (tripType === 'roundTrip') {
            returnFlightSection.classList.remove('hidden');
        } else {
            returnFlightSection.classList.add('hidden');
        }
    };
    
    toggleReturnFlightSection();
});
