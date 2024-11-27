<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body {
            height: 100%;
        }

        body {
            background-color: black;
            margin: 0;
        }

        .container {
            background-color: gray;
            height: 100%;
            position: fixed;
        }

        .links {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .links > * {
            width: 3rem;
            min-width: 0;
            min-height: 0;
            padding-top: 0.5rem;
            padding-inline: 0.75rem;
            padding-bottom: 0.5rem;
            text-decoration: none;
            display: flex;
        }

        a > * {
            width: 100%;
            height: 100%;
        }

        a:hover {
            background-color: blue;
        }

        .logout {
            background-color: green;
            margin-top: auto;
        }
        
        .logout:hover {
            background-color: blue;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                height: auto;
            }

            .links {
                height: auto;
                flex-direction: row;
            }

            .links > * {
                width: 100%;
                height: 2rem;
                padding-top: 0.5rem;
                padding-inline: .25rem;
                padding-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="links">
            <a href="<?php echo URL . "#" ?>" tooltip="Home">
                <img src="<?php echo SVG . "home.svg" ?>">
            </a>
            <a href="<?php echo URL . "boxes/" ?>" tooltip="Boxes">
                <img src="<?php echo SVG . "boxes.svg" ?>">
            </a>
            <?php if(validateUser("ADMIN", "SUPER")): ?>
                <a href="<?php echo URL . "materials/" ?>" tooltip="Materials">
                    <img src="<?php echo SVG . "materials.svg" ?>">
                </a>
            <?php endif; ?>
            <a href="<?php echo URL . "process/" ?>" tooltip="Process">
                <img src="<?php echo SVG . "process.svg" ?>">
            </a>
            <a href="<?php echo URL . "products/" ?>" tooltip="Products">
                <img src="<?php echo SVG . "products.svg" ?>">
            </a>
            <a href="<?php echo URL . "protocols/" ?>" tooltip="Protocols">
                <img src="<?php echo SVG . "protocols.svg" ?>">
            </a>
            <?php if(validateUser("ADMIN")): ?>
                <a href="<?php echo URL . "users/" ?>" tooltip="Users">
                    <img src="<?php echo SVG . "users.svg" ?>">
                </a>
            <?php endif; ?>
            <img class="logout" id="profile-toggle" src="../src/svg/user.svg">
            <ul class="dropdown-menu" id="dropdown-menu">
            <li style="border-bottom: none">
                <a href="<?php echo URL . "?a=logout" ?>">Logout</a>
            </li>
        </ul>
        </div>
    </div>
</body>
</html>




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
            <?php if(validateUser("ADMIN", "SUPER")): ?>
            <li>
                <a class="nav-link" href="<?php echo URL . "materials/" ?>" tooltip="Materials">
                    <img class="bi" src="<?php echo SVG . "materials.svg" ?>">
                </a>
            </li>
            <?php endif; ?>
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
            <?php if(validateUser("ADMIN")): ?>
            <li>
                <a class="nav-link" href="<?php echo URL . "users/" ?>" tooltip="Users">
                    <img class="bi" src="<?php echo SVG . "users.svg" ?>">
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <a href="#" class="link-body " id="profile-toggle">
            <img class="bi" src="<?php echo SVG . "user.svg" ?>">
        </a>
        <ul class="dropdown-menu" id="dropdown-menu">
            <li style="border-bottom: none">
                <a href="<?php echo URL . "?a=logout" ?>">Logout</a>
            </li>
        </ul>
    </aside>