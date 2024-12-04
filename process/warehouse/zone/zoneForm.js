document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    // Validar si un valor es un número válido y mayor o igual a 0
    function validateCapacity(field) {
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

        if (availableValue > totalValue) {
            alert("The available capacity cannot exceed the total capacity.");
            available.focus();
            return false;
        }
        return true;
    }

    form.addEventListener("submit", (event) => {
        const availableCapacity = document.getElementById("available_capacity");
        const totalCapacity = document.getElementById("total_capacity");

        // Validar capacidad disponible
        if (!validateCapacity(availableCapacity)) {
            event.preventDefault();
            return;
        }

        // Validar capacidad total
        if (!validateCapacity(totalCapacity)) {
            event.preventDefault();
            return;
        }

        // Validar relación entre capacidad disponible y total
        if (!validateCapacityRelation(availableCapacity, totalCapacity)) {
            event.preventDefault();
            return;
        }
    });
});
