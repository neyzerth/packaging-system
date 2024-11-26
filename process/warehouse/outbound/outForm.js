document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form");

    function showError(message) {
        alert(message);
    }

    function isValidDate(date) {
        return /^\d{4}-\d{2}-\d{2}$/.test(date);
    }

    function validateDate(field) {
        const dateValue = field.value;
        if (!dateValue) {
            showError(`${field.name} is required.`);
            field.focus();
            return false;
        }

        if (!isValidDate(dateValue)) {
            showError(`${field.name} must be in YYYY-MM-DD format.`);
            field.focus();
            return false;
        }

        const selectedDate = new Date(dateValue);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            showError(`${field.name} cannot be in the past.`);
            field.focus();
            return false;
        }

        return true;
    }

    function validatePositiveInteger(field) {
        const value = parseFloat(field.value.trim());
        if (!Number.isInteger(value) || value <= 0) {
            showError(`${field.name} must be a positive integer.`);
            field.focus();
            return false;
        }
        return true;
    }

    form.addEventListener("submit", (event) => {
        const dateField = document.getElementById("date");
        const quantityField = document.getElementById("exit_quantity");

        if (!validateDate(dateField)) {
            event.preventDefault();
            return;
        }

        if (!validatePositiveInteger(quantityField)) {
            event.preventDefault();
            return;
        }
    });
});
