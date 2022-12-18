<?php
require_once __DIR__ . '/app.php';

function isLogged($bool)
{
	if ($bool === true) {
		if (!isset($_SESSION["valid"]) && $_SESSION["valid"] !== true) {
			header("location:" . BASE_PATH . "../login.php");
			exit;
		}
	} else {
		if (isset($_SESSION["valid"]) && $_SESSION["valid"] === true) {
			header("location:" . BASE_PATH . "app/index.php");
			exit;
		}
	}
}
function isTeacher()
{
	if ($_SESSION["type"] === "0") {
		exit;
	}
}
function isStudent()
{
	if ($_SESSION["type"] === "1") {
		exit;
	}
}