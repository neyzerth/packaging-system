        <header class="header">
            <div>
                <form action="" method="get" autocomplete="off">
                    <input type="text" name="search" id="search" placeholder="Search: Press Enter">
                </form>
            </div>
            <?php if(validateUser("ADMIN", "SUPER")):?>
            <ul>
                <a class="btn" href="?a=add">
                    <p>Add</p>
                </a>
            </ul>
            <?php endif;?>
        </header>