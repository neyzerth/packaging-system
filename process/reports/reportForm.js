document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reportForm");
    
    
    function isValidDate(date) {
        return /^\d{4}-\d{2}-\d{2}$/.test(date);
    }

  
    function validatePositiveNumber(field) {
        const value = parseFloat(field.value.trim());
        if (isNaN(value) || value <= 0) {
            showError(`${field.name.charAt(0).toUpperCase() + field.name.slice(1)} must be a positive number.`);
            field.focus();
            return false;
        }
        return true;
    }

  
    function validateSelect(field) {
        if (field.value === "") {
            showError(`Please select a valid ${field.name}.`);
            field.focus();
            return false;
        }
        return true;
    }

    form.addEventListener("submit", (event) => {
        clearErrors();

        const startDate = document.getElementById("start_date");
        if (!isValidDate(startDate.value)) {
            showError("Start Date must be in YYYY-MM-DD format.");
            event.preventDefault();
            return;
        }

        const endDate = document.getElementById("end_date");
        if (!isValidDate(endDate.value)) {
            showError("End Date must be in YYYY-MM-DD format.");
            event.preventDefault();
            return;
        }

        if (new Date(startDate.value) > new Date(endDate.value)) {
            showError("Start Date must be earlier or equal to End Date.");
            event.preventDefault();
            return;
        }

        const reportDate = document.getElementById("report_date");
        if (!isValidDate(reportDate.value)) {
            showError("Report Date must be in YYYY-MM-DD format.");
            event.preventDefault();
            return;
        }

        const packedProduct = document.getElementById("packed_product");
        if (!validatePositiveNumber(packedProduct)) {
            event.preventDefault();
            return;
        }


        const traceability = document.getElementById("traceability");
        if (!validateSelect(traceability)) {
            event.preventDefault();
            return;
        }
    });
});
