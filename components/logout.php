<?php
session_destroy();
$_SESSION = [];
header("refresh:0");