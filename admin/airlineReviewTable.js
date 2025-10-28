// Get the dropdown and listen for changes
let manageAirlineSelect = document.getElementById('manageAirline');

manageAirlineSelect.addEventListener('change', (event) => {
    let baseUrl = window.location.origin;
    console.log(baseUrl);

    if (event.target.value === 'review-registration') {
        window.location.href = `${baseUrl}/airline%20ticket%20booking%20system/admin/airlineReviewTable.php`;
    } 
    else if(event.target.value === 'update-airline-details'){
        window.location.href = `${baseUrl}/airline%20ticket%20booking%20system/admin/updateAirline.php`;
    }
    else if(event.target.value === 'manage-flights'){
        window.location.href = `${baseUrl}/airline%20ticket%20booking%20system/admin/manageFlight.php`;
    }
});
