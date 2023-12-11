<form id="login" method="post">
    <img src="/static/public/img/pixee.svg">
    <?php
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        //dev podmínka
        //smazat při produkci
        if($_POST["username"] == "admin" && $_POST["password"] == "admin") {
            $_SESSION["user"] = true;
            echo '<script>window.location.href = "/admin/";</script>';
        } else {
            require "./components/db.php";
            $db = new Database();
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES | ENT_HTML5);
            $password = hash("sha256", htmlspecialchars($_POST["password"], ENT_QUOTES | ENT_HTML5));
            $sql = "select username, password from admin_users where username = ? and password = ?";
            $params = [$username, $password];
            if($db->fetchSingleRow($db->executeQuery($sql, $params))) {
                session_start();
                $_SESSION["user"] = true;
                header("location: ./");
            } else {
                echo "<div class='alert'><p>Chyba!</p></div>";
            }
        }
    }
    ?>
    <label>Uživatelské jméno</label>
    <input type="text" name="username" required>
    <label>Heslo</label>
    <input type="password" name="password" required>
    <input type="submit" class="button">
</form>