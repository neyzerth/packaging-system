<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?php echo STYLE . "!important.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "!color-palette.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "home.css" ?>">
</head>

<body>
    <?php include(SIDEBAR) ?>
    <main>
        <header>
            <nav>
                <ul class="new-ul">
                    <li class="new-lis">
                        <a href="\GitHub\packaking-system/boxes/index.php">
                            <svg width="90" height="90" viewBox="0 0 16 16">
                                <path d="M8.01 4.555 4.005 7.11 8.01 9.665 4.005 12.22 0 9.651l4.005-2.555L0 4.555 4.005 2zm-4.026 8.487 4.006-2.555 4.005 2.555-4.005 2.555zm4.026-3.39 4.005-2.556L8.01 4.555 11.995 2 16 4.555 11.995 7.11 16 9.665l-4.005 2.555z" />
                            </svg>
                            <span>Boxes</span>
                        </a>
                    </li>
                    <li class="new-lis">
                        <a href="\GitHub\packaking-system/materials/index.php">
                            <svg width="90" height="90" viewBox="0 -0.5 17 17">
                                <g transform="translate(0.000000, 2.000000)">
                                    <path d="M2.967,0 C1.783,0 0.861,0.524 0.365,1.476 C0.011,2.154 0.002,2.823 0.002,2.897 L0.002,11.333 C0.002,11.333 1.189,9.988 3.274,11.333 C5.951,12.932 6.853,10.562 8.011,11.333 C9.856,12.763 10.926,11.333 10.926,11.333 C10.926,11.333 10.913,4.481 10.926,4.302 C10.996,3.158 11.152,2.138 11.587,1.376 C12.072,0.527 12.735,0.001 13.468,0.001 L2.967,0.001 L2.967,0 Z" class="si-glyph-fill"></path>
                                    <path d="M15.029,1.713 C14.732,1.304 14.386,1.063 14.012,1.063 C13.482,1.063 13.001,1.545 12.648,2.323 C12.334,3.019 12.122,3.953 12.068,4.999 L12.068,6.003 C12.18,8.218 13.006,9.939 14.012,9.939 C15.093,9.939 15.97,7.953 15.97,5.501 C15.971,3.895 15.594,2.492 15.029,1.713 L15.029,1.713 Z M14.013,8.047 C13.483,8.047 13.047,7.056 12.989,5.783 L12.989,5.203 C13.018,4.602 13.129,4.064 13.294,3.667 C13.481,3.214 13.733,2.938 14.014,2.938 C14.209,2.938 14.391,3.075 14.547,3.315 C14.845,3.761 15.043,4.571 15.043,5.494 C15.042,6.904 14.579,8.047 14.013,8.047 L14.013,8.047 Z" class="si-glyph-fill"></path>
                            </svg>
                            <span>Materials</span>
                        </a>
                    </li>
                    <li class="new-lis">
                        <a href="#">
                            <svg width="90" height="90" viewBox="0 0 16 16">
                                <path d="M4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1zm5.018 9.696a3 3 0 1 1-3-5.196 3 3 0 0 1 3 5.196" />
                            </svg>
                            <span>Process</span>
                        </a>
                    </li>
                    <li class="new-lis">
                        <a href="\GitHub\packaking-system/products/index.php">
                            <svg width="90" height="90" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                            </svg>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="new-lis">
                        <a href="\GitHub\packaking-system/protocols/index.php">
                            <svg width="90" height="90" viewBox="0 0 16 16">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1" />
                            </svg>
                            <span>Protocols</span>
                        </a>
                    </li>
                    <li class="new-lis">
                        <a href="\GitHub\packaking-system/users/index.php">
                            <svg width="90" height="90" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <span>Users</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
    </main>
</body>

</html>