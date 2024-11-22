        <header class="header">
            <div>
                <form action="" method="get">
                    <input type="text" name="search" id="search">
                    <button class="btn-secondary" type="submit">
                        Search
                        <img src="<?php echo SVG . "search.svg" ?>" alt="">
                    </button>
                </form>
            </div>
            <?php if(validateUser("ADMIN", "SUPER")):?>
            <ul>
                <li class="btn">
                    <a href="?a=add">
                        <p> Add</p>
                        <img class="" src="<?php echo SVG . "plus-circle.svg" ?>" >
                    </a>
                    
                </li>
            </ul>
            <?php endif;?>
        </header>