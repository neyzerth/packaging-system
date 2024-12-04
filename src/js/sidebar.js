document.addEventListener("DOMContentLoaded", function() {
    const profileToggle = document.getElementById("profile-toggle");
    const dropdownMenu = document.getElementById("dropdown-menu");
    profileToggle.addEventListener("click", function(event) {
        event.preventDefault();
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        dropdownMenu.style.position = dropdownMenu.style.position === "fixed" ? "fixed" : "fixed";
    });
    document.addEventListener("click", function(event) {
        if (!profileToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});

document.querySelectorAll('.nav-link').forEach(link => {
    if (link.pathname === location.pathname) {
        link.classList.add('active');
    }
});

setTimeout(() => {
    const successMsg = document.getElementById('success-msg');
    const errorMsg = document.getElementById('error-msg');
    const disp = document.getElementById('disp');
    if (successMsg) successMsg.style.display = 'none';
    if (errorMsg) errorMsg.style.display = 'none';
    if (disp) disp.style.display = 'none';
}, 3000);


//Funcion para el focus
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form");
    if (form) {
        const inputs = form.querySelectorAll("input, select, textarea");
        for (const input of inputs) {
            if (!input.readOnly && !input.disabled) {
                input.focus();
                break;
            }
        }
    }
});