<?php
session_start();
<<<<<<< HEAD
// ! ODKOMENTOVAT POUZE PRI DEVELOPMENTU !
//$_SESSION["user"] = true;
// $dir = "admin";
$dir = "";
// ! KOMENT: NEODHLAŠOVAT SE !
$request = $_SERVER["REQUEST_URI"];
if(strpos($request, $dir."/static/") == 0) {
    $filePath = __DIR__.$request;
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $mimeTypes = [
        "css" => "text/css",
        "js" => "text/javascript",
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
        "webp" => "image/webp",
        "svg" => "image/svg+xml",
    ];

    if(file_exists($filePath) && isset($mimeTypes[$extension])) {
        header("Content-Type: ".$mimeTypes[$extension]);
        readfile($filePath);
=======
if(isset($_POST["email"]) &&
    isset($_POST["name"]) &&
    isset($_POST["message"])) {

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES | ENT_HTML5);
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES | ENT_HTML5);

    include "./admin/db.php";
    $db = new Database();
    $sql = "INSERT INTO contact_forms (email, name, message, date) VALUES (?,?,?,NOW())";
    $params = [$email, $name, $message];
    if($db->executeQuery($sql, $params, false)) {
        header("location: ./?success=true#kontakt");
        exit();
    } else {
        header("location: ./?success=false#kontakt");
>>>>>>> 7bdb134b7e0111ec1b2436dd0488c59eeec88d8e
        exit();
    }
}
?>
<<<<<<< HEAD
<html lang="cs">
<head>
    <title>Administrace</title>
    <link rel="stylesheet" href="<?=$dir?>/static/css/style.css">
    <script defer src="<?=$dir?>/static/js/script.js"></script>
</head>
<body>
<?php
function echoHeader($text) {
    echo "<header><h1>{$text}</h1></header>";
}
function echoContent($path) {
    echo "<div class='content'>";
    include_once($path);
    echo "</div>";
}
$viewDir = $dir."views/";
$componentsDir = $dir."components/";
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<body>
    <header>
        <div class="headerWrapper">
            <a href="./"><img src="imgs/pixee_better.svg" class="width20px maxWidth300"></a>
            <div id="navButton" onclick="Nav()">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M64 384h384v-42.666H64V384zm0-106.666h384v-42.667H64v42.667zM64 128v42.665h384V128H64z"></path></svg>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg>
            </div>
            <nav>
                <a href="#sluzby" class="small underline">Služby</a>
                <a href="#portfolio" class="small underline">Portfolio</a>
                <a href="#onas" class="small underline">o nás</a>
                <a href="#kontakt" class="small underline">Kontakt</a>
                <?php
                if($_SESSION["logged"] == "true") {
                    echo '<a href="./admin" class="small underline">Admin</a>';
                }
                ?>
            </nav>
        </div>
    </header>
>>>>>>> 7bdb134b7e0111ec1b2436dd0488c59eeec88d8e


<<<<<<< HEAD
if(!isset($_SESSION["user"])) {
    if($request !== "/admin/login") {
        header("location: /admin/login");
        exit();
    }
    include_once($viewDir . "login.php");
} else {
    include_once($viewDir . "nav.php");
    echo "<main>";
    switch ($request) {
        case "/admin/":
            break;
        case "/admin/kontaktniFormular":
            echoHeader("Kontaktní Formulář");
            echoContent($viewDir."kontaktniFormular.php");
            break;
        case "/admin/logout":
            include_once($componentsDir . "logout.php");
            break;
        default:
            http_response_code(404);
            echo "404! mrdko";
    }
    echo "</main>";
}
?>
=======
    <div class="wave">
        <svg class="rotate180" xmlns="http://www.w3.org/2000/svg" height="150px" width="100%" preserveAspectRatio="none"
            viewBox="0 0 1440 318">
            <path fill-rule="evenodd" fill-opacity="1"
                d="M0,256L60,234.7C120,213,240,171,360,176C480,181,600,235,720,224C840,213,960,139,1080,117.3C1200,96,1320,128,1380,144L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </div>

    <section id="sluzby">
        <h2>Služby</h2>
        <div class="wrapper">
            <div>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px"
                    width="200px" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M167.02 309.34c-40.12 2.58-76.53 17.86-97.19 72.3-2.35 6.21-8 9.98-14.59 9.98-11.11 0-45.46-27.67-55.25-34.35C0 439.62 37.93 512 128 512c75.86 0 128-43.77 128-120.19 0-3.11-.65-6.08-.97-9.13l-88.01-73.34zM457.89 0c-15.16 0-29.37 6.71-40.21 16.45C213.27 199.05 192 203.34 192 257.09c0 13.7 3.25 26.76 8.73 38.7l63.82 53.18c7.21 1.8 14.64 3.03 22.39 3.03 62.11 0 98.11-45.47 211.16-256.46 7.38-14.35 13.9-29.85 13.9-45.99C512 20.64 486 0 457.89 0z">
                    </path>
                </svg>
                <h3>1. Konzultace</h3>
                <p class="small">Začneme nezávazným rozhovorem, kde si vyslechneme vaše potřeby a termíny. Cílem je
                    vytvořit plán přesně podle vašich přání.</p>
            </div>
            <div>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px"
                    width="200px" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M425.9 170.4H204.3c-21 0-38.1 17.1-38.1 38.1v154.3c0 21 17.1 38 38.1 38h126.8c2.8 0 5.6 1.2 7.6 3.2l63 58.1c3.5 3.4 9.3 2 9.3-2.9v-50.6c0-6 3.8-7.9 9.8-7.9h1c21 0 42.1-16.9 42.1-38V208.5c.1-21.1-17-38.1-38-38.1z">
                    </path>
                    <path
                        d="M174.4 145.9h177.4V80.6c0-18-14.6-32.6-32.6-32.6H80.6C62.6 48 48 62.6 48 80.6v165.2c0 18 14.6 32.6 32.6 32.6h61.1v-99.9c.1-18 14.7-32.6 32.7-32.6z">
                    </path>
                </svg>
                <h3>2. Návrh designu</h3>
                <p class="small">Po našem setkání vytvoříme design stránky podle vašich představ. Představíme vám
                    koncept, který bude reflektovat váš styl a požadavky.</p>
            </div>
            <div>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="200px"
                    width="200px" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M278.9 511.5l-61-17.7c-6.4-1.8-10-8.5-8.2-14.9L346.2 8.7c1.8-6.4 8.5-10 14.9-8.2l61 17.7c6.4 1.8 10 8.5 8.2 14.9L293.8 503.3c-1.9 6.4-8.5 10.1-14.9 8.2zm-114-112.2l43.5-46.4c4.6-4.9 4.3-12.7-.8-17.2L117 256l90.6-79.7c5.1-4.5 5.5-12.3.8-17.2l-43.5-46.4c-4.5-4.8-12.1-5.1-17-.5L3.8 247.2c-5.1 4.7-5.1 12.8 0 17.5l144.1 135.1c4.9 4.6 12.5 4.4 17-.5zm327.2.6l144.1-135.1c5.1-4.7 5.1-12.8 0-17.5L492.1 112.1c-4.8-4.5-12.4-4.3-17 .5L431.6 159c-4.6 4.9-4.3 12.7.8 17.2L523 256l-90.6 79.7c-5.1 4.5-5.5 12.3-.8 17.2l43.5 46.4c4.5 4.9 12.1 5.1 17 .6z">
                    </path>
                </svg>
                <h3>3. Dokončení</h3>
                <p class="small">Ukážeme vám finální produkt a společně provedeme případné úpravy. Poté vám pomůžeme s
                    nasazením stránky na váš server.</p>
            </div>
        </div>
    </section>

    <section id="portfolio">
        <h2>Portfolio</h2>
        <div class="wrapper">
            <div class="slider">
                <div class="slide">
                    <h3>Stránka #1</h3>
                </div>
                <div class="slide">
                    <h3>Stránka #2</h3>
                </div>
                <div class="slide">
                    <h3>Stránka #3</h3>
                </div>
                <div class="slide">
                    <h3>Stránka #4</h3>
                </div>

                <button class="btn btn-next">></button>
                <button class="btn btn-prev"><</button>
              </div>
        </div>
    </section>

    <section id="onas">
        <h2>O nás</h2>
        <div class="wrapper">
        </div>
    </section>

    <section id="kontakt">
        <h2>Kontakt</h2>
        <div class="wrapper">
            <div>
                <ul>
                    <li>
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                            height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z">
                            </path>
                        </svg>
                        <a href="mailto:ahoj@pixee.cz" class="medium underline">ahoj@pixee.cz</a>
                    </li>
                    <li>
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                            height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                            </path>
                        </svg>
                        <a href="tel:+420777054578" class="medium underline">+420 777 054 578</a>
                    </li>
                </ul>
            </div>
            <div>
                <form method="post">
                    <?php
                    if(isset($_GET["success"])) {
                        if($_GET["success"] == "true") {
                            echo "<div class='alert'><p class='medium'>Děkujem za zprávu, brzy se ozvem!</p></div>";
                        } else {
                            echo "<div class='alert'><p class='medium'>Chyba!</p></div>";
                        }
                    }
                    ?>
                    <label class="medium">Váš E-Mail <span class="warning">*</span></label>
                    <input type="email" name="email" required>
                    <label class="medium">Vaše jméno <span class="warning">*</span></label>
                    <input type="text" name="name" required>
                    <label class="medium">Zpráva <span class="warning">*</span></label>
                    <textarea rows="10" required name="message"></textarea>
                    <input type="submit" class="button">
                </form>
            </div>
        </div>
    </section>

    <div class="wave">
        <svg class="footer" xmlns="http://www.w3.org/2000/svg" height="150px" width="100%" preserveAspectRatio="none"
            viewBox="0 0 1440 318">
            <path fill-rule="evenodd" fill-opacity="1"
                d="M0,256L60,234.7C120,213,240,171,360,176C480,181,600,235,720,224C840,213,960,139,1080,117.3C1200,96,1320,128,1380,144L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </div>

    <footer>
        <a href="#" id="tag" class="underline">Pixee.cz</a>
    </footer>
>>>>>>> 7bdb134b7e0111ec1b2436dd0488c59eeec88d8e
</body>
</html>