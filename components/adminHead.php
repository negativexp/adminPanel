<?php
global $baseURL;
$charset = "UTF-8";
$viewport = "width=device-width, initial-scale=1.0";
$compatibility = "ie=edge";
$title = "Administrace";
$cssLink = "{$baseURL}static/admin/css/style.css";
$jsLink = "{$baseURL}static/admin/js/script.js";
?>

<head>
    <meta charset="<?= $charset ?>">
    <meta name="viewport" content="<?= $viewport ?>">
    <meta http-equiv="X-UA-Compatible" content="<?= $compatibility ?>">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $cssLink ?>">
    <script defer src="<?= $jsLink ?>"></script>
</head>
