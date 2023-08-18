
const changePasswordButton = document.getElementById("change-password-button");
const passwordFields = document.getElementById("password-fields");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm_password");
const submitButton = document.getElementById("submit");
const contactNumberInput = document.getElementsByName("contact_number")[0];
const emailInput = document.getElementsByName("email")[0];

// Set initial state of submit button based on existing values
if (contactNumberInput.value.match(/^(\+639|639|09)/)) {
    submitButton.disabled = false;
} else {
    submitButton.disabled = true;
}

if (isValidEmail(emailInput.value)) {
    submitButton.disabled = false;
} else {
    submitButton.disabled = true;
}

contactNumberInput.addEventListener("input", validateContact);

// Toggle password fields and enable/disable submit button
changePasswordButton.addEventListener("click", () => {
    if (passwordFields.style.display === "none") {
        passwordFields.style.display = "block";
        changePasswordButton.textContent = "Cancel";
        passwordInput.value = "";
        confirmPasswordInput.value = "";
        submitButton.disabled = true;
        passwordInput.addEventListener("input", validatePassword);
        confirmPasswordInput.addEventListener("input", validatePassword);
    } else {
        passwordFields.style.display = "none";
        changePasswordButton.textContent = "Change Password";
        passwordInput.value = "";
        confirmPasswordInput.value = "";
        validatePassword();

        submitButton.disabled = false;
        passwordInput.removeEventListener("input", validatePassword);
        confirmPasswordInput.removeEventListener("input", validatePassword);
    }
});



function validatePassword() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    const hasLetters = /[a-zA-Z]/.test(password);
    const hasNumbers = /\d/.test(password);

    if (password.length < 8 || !hasLetters || !hasNumbers || password !== confirmPassword) {
        submitButton.disabled = true;
        // Display error messages
        if (password.length < 8) {
            document.getElementById("password-error").textContent = "Password must be at least 8 characters.";
        } else if (!hasLetters) {
            document.getElementById("password-error").textContent = "Password must contain at least one letter.";
        } else if (!hasNumbers) {
            document.getElementById("password-error").textContent = "Password must contain at least one number.";
        } else if (password !== confirmPassword) {
            document.getElementById("confpass-error").textContent = "Passwords do not match.";
        }
    } else {
        submitButton.disabled = false;
        document.getElementById("password-error").textContent = "";
        document.getElementById("confpass-error").textContent = "";
    }
}

function validateContact() {
    if (!isValidContactNumber(contactNumberInput.value)) {
        document.getElementById("contact-error").textContent = "Invalid PH Contact Number";
        submitButton.disabled = true;
    } else {
        document.getElementById("contact-error").textContent = "";
        submitButton.disabled = false;
    }
}

function isValidContactNumber(contactNumber) {
    if (contactNumber.match(/^\+639\d{9}$/)) {
        // Starts with "+639" and has a total of 13 characters
        return true;
    } else if (contactNumber.match(/^639\d{9}$/)) {
        // Starts with "639" and has a total of 12 characters
        return true;
    } else if (contactNumber.match(/^09\d{9}$/)) {
        // Starts with "09" and has a total of 11 characters
        return true;
    } else {
        return false;
    }
}

// Validate email format
emailInput.addEventListener("input", () => {
    if (isValidEmail(emailInput.value)) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
});

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}