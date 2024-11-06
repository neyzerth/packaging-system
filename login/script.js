const leftDiv = document.getElementById('leftDiv');
const rightDiv = document.getElementById('rightDiv');
const link = document.getElementById('link');
const toggleImage = document.getElementById('toggleImage');
const toggleText = document.getElementById('toggleText');
const paragraph = document.getElementById('paragraph');
const images = [
    '../structures/svg/padlock-unlocked.svg',
    '../structures/svg/user.svg'
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
            ? `
            <form action="\GitHub\packaking-system/boxes/index.php" id="rightDiv" method="post">
                <strong style="font-size: 20px;">Request your code!</strong>
                <p>We will send instructions to your email.</p>
                <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="Enter your email">
                <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Confirm your email">
                <button type="submit" class="btn-primary">Next step</button>
            </form>`
            : `
            <form action="\GitHub\packaking-system/boxes/index.php" id="rightDiv" method="post">
                <strong style="font-size: 20px;">Hello again!</strong>
                <p><?php echo $msg ?></p>
                <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="User">
                <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                <button type="submit" class="btn-primary">Login</button>
            </form>`;

        toggleImage.src = images[+isLogin];

        toggleText.textContent = isLogin ? 'Already have an account?' : 'Forgot password?';

        paragraph.textContent = isLogin ? 'Select the icon to login.' : 'Select the icon to request instructions.';

        leftDiv.style.opacity = '1';
        rightDiv.style.opacity = '1';
    }, 800);
});