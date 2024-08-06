<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script>
        function initAutocomplete() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }

        function validateForm() {
            // Get form values
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const phoneNumber = phoneInput.getNumber(); // Get formatted phone number
            const userName = document.getElementById("username").value;
            const fullName = document.getElementById("fullname").value;
            const firstName = fullName.split(' ')[0]; // Assuming first word is first name

            // Email validation pattern
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Password validation pattern
            const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
                return false;
            }

            // Check if password contains user's names, email, phone number
            const lowerCasePassword = password.toLowerCase();
            if (lowerCasePassword.includes(userName.toLowerCase()) || 
                lowerCasePassword.includes(email.split('@')[0].toLowerCase()) ||
                lowerCasePassword.includes(phoneNumber.replace(/\D/g, '')) || 
                lowerCasePassword.includes(firstName.toLowerCase())) {
                alert("Password cannot be based on your name, email, phone number, or date of birth.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body onload="initAutocomplete()">
    <header>
        <h1>Customer Registration</h1>
    </header>

    <div class="form-container">
        <form action="../../objects/customers/signupinsertion.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h2>Customer Registration Form</h2>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" required>

            <label for="contact">Customer Contact:</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="email">Customer Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Customer Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>

            <button type="submit">Register</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Customer Registration System</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        // Initialize international telephone input
        const phoneInputField = document.querySelector("#contact");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "auto", // Automatically detect user's country
            separateDialCode: true, // Display country code separately
            nationalMode: false, // Do not use national mode (allows users to input numbers in international format)
            preferredCountries: ["us", "gb"], // Specify preferred countries
            placeholderNumberType: "MOBILE", // Set placeholder type to mobile numbers
            formatOnDisplay: true, // Format the number on display
            autoPlaceholder: "polite", // Show placeholder only when typing starts (improves performance)
            geoIpLookup: function(callback) {
                fetch("https://ipinfo.io/json")
                    .then(response => response.json())
                    .then(data => {
                        callback(data.country);
                    });
            }
        });
    </script>
</body>
</html>
