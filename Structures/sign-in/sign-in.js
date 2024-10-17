const leftDiv = document.getElementById('leftDiv');
        const rightDiv = document.getElementById('rightDiv');
        const link = document.getElementById('link');
        const toggleImage = document.getElementById('toggleImage');
        const toggleText = document.getElementById('toggleText');
        const paragraph = document.getElementById('paragraph');
        const images = [
            'padlock-unlocked.svg',
            'user.svg'
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
            <form action="#" autocomplete="off">
                <fieldset>
                    <legend>
                        <strong>¡Solicita tu código!</strong>
                        <p>Te enviaremos instrucciones al correo electronico.</p>
                    </legend>

                    <input type="email" id="email" name="email" required
                        placeholder="Ingresa tu correo electrónico">

                    <input type="email" id="email" name="email" required
                        placeholder="Confirma tu correo electrónico">

                    <button type="submit">Siguiente</button>
                </fieldset>
            </form>`
                    : `
            <form action="admin.html">
                <fieldset>
                    <legend>
                        <strong>¡Hola de nuevo!</strong>
                        <p>¡Nos alegramos de volver a verte!</p>
                    </legend>

                    <input type="text" id="username" name="username" autocomplete="off" required
                        placeholder="Usuario">

                    <input type="password" id="password" name="password" required
                        placeholder="Contraseña">

                    <button type="submit">Iniciar sesión</button>
                </fieldset>
            </form>`;

                toggleImage.src = images[+isLogin];

                toggleText.textContent = isLogin ? '¿Ya tienes una cuenta?' : '¿Has olvidado la contraseña?';

                paragraph.textContent = isLogin ? 'Selecciona el icono para iniciar sesión.' : 'Selecciona el icono para solicitar instrucciones.';

                leftDiv.style.opacity = '1';
                rightDiv.style.opacity = '1';
            }, 800);
        });