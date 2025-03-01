    // Function to set min date to current date-time
    function restrictPastDates() {
        // Get current date and time
        let now = new Date();
        let year = now.getFullYear();
        let month = (now.getMonth() + 1).toString().padStart(2, '0');
        let day = now.getDate().toString().padStart(2, '0');
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');

        // Format datetime-local value: YYYY-MM-DDTHH:MM
        let minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Select all departure and arrival input fields
        document.getElementById("onward_departure_time")?.setAttribute("min", minDateTime);
        document.getElementById("onward_arrival_time")?.setAttribute("min", minDateTime);
        document.getElementById("return_departure_time")?.setAttribute("min", minDateTime);
        document.getElementById("return_arrival_time")?.setAttribute("min", minDateTime);
    }

    // Run the function after page loads
    document.addEventListener("DOMContentLoaded", restrictPastDates);

