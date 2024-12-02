document.querySelectorAll('.nav-bar a').forEach(link => {
    if (link.pathname === location.pathname && !link.classList.contains('logout')) {
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