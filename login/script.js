const leftDiv = document.getElementById('leftDiv');
const rightDiv = document.getElementById('rightDiv');
const link = document.getElementById('link');
const toggleImage = document.getElementById('toggleImage');
const toggleText = document.getElementById('toggleText');
const paragraph = document.getElementById('paragraph');
const images = [
    `
    <path d="M5.5 7V4.5a2.5 2.5 0 1 1 5 0V7H11a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h.5zm1-2.5V7h3V4.5a1.5 1.5 0 0 0-3 0zm1.5 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
    ` , `
    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
    `
];

link.addEventListener('click', event => {
    event.preventDefault();

    leftDiv.style.opacity = '0';
    rightDiv.style.opacity = '0';

    leftDiv.classList.toggle('swapped');
    rightDiv.classList.toggle('swapped-right');

    setTimeout(() => {
        const isLogin = leftDiv.classList.contains('swapped');

        rightDiv.innerHTML = isLogin
            ?`
            <form action="" method="post">
                <h2>Request your code!</h2>
                <p>We will send instructions to your email.</p>
                <input id="email" name="email" class="form-control" type="email"  autocomplete="off" required placeholder="Enter your email">
                <input id="confirm-email" name=" confirm-email" class="form-control" type="email" autocomplete="off" required placeholder="Confirm your email">
                <button type="submit" class="btn-primary">Next step</button>
            </form>
            ` : `
            <form action="" method="post">
                <h2>Welcome back!</h2>
                <p><?php echo $msg ?></p>
                <input id="username" name="username" class="form-control" type="text"  autocomplete="off" required placeholder="User">
                <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                <button type="submit" class="btn-primary">Login</button>
            </form>
            `;

        toggleImage.innerHTML = images[+isLogin];

        toggleText.textContent = isLogin ? 'Already have an account?' : 'Forgot password?';

        paragraph.textContent = isLogin ? 'Select the icon to login' : 'Select the icon for more information';

        leftDiv.style.opacity = '1';
        rightDiv.style.opacity = '1';
    }, 800);
});