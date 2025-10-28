document.addEventListener("DOMContentLoaded", () => {
    const tabButtons = document.querySelectorAll(".tab-btn");
    const userTypeInput = document.getElementById("user-type-input"); // Ensure this is inside the DOMContentLoaded block
    const loginForm = document.getElementById("login-form");
    const emailInput = document.getElementById("user-email");
    const passwordInput = document.getElementById("user-password");

    // Log the userTypeInput after it has been defined and the DOM is fully loaded
    console.log(userTypeInput); // This should now work correctly

    // Tab switching functionality
    tabButtons.forEach((button) => {
        button.addEventListener("click", function () {
            tabButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");

            const userType = this.getAttribute("data-user-type");
            userTypeInput.value = userType; // Update the userTypeInput value based on the selected tab

            // Update form elements based on user type
            updateFormForUserType(userType);

            // Reset validation states when switching tabs
            resetValidationStates();
        });
    });

    function updateFormForUserType(userType) {
        const submitBtn = document.querySelector(".submit-btn");
        const emailLabel = document.querySelector('label[for="user-email"]');

        switch (userType) {
            case "admin":
                emailLabel.textContent = "Admin Email";
                submitBtn.textContent = "Login as Admin";
                break;
            case "airline":
                emailLabel.textContent = "Airline Email";
                submitBtn.textContent = "Login as Airline";
                break;
            case "user":
                emailLabel.textContent = "Email Address";
                submitBtn.textContent = "Login";
                break;
        }
    }

    // Form validation
    loginForm.addEventListener("submit", (e) => {
        let isValid = true;

        resetValidationStates();

        if (!validateEmail(emailInput.value)) {
            showError(emailInput, "email-error");
            isValid = false;
        } else {
            showSuccess(emailInput);
        }

        if (passwordInput.value.length < 3) {
            showError(passwordInput, "password-error");
            isValid = false;
        } else {
            showSuccess(passwordInput);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Real-time validation
    emailInput.addEventListener("blur", validateOnBlur);
    passwordInput.addEventListener("blur", validateOnBlur);

    function validateOnBlur() {
        if (this.value !== "") {
            if (this.type === "email" && !validateEmail(this.value)) {
                showError(this, "email-error");
            } else if (this.type === "password" && this.value.length < 6) {
                showError(this, "password-error");
            } else {
                showSuccess(this);
            }
        } else {
            resetValidationState(this);
        }
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showError(input, errorId) {
        const parentElement = input.parentElement;
        parentElement.classList.add("error");
        parentElement.classList.remove("success");
        document.getElementById(errorId).style.display = "block";
    }

    function showSuccess(input) {
        const parentElement = input.parentElement;
        parentElement.classList.add("success");
        parentElement.classList.remove("error");
    }

    function resetValidationState(input) {
        const parentElement = input.parentElement;
        parentElement.classList.remove("error", "success");
        const errorMessage = parentElement.querySelector(".error-message");
        if (errorMessage) {
            errorMessage.style.display = "none";
        }
    }

    function resetValidationStates() {
        const inputGroups = document.querySelectorAll(".input-group");
        inputGroups.forEach((group) => {
            resetValidationState(group.querySelector("input"));
        });
    }
});