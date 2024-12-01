<body style="display: flex;">
    <div class="home">
        <div>
            <a href="<?php echo URL . "boxes/" ?>">
                <img src="<?php echo SVG . "boxes.svg" ?>">
                <h1>Boxes</h1>
            </a>
            <?php if(validateUser("ADMIN", "SUPER")): ?>
                <a href="<?php echo URL . "materials/" ?>">
                    <img src="<?php echo SVG . "materials.svg" ?>">
                    <h1>Materials</h1>
                </a>
            <?php endif; ?>
            <a href="<?php echo URL . "process/" ?>">
                <img src="<?php echo SVG . "process.svg" ?>">
                <h1>Process</h1>
            </a>
        </div>
        <div>
            <a href="<?php echo URL . "products/" ?>">
                <img src="<?php echo SVG . "products.svg" ?>">
                <h1>Products</h1>
            </a>
            <a href="<?php echo URL . "protocols/" ?>">
                <img src="<?php echo SVG . "protocols.svg" ?>">
                <h1>Protocols</h1>
            </a>
            <?php if(validateUser("ADMIN")): ?>
                <a href="<?php echo URL . "users/" ?>">
                    <img src="<?php echo SVG . "users.svg" ?>">
                    <h1>Users</h1>
                </a>
            <?php endif; ?>
        </div>
    </div>