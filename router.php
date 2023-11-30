<?php
session_start();
$_SESSION = [];
$_SESSION["user"] = true;
$isLocal = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || $_SERVER['HTTP_HOST'] === '127.0.0.1';
$baseURL = $isLocal ? '/' : '/admin/';
$requestURI = $_SERVER['REQUEST_URI'];


if(!isset($_SESSION["user"]) && $requestURI !== $baseURL."login") {
    header("location: {$baseURL}login");
    exit();
}

switch ($requestURI) {
    case $baseURL:
        echo "base";
        break;
    case $baseURL."login":
        include_once "./views/login.php";
        break;
    case $baseURL . 'test':
        echo "test";
        break;
    default:
        http_response_code(404);
        echo '404 Page Not Found';
        break;
}