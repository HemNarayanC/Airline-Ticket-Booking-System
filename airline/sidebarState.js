document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function () {
            navItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const flightNumberSearch = document.getElementById('flightNumberSearch');
    const flightTable = document.getElementById('flightTable');
    const rows = flightTable.querySelectorAll('tbody tr');

    flightNumberSearch.addEventListener('input', () => {
        const filter = flightNumberSearch.value;

        rows.forEach(row => {
            const flightNumber = row.querySelector('.flightNumber').textContent;

            if (flightNumber.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
