<?php
session_start();
$request = $_SERVER["REQUEST_URI"];
//echo "request: ".$request;
if(strpos($request, "/admin/static/") == 0) {
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
        exit();
    }
}
?>
<html lang="cs">
<head>
    <title>Administrace</title>
    <link rel="stylesheet" href="/admin/static/css/style.css">
    <script defer src="/admin/static/js/script.js"></script>
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
$viewDir = "views/";
$componentsDir = "components/";

// ! ODKOMENTOVAT POUZE PRI DEVELOPMENTU !
//$_SESSION["user"] = true;
// ! KOMENT: NEODHLAŠOVAT SE !


if(!isset($_SESSION["user"])) {
    if($request !== "/admin/login") {
        header("location: /admin/login");
        exit();
    }
    include_once($viewDir."login.php");
} else {
    include_once($viewDir."nav.php");
    echo "<main>";
    switch ($request) {
        case "/admin/":
            break;
        case "/admin/kontaktniFormular":
            echoHeader("Kontaktní Formulář");
            echoContent($viewDir."kontaktniFormular.php");
            break;
        case "/admin/logout":
            include_once($componentsDir."logout.php");
            break;
        default:
            http_response_code(404);
            echo "404! mrdko";
    }
    echo "</main>";
}
?>
</body>
</html>