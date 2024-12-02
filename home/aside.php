    <div class="nav-bar">
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
        <a class="logout" href="<?php echo URL . "?a=logout" ?>" tooltip="Logout">
            <img src="<?php echo SVG . "person-circle.svg" ?>">
        </a>
    </div>