<?php
session_start();
$request = $_SERVER["REQUEST_URI"];

$staticDir = "static/";
$componentsDir = "components/";
$viewDir = "views/";
$dir = "./"; //dev dir
//$dir = "./admin/"; //production dir

//static files
if(str_contains($request, "/static/")) {
    //server location
    $filePath = str_replace("/admin/", $dir, $request);
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

    if(file_exists($filePath)) {
        header("Content-Type: ".$mimeTypes[$extension]);
        readfile($filePath);
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="cs">
<?php
include_once $componentsDir."head.php";

if($request == "/admin/login") {
    include $dir.$viewDir."login.php";
    exit();
}

if(!isset($_SESSION["user"]) && $request != "/admin/login") {
    header("location: /admin/login");
    exit();
}

if(isset($_SESSION["user"])) {

}
?>

</html>
