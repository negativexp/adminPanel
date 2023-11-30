<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//dev shit
//$_SESSION["user"] = true;
//$_SESSION = [];
$isLocal = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || $_SERVER['HTTP_HOST'] === '127.0.0.1';
$baseURL = $isLocal ? '/' : '/admin/';
$requestURI = $_SERVER['REQUEST_URI'];

if(strpos($requestURI, "/static/")) {
    $filePath = $isLocal ? ".".$requestURI : $baseURL.$requestURI;
    if(file_exists($filePath)) {
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

        header("Content-Type: ".$mimeTypes[$extension]);
        readfile($filePath);
        exit();
    } else echo "neexistuje!!!";

    exit();
}

include_once "./components/head.php";

// if user is not logged in
if (!isset($_SESSION["user"])) {
    // and the URL is not the login page
    if($requestURI !== $baseURL . "login") {
        header("location: /admin/login");
        exit();
    }
    include_once "./views/login.php";
} else {
    // if user is logged in then
    // routing...
    include_once "./views/nav.php";
    switch ($requestURI) {
        case $baseURL."login/":
            header("location: /admin");
            break;
        case $baseURL:
            echo "bruh";
            break;
        case $baseURL . "logout":
            include_once "./components/logout.php";
            break;
        case $baseURL . 'test':
            echo "test";
            break;
        default:
            http_response_code(404);
            echo '404 Page Not Found';
            break;
    }
}