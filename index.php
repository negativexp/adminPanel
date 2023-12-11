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

switch ($parsedUrl) {
    // PUBLIC STRÁNKOVÁNÍ (public)
    case $baseURL:
        echo "index";
        break;
    // ADMIN STRÁNKOVÁNÍ (private)
    case $baseURL."admin" || $baseURL."admin/":
        include_once "./components/adminHead.php";
        if(isset($_SESSION["user"])) {
            include_once "./views/nav.php";
            echo "<main>";
            if($parsedUrl === $baseURL."admin" || $parsedUrl === $baseURL."admin/") {
                echoHeader("Administrařní dashboard");
            }
            if($parsedUrl === $baseURL."admin/kontaktniFormular") {
                echoHeader("Kontaktní Formulář");
                include_once "./views/kontaktniFormular.php";
            }
            if($parsedUrl === $baseURL."admin/logout") {
                include_once "./components/logout.php";
            }
            echo "</main>";
        } else {
            include_once "./views/login.php";
        }
        break;
    // default
    default:
        echo "404!!!";
        break;
}

if($parsedUrl === $baseURL."/admin" || $parsedUrl === $baseURL."/admin/") {
    header("location: admin/login/");
    exit();
}

exit();