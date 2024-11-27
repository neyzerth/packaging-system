        <header class="header">
            <div>
                <form action="" method="get">
                    <input type="text" name="search" id="search" placeholder="Search: Press Enter">
                </form>
            </div>
            <?php if(validateUser("ADMIN", "SUPER") || strtok($_SERVER["REQUEST_URI"], '?') == "/process/process-view/"):?>
            <ul>
                <a class="btn" href="?a=add">
                    <p>Add</p>
                </a>
            </ul>
            <?php endif;?>
        </header>