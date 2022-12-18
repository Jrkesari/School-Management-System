<?php
require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../includes/auth.php';

session_start();
isLogged(true);

session_unset();
$_SESSION = array();
session_destroy();

header("location:" . BASE_PATH . "../login.php");
exit();