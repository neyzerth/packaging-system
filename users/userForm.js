document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    // Validation functions
    function validateName(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const regex = /^[A-Za-zÀ-ÿ\s]+$/; // Allow accented characters
        if (!regex.test(field.value.trim())) {
            alert("The name must contain only letters, including accented characters.");
            field.focus();
            return false;
        }
        return true;
    }

    function validateDate(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const date = new Date(field.value);
        const today = new Date();
        const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        const fiftyYearsAgo = new Date(today.getFullYear() - 50, today.getMonth(), today.getDate());

        if (isNaN(date.getTime()) || date > eighteenYearsAgo || date < fiftyYearsAgo) {
            alert("The date of birth must be valid, between 18 and 50 years ago.");
            field.focus();
            return false;
        }
        return true;
    }

    function validateEmail(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const regex = /^[^\s@]+@[^\s@]+\.(com|edu|org|net|gov|int|mil|co)$/;
        if (!regex.test(field.value.trim())) {
            alert("Please enter a valid email address with a valid extension (e.g., .com, .edu, .org).");
            field.focus();
            return false;
        }
        return true;
    }

    function validatePhone(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const value = field.value.trim();
        const regexFormat = /^(\d{3}[-\s]?\d{3}[-\s]?\d{4})$/;
        const digitsOnly = value.replace(/[-\s]/g, "");
        if (digitsOnly.length !== 10) {
            alert("The phone number must contain exactly 10 digits.");
            field.focus();
            return false;
        }
        if (!regexFormat.test(value)) {
            alert("Please enter a valid phone number (e.g., 664-121-1212, 664 121 1212, or 6641211212).");
            field.focus();
            return false;
        }
        return true;
    }

    function validatePassword(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!regex.test(field.value.trim())) {
            alert("The password must have at least 8 characters, including letters and numbers.");
            field.focus();
            return false;
        }
        return true;
    }

    function validatePostalCode(field) {
        if (field.value.trim() === "") return true; // Skip validation if field is empty
        const regex = /^\d{5}$/; // Only 5 digits
        if (!regex.test(field.value.trim())) {
            alert("The postal code must contain exactly 5 numeric characters.");
            field.focus();
            return false;
        }
        return true;
    }

    form.addEventListener("submit", (event) => {
        // Validate name
        const name = document.getElementById("name");
        if (!validateName(name)) {
            event.preventDefault();
            return;
        }

        // Validate first surname
        const firstSurname = document.getElementById("first_surname");
        if (!validateName(firstSurname)) {
            event.preventDefault();
            return;
        }

        // Validate second surname (skip if empty)
        const secondSurname = document.getElementById("second_surname");
        if (secondSurname.value.trim() !== "" && !validateName(secondSurname)) {
            event.preventDefault();
            return;
        }

        // Validate date of birth
        const date = document.getElementById("date");
        if (!validateDate(date)) {
            event.preventDefault();
            return;
        }

        // Validate email
        const email = document.getElementById("email");
        if (!validateEmail(email)) {
            event.preventDefault();
            return;
        }

        // Validate phone number
        const phone = document.getElementById("phone");
        if (!validatePhone(phone)) {
            event.preventDefault();
            return;
        }

        // Validate password
        const password = document.getElementById("password");
        if (!validatePassword(password)) {
            event.preventDefault();
            return;
        }

        // Validate postal code
        const postalCode = document.getElementById("postal-code");
        if (!validatePostalCode(postalCode)) {
            event.preventDefault();
            return;
        }
    });
});