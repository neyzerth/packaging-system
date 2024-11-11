<?php include HEAD; ?>
<header>
    <div class="d-flex align-center">
        <form role="search">
            <input class="form-control" type="search" placeholder="Buscar">
        </form>
        <ul class="new-nav p" style="margin: auto 0;">
            <li class="new-li">
                <a href="#" class="new-a">⚙️</a>
            </li>
            <li class="new-li">
                <a href="#" class="new-a">✉️</a>
            </li>
            <li class="new-li">
                <a href="<?php echo $form ?>" class="new-a">➕</a>
            </li>
            <li class="new-li">
                <a href="#" class="new-a">🗑️</a>
            </li>
            <li class="new-li">
                <a href="#" class="new-a" onclick="refreshPage()">⭮</a>
            </li>
            <li class="new-li">
                <a href="#" class="new-a" id="prevButton" onclick="changeTable(-1)">&#60;</a>
            </li>
            <li class="new-li">
                <span id="pageIndicator"></span>
            </li>
            <li class="new-li">
                <a href="#" id="nextButton" onclick="changeTable(1)">&#62;</a>
            </li>
        </ul>
    </div>
</header>