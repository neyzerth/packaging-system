    <div class="overlay">
        <img src="<?php echo SVG . "hidden-eye.svg" ?>">
        <h4>Content blurred due to screen resolution.</h4>
    </div>
    <aside class="sidebar">
        <ul class="navegation">
            <li>
                <a class="nav-link" href="<?php echo URL . "#" ?>" tooltip="Home">
                    <img class="bi" src="<?php echo SVG . "home.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "boxes/" ?>" tooltip="Boxes">
                    <img class="bi" src="<?php echo SVG . "boxes.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "materials/" ?>" tooltip="Materials">
                    <img class="bi" src="<?php echo SVG . "materials.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "process/" ?>" tooltip="Process">
                    <img class="bi" src="<?php echo SVG . "process.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "products/" ?>" tooltip="Products">
                    <img class="bi" src="<?php echo SVG . "products.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "protocols/" ?>" tooltip="Protocols">
                    <img class="bi" src="<?php echo SVG . "protocols.svg" ?>">
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo URL . "users/" ?>" tooltip="Staff">
                    <img class="bi" src="<?php echo SVG . "users.svg" ?>">
                </a>
            </li>
        </ul>
        <a href="#" class="link-body dropdown-toggle" id="profile-toggle">
            <img class="bi" src="<?php echo IMG . "person.jpeg" ?>">
        </a>
        <ul class="dropdown-menu" id="dropdown-menu">
            <li>
                <a href="#">Profile</a>
            </li>
            <li style="border-bottom: none">
                <a href="<?php echo URL . "login/" ?>">Logout</a>
            </li>
        </ul>
    </aside>