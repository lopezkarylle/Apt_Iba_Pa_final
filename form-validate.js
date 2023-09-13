const firstNameInput = document.getElementById("first_name");
        const lastNameInput = document.getElementById("last_name");
        const contactNumberInput = document.getElementById("contact_number");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confpassInput = document.getElementById("confpass");
        const submitButton = document.getElementById("next2");

        submitButton.disabled = true;

        firstNameInput.addEventListener("input", validateForm);
        lastNameInput.addEventListener("input", validateForm);
        contactNumberInput.addEventListener("input", validateContact);
        emailInput.addEventListener("input", validateEmail);
        passwordInput.addEventListener("input", validatePassword);
        confpassInput.addEventListener("input", validatePassword);

        function validateForm() {
            if (
                firstNameInput.value &&
                lastNameInput.value &&
                isValidContactNumber(contactNumberInput.value) &&
                isValidEmail(emailInput.value) &&
                isValidPassword(passwordInput.value) &&
                passwordsMatch(passwordInput.value, confpassInput.value)
            ) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function validateEmail() {
            if (!isValidEmail(emailInput.value)) {
                document.getElementById("email-error").textContent = "Invalid email format";
                submitButton.disabled = true;
            } else {
                document.getElementById("email-error").textContent = "";
                validateForm();
            }
        }

        function validatePassword() {
            if (!isValidPassword(passwordInput.value)) {
                document.getElementById("password-error").textContent = "Password must be at least 8 characters long, and contain a letter and a number";
                submitButton.disabled = true;
            } else {
                document.getElementById("password-error").textContent = "";
                validateForm();
            }

            if (!passwordsMatch(passwordInput.value, confpassInput.value)) {
                document.getElementById("confpass-error").textContent = "Passwords do not match";
                submitButton.disabled = true;
            } else {
                document.getElementById("confpass-error").textContent = "";
                validateForm();
            }
        }

        function validateContact() {
            if (!isValidContactNumber(contactNumberInput.value)) {
                document.getElementById("contact-error").textContent = "Invalid PH Contact Number";
                submitButton.disabled = true;
            } else {
                document.getElementById("contact-error").textContent = "";
                validateForm();
            }
        }

		function isValidEmail(email) {
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
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

        function isValidPassword(password) {
			const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
			return passwordRegex.test(password);
		}

        function passwordsMatch(password, confirmPassword) {
            return password === confirmPassword;
        }
        
      