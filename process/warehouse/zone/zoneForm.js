document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    function validateCode(field) {
        const value = field.value.trim();
        if (value === "" || isNaN(value) || value < 0) {
            alert("The capacity must be a valid number and cannot be less than 0.");
            field.focus();
            return false;
        }
        return true;
    }

    // Validar que la capacidad disponible no exceda la capacidad total
    function validateCapacityRelation(available, total) {
        const availableValue = parseFloat(available.value.trim());
        const totalValue = parseFloat(total.value.trim());

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
