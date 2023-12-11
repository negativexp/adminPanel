<?php
global $baseURL;
?>
<nav class="open">
    <div id="navButton" onclick="nav()">
        <img class="icon" src="<?=$baseURL?>static/public/img/nav.svg">
    </div>
    <div class="logo">
        <img src="<?=$baseURL?>static/public/img/pixee.svg">
    </div>
    <a href="<?=$baseURL?>admin/kontaktniFormular"><img class="icon" src="<?=$baseURL?>static/public/img/icon.svg"><span>Zprávy</span></a>
    <a href="<?=$baseURL?>admin/logout"><img class="icon" src="<?=$baseURL?>static/public/img/icon.svg"><span>Odhlásit se</span></a>
</nav>