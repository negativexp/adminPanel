<main>
    <?php
    function HTMLheader($text) {
        return "<header><h1>{$text}</h1></header>";
    }
    if(isset($_GET["page"])) {
        $page = $_GET["page"];
        switch($page) {
            case "contactForm":
                echo HTMLheader("Kontaktní Formulář");
                echo "<div class='content'>";
                include_once "contact_forms.php";
                echo "</div>";
                break;
            default:
                echo "404!";
                break;
        }
    } else {
        echo HTMLheader("Administrace");
    }
    ?>
</main>