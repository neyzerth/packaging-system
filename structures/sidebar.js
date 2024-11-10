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