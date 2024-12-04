
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    //Its Work
    function validateCode(field) {
        const value = field.value.trim();
        if (value === "") return false;
        const regex = /^[A-Za-z0-9]{5}$/;
        if (value.length !== 5 || !regex.test(value)) {
            alert("The code must be exactly 5 alphanumeric characters.");
            field.focus();
            return false;
        }
        return true;
    }

    function validateArea(field) {
        const value = field.value.trim();
        if (value === "") return false;
        if (value.length > 50) {
            alert("The area must not exceed 50 characters.");
            field.focus();
            return false;
        }
        return true;
    }

    function validateCapacity(field) {
        const value = field.value.trim();
        if (value === "" || isNaN(value) || value < 0) {
            alert("The capacity must be a valid number and cannot be negative.");
            field.focus();
            return false;
        }
        return true;
    }

    function validateCapacities(availableField, totalField) {
        const availableValue = parseFloat(availableField.value.trim());
        const totalValue = parseFloat(totalField.value.trim());

        if (availableValue > totalValue) {
            alert("Available capacity cannot be greater than total capacity.");
            availableField.focus();
            return false;
        }

        if (totalValue < 10) {
            alert("Total capacity cannot be less than 10 packages.");
            totalField.focus();
            return false;
        }

        if (availableValue < 0 || totalValue < 0) {
            alert("Available and total capacities cannot be negative.");
            availableField.focus();
            return false;
        }

        return true;
    }

    form.addEventListener("submit", (event) => {
        const code = document.getElementById("code");
        if (!validateCode(code)) {
            event.preventDefault();
            return;
        }

        const area = document.getElementById("area");
        if (!validateArea(area)) {
            event.preventDefault();
            return;
        }

        const availableCapacity = document.getElementById("available_quantity");
        if (!validateCapacity(availableCapacity)) {
            event.preventDefault();
            return;
        }

        const totalCapacity = document.getElementById("total_capacity");
        if (!validateCapacity(totalCapacity)) {
            event.preventDefault();
            return;
        }

        if (!validateCapacities(availableCapacity, totalCapacity)) {
            event.preventDefault();
            return;
        }
    });
});