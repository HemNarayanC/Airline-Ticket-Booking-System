const airlineLink = document.querySelector('#airlineLink');
const passengerLink = document.querySelector('#passengerLink');
const airlineForm = document.querySelector('.airline-form-wrapper');
const passengerForm = document.querySelector('.passenger-form-wrapper');

airlineLink.addEventListener('click', (e) => {
    e.preventDefault();
    airlineForm.classList.add('showMyForm');
    passengerForm.classList.remove('showMyForm');
});

passengerLink.addEventListener('click', (e) => {
    e.preventDefault();
    passengerForm.classList.add('showMyForm');
    airlineForm.classList.remove('showMyForm');
});