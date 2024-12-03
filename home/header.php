        <div class="top">
            <form method="get">
                <input type="text" name="search" id="search" placeholder="Search">
            </form>
            <span>USERS</span>
            <?php if(validateUser("ADMIN", "SUPER")):?>
                <a class="btn1" href="?a=add">Add</a>
            <?php endif;?>
        </div>