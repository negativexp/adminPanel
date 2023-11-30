<?php
global $baseURL;
?>
<nav class="open">
    <div id="navButton" onclick="nav()">
        <img class="icon" src="<?=$baseURL?>static/img/nav.svg">
    </div>
    <div class="logo">
        <img src="<?=$baseURL?>static/img/pixee.svg">
    </div>
    <a href="/admin/kontaktniFormular"><img class="icon" src="<?=$baseURL?>static/img/icon.svg"><span>Zprávy</span></a>
    <a href="/admin/logout"><img class="icon" src="<?=$baseURL?>static/img/icon.svg"><span>Odhlásit se</span></a>
</nav>