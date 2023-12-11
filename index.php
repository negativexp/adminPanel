<?php
session_start();
$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost') || ($_SERVER['SERVER_ADDR'] === '127.0.0.1');
//lokalni adresa a serverova adresa
$baseURL = $isLocal ? '/' : '/admin/';
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, "/static/") === 0) {
    $filePath = $isLocal ? "." . $requestURI : $_SERVER['DOCUMENT_ROOT'] . $baseURL . ltrim($requestURI, '/');

    if (file_exists($filePath)) {
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

        if (array_key_exists($extension, $mimeTypes)) {
            header("Content-Type: " . $mimeTypes[$extension]);
            readfile($filePath);
            exit();
        } else {
            echo "Unsupported file type!";
            exit();
        }
    } else {
        echo "File does not exist!";
        exit();
    }
}

include_once "./components/head.php";

function echoHeader($text) {
    echo "<header><h1>{$text}</h1></header>";
}
function echoContent($includePath) {
    echo "<div class='content'>";
    include_once($includePath);
    echo "</div>";
}

//parsne URL bez ? hodnot
$parsedUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(isset($_SESSION["user"])) {
    switch ($parsedUrl) {
        case $baseURL."login/":
            header("location: {$baseURL}");
            break;
        case $baseURL:
            echoHeader("Vítej!");
            break;
        case $baseURL."kontaktniFormular":
            echoHeader("Kontaktní Formulář");
            echoContent("./views/kontaktniFormular.php");
            break;
        case $baseURL . "test":
            echo "test";
            break;
        case $baseURL . "logout":
            include_once "./components/logout.php";
            break;
        default:
            http_response_code(404);
            echo '404 Page Not Found';
            break;
    }
}

if($parsedUrl === $baseURL."admin" || $parsedUrl === $baseURL."admin/") {
    include_once "./views/login.php";
    exit();
}

// pokud uzivatel neni prihlasen
if (!isset($_SESSION["user"])) {
    //pokud url request se rovna k localhost/login
    if($requestURI === $baseURL . "admin") {
        include_once "./views/login.php";
        exit();
    }
    //jinak nic...
} else {
    include_once "./views/nav.php";
    echo "<main>";

    echo "</main>";
}
if(isset($_SESSION["user"])) {

    exit();
}