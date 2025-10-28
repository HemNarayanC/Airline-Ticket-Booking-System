
//script for navbar
const signupBtn = document.getElementById('signupBtn');
const userTypeDropdown = document.getElementById('userTypeDropdown');
const userType = document.querySelectorAll('.user-type');

//script for navbar
signupBtn.addEventListener('click', (e)=>{
    e.preventDefault();
    userTypeDropdown.classList.toggle('show');
});

//printing the value of usertype
userType.forEach((type) => {
    type.addEventListener('click', (e) => {
        const selectedValue = type.textContent.trim();
        console.log(selectedValue);
    })
})

//close the dropdown if clicked outside the button
window.addEventListener('click', (e)=>{
    if(!e.target.matches('#signupBtn')){
        userTypeDropdown.classList.remove('show');
    }
})

